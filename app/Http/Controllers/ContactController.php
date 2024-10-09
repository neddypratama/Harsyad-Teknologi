<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
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
        $query = Contact::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('contact_name', 'like', "%{$search}%")
                ->orWhere('contact_detail', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.contact.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_contact_name'    => 'required|string|max:255',
            'edit_contact_detail'  => 'required|string|max:255',
            'edit_contact_icon'    => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $contact = Contact::findOrFail($id);

        // Check if the request has a file for 'contact_icon'
        if ($request->hasFile('edit_contact_icon')) {
            // Get the uploaded file
            $file = $request->file('edit_contact_icon');

            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store('uploads', 'public');
            Storage::disk('public')->delete($contact->contact_icon);

            // Create a new contact entry in the database
            $contact->update([
                'contact_name'   => $request->edit_contact_name,
                'contact_detail' => $request->edit_contact_detail,
                'contact_icon'   => $filePath,
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('contact.index')->withStatus(__('Contact successfully updated.'));
        }

        $contact->update([
            'contact_name'   => $request->edit_contact_name,
            'contact_detail' => $request->edit_contact_detail,
            'contact_icon'   => $contact->contact_icon,
            'updated_at'     => now(),
        ]);
        return redirect()->route('contact.index')->withStatus(__('Contact successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'contact_name'    => 'required|string|max:255',
            'contact_detail'  => 'required|string|max:255',
            'contact_icon'    => 'required|file|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Check if the request has a file for 'contact_icon'
        if ($request->hasFile('contact_icon')) {
            // Get the uploaded file
            $file = $request->file('contact_icon');
            
            // Store the file in 'public/uploads' and get the file path
            $filePath = $file->store('uploads', 'public');

            // Create a new contact entry in the database
            Contact::create([
                'contact_name'   => $request->contact_name,
                'contact_detail' => $request->contact_detail,
                'contact_icon'   => $filePath,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // Redirect with a success message
            return redirect()->route('contact.index')->withStatus('Contact successfully added.');
        } else {
            // Redirect with an error message if no file was uploaded
            return redirect()->route('contact.index')->withError('Contact failed to be added.');
        }
    }
    public function destroy(String $id)
    {
        $check = Contact::findOrFail($id);
        if(!$check){
            return redirect()->route('contact.index')->withError(__('Contact cannot finded.'));
        }
        try{
            // Check if the file exists in the storage
            if (Storage::disk('public')->exists($check->contact_icon)) {
                // Delete the file
                Storage::disk('public')->delete($check->contact_icon);
                Contact::destroy($id);
                return redirect()->route('contact.index')->withStatus(__('Contact successfully deleted.'));
            }
            return redirect()->route('contact.index')->withError(__('File failed deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('contact.index')->withError(__('Contact data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
