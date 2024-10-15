<?php

namespace App\Http\Controllers;

use App\Models\GaleryProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data pencarian dan filter
        $search = $request->input('search');

        // Ambil preferensi tampilan dari request atau session
        $view = $request->input('view', session('view', 'paginated')); // default 'paginated'
        $perPage = $request->input('perPage', session('perPage', 2)); // default 5

        // Simpan preferensi tampilan ke dalam session
        session(['view' => $view, 'perPage' => $perPage]);

        // Query dasar
        $query = Project::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('project_name', 'like', "%{$search}%")
                ->orWhere('project_type', 'like', "%{$search}%")
                ->orWhere('project_description', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString(); // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.project.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_project_name'    => 'required|string|max:255',
            'edit_project_type'     => 'required|string|max:225',
            'edit_project_description'  => 'required',
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'project_name'   => $request->edit_project_name,
            'project_description' => $request->edit_project_description,
            'project_type'   => $request->edit_project_type,
            'updated_at'     => now(),
        ]);
        return redirect()->route('project.index')->withStatus(__('Project successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'project_name'    => 'required|string|max:255',
            'project_type'    => 'required|string|max:225',
            'project_description'  => 'required'
        ]);

        Project::create([
            'project_name'   => $request->project_name,
            'project_type' => $request->project_type,
            'project_description' => $request->project_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->route('project.index')->withStatus('Project successfully added.');
    }


    public function destroy(String $id)
    {
        $project = Project::findOrFail($id); // Cari project berdasarkan ID

        if(!$project){
            return redirect()->route('project.index')->withError(__('Project cannot finded.'));
        }
        try {
            // Hapus semua galeri yang terkait dengan project
            $galeries = GaleryProject::where('project_id', $id)->get();
            // dd($galeries);

            if ($galeries && $galeries->count() > 0) {
                foreach ($galeries as $galery) {
                    // Check if the file exists in the storage
                    if (Storage::disk('public')->exists($galery->galery_name)) {
                        // Delete the file from storage
                        Storage::disk('public')->delete($galery->galery_name);
                    }
                    // Hapus data galeri dari database
                    $galery->delete();
                }
            }

            // Hapus project setelah semua galeri dihapus
            $project->delete();

            return redirect()->route('project.index')->withStatus(__('Project and galeries successfully deleted.'));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('project.index')->withError(__('Project data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
