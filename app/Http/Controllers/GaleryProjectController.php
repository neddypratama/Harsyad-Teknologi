<?php

namespace App\Http\Controllers;

use App\Models\GaleryProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleryProjectController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data pencarian dan filter
        $search = $request->input('search');

        // Ambil preferensi tampilan dari request atau session
        $view = $request->input('view', session('view', 'paginated')); // default 'paginated'
        $perPage = $request->input('perPage', session('perPage', 2)); // default 2

        // Simpan preferensi tampilan ke dalam session
        session(['view' => $view, 'perPage' => $perPage]);

        // Query dasar
        $query = GaleryProject::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $project = Project::where('project_name', 'like', "%{$search}%")->get();

            if ($project->isNotEmpty()) {
                // Filter GaleryProject berdasarkan project_id yang ditemukan
                $query->whereIn('project_id', $project->pluck('project_id'));
            } else {
                // Jika tidak ada project yang ditemukan, kosongkan query
                $query->whereRaw('1 = 0');
            }
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            // Mengambil data dengan paginasi dan menambahkan query string
            $data = $query->paginate($perPage)->withQueryString();
        }

        $project = Project::all();

        // Mengirim data ke tampilan
        return view('admin.pages.galery-project.index', compact('data', 'project', 'search'));
    }


    public function update(Request $request, $id) {
        $request->validate([
            'edit_project_id'    => 'required|exists:projects,project_id',
            'edit_galery_name'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $galery = GaleryProject::findOrFail($id);

        // Check if the request has a file for 'galery_icon'
        if ($request->hasFile('galery_name')) {
            // Get the uploaded file
            $file = $request->file('galery_name');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store('uploads', 'public');
            Storage::disk('public')->delete($galery->galery_name);

            // Create a new galery entry in the database
            $galery->update([
                'project_id'   => $request->project_id,
                'galery_name'   => $filePath,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('galery.index')->withStatus(__('Galery successfully updated.'));
        }

        $galery->update([
            'project_id'   => $request->edit_project_id,
            'galery_name'   => $galery->galery_name,
            'updated_at'     => now(),
        ]);
        return redirect()->route('galery.index')->withStatus(__('Galery successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'galery_name.*' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Validasi setiap gambar
        ]);

        // Ambil input dari request
        $projectId = $request->input('project_id');
        $galleryFiles = $request->file('galery_name');

        // Periksa apakah data file ada
        if ($galleryFiles && count($galleryFiles) > 0) {
            foreach ($galleryFiles as $file) {
                // Simpan file di 'public/uploads' dan dapatkan path-nya
                $filePath = $file->store('uploads', 'public');

                // Buat entri galeri baru di database
                GaleryProject::create([
                    'project_id' => $projectId,
                    'galery_name' => $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('project.index')->with('status', 'Galery successfully added.');
        } else {
            // Redirect dengan pesan error jika tidak ada file yang diunggah
            return redirect()->route('project.index')->with('error', 'Please upload at least one image.');
        }
    }

    public function destroy(String $id)
    {
        $check = GaleryProject::findOrFail($id);
        if(!$check){
            return redirect()->route('galery.index')->withError(__('Galery cannot finded.'));
        }
        try{
            // Check if the file exists in the storage
            if (Storage::disk('public')->exists($check->galery_name)) {
                // Delete the file
                Storage::disk('public')->delete($check->galery_name);
                GaleryProject::destroy($id);
                return redirect()->route('galery.index')->withStatus(__('Galery successfully deleted.'));
            }
            return redirect()->route('galery.index')->withError(__('File failed deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('galery.index')->withError(__('Galery data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
