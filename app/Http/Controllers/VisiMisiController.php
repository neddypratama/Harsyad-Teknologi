<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
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
        $query = VisiMisi::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('visimisi_type', 'like', "%{$search}%")
                ->orWhere('visimisi_description', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.visi-misi.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_visimisi_type'    => 'required|in:Visi,Misi',
            'edit_visimisi_description'  => 'required',
        ]);

        $visimisi = VisiMisi::findOrFail($id);

        $visimisi->update([
            'visimisi_type'   => $request->edit_visimisi_type,
            'visimisi_description' => $request->edit_visimisi_description,
            'updated_at'     => now(),
        ]);
        return redirect()->route('visimisi.index')->withStatus(__('Visi Misi successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'visimisi_type'    => 'required|in:Visi,Misi',
            'visimisi_description'  => 'required'
        ]);

        VisiMisi::create([
            'visimisi_type'   => $request->visimisi_type,
            'visimisi_description' => $request->visimisi_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->route('visimisi.index')->withStatus('Visi Misi successfully added.');
    }


    public function destroy(String $id)
    {
        $check = VisiMisi::findOrFail($id);
        if(!$check){
            return redirect()->route('visimisi.index')->withError(__('Visi Misi cannot finded.'));
        }
        try{
                VisiMisi::destroy($id);
                return redirect()->route('visimisi.index')->withStatus(__('Visi Misi successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('visimisi.index')->withError(__('Visi Misi data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
