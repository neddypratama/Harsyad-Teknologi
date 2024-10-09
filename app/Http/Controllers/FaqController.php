<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
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
        $query = Faq::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('faq_name', 'like', "%{$search}%")
                ->orWhere('faq_description', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.faq.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_faq_name'    => 'required|string|max:255',
            'edit_faq_description'  => 'required',
        ]);

        $faq = faq::findOrFail($id);

        $faq->update([
            'faq_name'   => $request->edit_faq_name,
            'faq_description' => $request->edit_faq_description,
            'updated_at'     => now(),
        ]);
        return redirect()->route('faq.index')->withStatus(__('FAQ successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'faq_name'    => 'required|string|max:255',
            'faq_description'  => 'required'
        ]);

        faq::create([
            'faq_name'   => $request->faq_name,
            'faq_description' => $request->faq_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->route('faq.index')->withStatus('FAQ successfully added.');
    }


    public function destroy(String $id)
    {
        $check = faq::findOrFail($id);
        if(!$check){
            return redirect()->route('faq.index')->withError(__('FAQ cannot finded.'));
        }
        try{
                faq::destroy($id);
                return redirect()->route('faq.index')->withStatus(__('FAQ successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('faq.index')->withError(__('FAQ data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
