<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
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
        $query = Team::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('team_name', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.team.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_team_name'    => 'required|string|max:255',
            'edit_role'  => 'required|string|max:255',
            'edit_team_image'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $team = Team::findOrFail($id);

        // Check if the request has a file for 'team_image'
        if ($request->hasFile('edit_team_image')) {
            // Get the uploaded file
            $file = $request->file('edit_team_image');

            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store('uploads', 'public');
            Storage::disk('public')->delete($team->team_image);

            // Create a new team entry in the database
            $team->update([
                'team_name'   => $request->edit_team_name,
                'role' => $request->edit_role,
                'team_image'   => $filePath,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('team.index')->withStatus(__('Team successfully updated.'));
        }

        $team->update([
            'team_name'   => $request->edit_team_name,
            'role' => $request->edit_role,
            'team_image'   => $team->team_image,
            'updated_at'     => now(),
        ]);
        return redirect()->route('team.index')->withStatus(__('Team successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'team_name'    => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'team_image'    => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Check if the request has a file for 'team_image'
        if ($request->hasFile('team_image')) {
            // Get the uploaded file
            $file = $request->file('team_image');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store('uploads', 'public');

            // Create a new team entry in the database
            Team::create([
                'team_name'   => $request->team_name,
                'role' => $request->role,
                'team_image'   => $filePath,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('team.index')->withStatus('Team successfully added.');
        } else {
            // Redirect with an error message if no file was uploaded
            return redirect()->route('team.index')->withError('Team failed to be added.');
        }
    }
   
    public function destroy(String $id)
    {
        $check = Team::findOrFail($id);
        if(!$check){
            return redirect()->route('team.index')->withError(__('Team cannot finded.'));
        }
        try{
            // Check if the file exists in the storage
            if (Storage::disk('public')->exists($check->team_icon)) {
                // Delete the file
                Storage::disk('public')->delete($check->team_icon);
                Team::destroy($id);
                return redirect()->route('team.index')->withStatus(__('Team successfully deleted.'));
            }
            return redirect()->route('team.index')->withError(__('File failed deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('team.index')->withError(__('Team data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
