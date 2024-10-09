<?php

namespace App\Http\Controllers;

use App\Models\DetailCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailCompanyController extends Controller
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
        $query = DetailCompany::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('detail_name', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.detail-company.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_detail_name'    => 'required|string|max:255',
            'edit_address'  => 'required',
            'edit_detail_logo'    => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $detail = DetailCompany::findOrFail($id);

        // Check if the request has a file for 'detail_logo'
        if ($request->hasFile('edit_detail_logo')) {
            // Get the uploaded file
            $file = $request->file('edit_detail_logo');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store('uploads', 'public');

            // Create a new detail entry in the database
            $detail->update([
                'detail_name'   => $request->edit_detail_name,
                'address' => $request->edit_address,
                'detail_logo'   => $filePath,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('detail.index')->withStatus(__('Detail company successfully updated.'));
        }

        $detail->update([
            'detail_name'   => $request->edit_detail_name,
            'address' => $request->edit_address,
            'detail_logo'   => $detail->detail_logo,
            'updated_at'     => now(),
        ]);
        return redirect()->route('detail.index')->withStatus(__('Detail company successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'detail_name'    => 'required|string|max:255',
            'address'  => 'required',
            'detail_logo'    => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Check if the request has a file for 'detail_logo'
        if ($request->hasFile('detail_logo')) {
            // Get the uploaded file
            $file = $request->file('detail_logo');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store('uploads', 'public');

            // Create a new detail entry in the database
            DetailCompany::create([
                'detail_name'   => $request->detail_name,
                'address' => $request->address,
                'detail_logo'   => $filePath,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('detail.index')->withStatus('Detail company successfully added.');
        } else {
            // Redirect with an error message if no file was uploaded
            return redirect()->route('detail.index')->withError('Detail company failed to be added.');
        }
    }


    public function destroy(String $id)
    {
        $check = DetailCompany::findOrFail($id);
        if(!$check){
            return redirect()->route('detail.index')->withError(__('Detail company cannot finded.'));
        }
        try{
            // Check if the file exists in the storage
            if (Storage::disk('public')->exists($check->detail_logo)) {
                // Delete the file
                Storage::disk('public')->delete($check->detail_logo);
                DetailCompany::destroy($id);
                return redirect()->route('detail.index')->withStatus(__('Detail company successfully deleted.'));
            }
            return redirect()->route('detail.index')->withError(__('File failed deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('detail.index')->withError(__('Detail company data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
