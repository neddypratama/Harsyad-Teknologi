<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
        $check = Project::findOrFail($id);
        if(!$check){
            return redirect()->route('project.index')->withError(__('Project cannot finded.'));
        }
        try{
                Project::destroy($id);
                return redirect()->route('project.index')->withStatus(__('Project successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('project.index')->withError(__('Project data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
