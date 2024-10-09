<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Service;
use Illuminate\Http\Request;

class LayananController extends Controller
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
        $query = Layanan::query();

        // Filter berdasarkan pencarian
        if ($search) {
            // Cari di tabel `Service` untuk nama yang sesuai
            $service = Service::where('service_name', 'like', "%{$search}%")->get();

            if ($service->isNotEmpty()) {
                // Filter Layanan berdasarkan service_id yang ditemukan dan juga berdasarkan pencarian di beberapa kolom
                $query->where(function($q) use ($search, $service) {
                    $q->whereIn('service_id', $service->pluck('service_id'))
                    ->orWhere('layanan_name', 'like', "%{$search}%")
                    ->orWhere('service_id', 'like', "%{$search}%")
                    ->orWhere('layanan_description', 'like', "%{$search}%");
                });
            } else {
                // Jika tidak ada service yang ditemukan, kosongkan query
                $query->whereRaw('1 = 0');
            }
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString(); // Mengambil data dengan paginasi
        }

        $service = Service::all();

        // Mengirim data ke tampilan
        return view('admin.pages.layanan.index', compact('data', 'service'));
    }


    public function update(Request $request, $id) {
        $request->validate([
            'edit_layanan_name'    => 'required|string|max:255',
            'edit_service_id'     => 'required|exists:services,service_id',
            'edit_layanan_description'  => 'required',
        ]);

        $layanan = Layanan::findOrFail($id);

        $layanan->update([
            'layanan_name'   => $request->edit_layanan_name,
            'layanan_description' => $request->edit_layanan_description,
            'service_id'   => $request->edit_service_id,
            'updated_at'     => now(),
        ]);
        return redirect()->route('layanan.index')->withStatus(__('Layanan successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'layanan_name'    => 'required|string|max:255',
            'service_id'    => 'required|exists:services,service_id',
            'layanan_description'  => 'required'
        ]);

        Layanan::create([
            'layanan_name'   => $request->layanan_name,
            'service_id' => $request->service_id,
            'layanan_description' => $request->layanan_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->route('layanan.index')->withStatus('Layanan successfully added.');
    }


    public function destroy(String $id)
    {
        $check = Layanan::findOrFail($id);
        if(!$check){
            return redirect()->route('layanan.index')->withError(__('Layanan cannot finded.'));
        }
        try{
                Layanan::destroy($id);
                return redirect()->route('layanan.index')->withStatus(__('Layanan successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('layanan.index')->withError(__('Layanan data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
