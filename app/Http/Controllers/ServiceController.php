<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
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
        $query = Service::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('service_name', 'like', "%{$search}%")
                ->orWhere('service_short', 'like', "%{$search}%")
                ->orWhere('service_description', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString(); // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.service.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_service_name'    => 'required|string|max:255',
            'edit_service_short'  => 'required|string|max:255',
            'edit_service_description'  => 'required',
            'edit_service_icon'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'edit_service_image'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $service = Service::findOrFail($id);

        // Check if the request has a file for 'service_icon'
        if ($request->hasFile('edit_service_icon') && $request->hasFile('edit_service_image')) {
            // Get the uploaded file
            $file1 = $request->file('edit_service_icon');
            $file2 = $request->file('edit_service_image');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath1 = $file1->store("uploads", 'public');
            $filePath2 = $file2->store("uploads", 'public');

            Storage::disk('public')->delete($service->service_image);
            Storage::disk('public')->delete($service->service_icon);

            // Create a new service entry in the database
            $service->update([
                'service_name'   => $request->edit_service_name,
                'service_short' => $request->edit_service_short,
                'service_description' => $request->edit_service_description,
                'service_icon'   => $filePath1,
                'service_image'   => $filePath2,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('service.index')->withStatus(__('Service successfully updated.'));
        }

        // Check if the request has a file for 'service_icon'
        if ($request->hasFile('edit_service_image')) {
            // Get the uploaded file
            $file = $request->file('edit_service_image');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store("uploads", 'public');
            Storage::disk('public')->delete($service->service_image);

            // update a new service entry in the database
            $service->update([
                'service_name'   => $request->edit_service_name,
                'service_short' => $request->edit_service_short,
                'service_description' => $request->edit_service_description,
                'service_icon' => $service->service_icon,
                'service_image'   => $filePath,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('service.index')->withStatus(__('Service successfully updated.'));
        }

        // Check if the request has a file for 'service_icon'
        if ($request->hasFile('edit_service_icon')) {
            // Get the uploaded file
            $file = $request->file('edit_service_icon');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store("uploads", 'public');
            Storage::disk('public')->delete($service->service_icon);

            // update a new service entry in the database
            $service->update([
                'service_name'   => $request->edit_service_name,
                'service_short' => $request->edit_service_short,
                'service_description' => $request->edit_service_description,
                'service_image' => $service->service_image,
                'service_icon'   => $filePath,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('service.index')->withStatus(__('Service successfully updated.'));
        }
        $service->update([
            'service_name'   => $request->edit_service_name,
            'service_detail' => $request->edit_service_detail,
            'service_description' => $request->edit_service_description,
            'service_image' => $service->service_image,
            'service_icon'   => $service->service_icon,
            'updated_at'     => now(),
        ]);
        return redirect()->route('service.index')->withStatus(__('Service successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'service_name'    => 'required|string|max:255',
            'service_short'  => 'required|string|max:255',
            'service_description'  => 'required',
            'service_image'    => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'service_icon'    => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Check if the request has a file for 'service_icon'
        if ($request->hasFile('service_icon') && $request->hasFile('service_image')) {
            // Get the uploaded file
            $file1 = $request->file('service_icon');
            $file2 = $request->file('service_image');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath1 = $file1->store("uploads", 'public');
            $filePath2 = $file2->store("uploads", 'public');

            // Create a new service entry in the database
            Service::create([
                'service_name'   => $request->service_name,
                'service_short' => $request->service_short,
                'service_description' => $request->service_description,
                'service_icon'   => $filePath1,
                'service_image'   => $filePath2,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('service.index')->withStatus(__('Service successfully added.'));
        } else {
            // Redirect with an error message if no file was uploaded
            return redirect()->route('service.index')->withError('Service failed to be added.');
        }
    }


    public function destroy(String $id)
    {
        $check = Service::findOrFail($id);
        if(!$check){
            return redirect()->route('service.index')->withError(__('Service cannot finded.'));
        }
        try{
            // Check if the file exists in the storage
            if (Storage::disk('public')->exists($check->service_icon) || Storage::disk('public')->exists($check->service_image)) {
                // Delete the file
                Storage::disk('public')->delete($check->service_icon);
                Storage::disk('public')->delete($check->service_image);
                Service::destroy($id);
                return redirect()->route('service.index')->withStatus(__('Service successfully deleted.'));
            }
            return redirect()->route('service.index')->withError(__('File failed deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('service.index')->withError(__('Service data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
