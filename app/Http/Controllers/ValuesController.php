<?php

namespace App\Http\Controllers;

use App\Models\Values;
use Illuminate\Http\Request;

class ValuesController extends Controller
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
        $query = Values::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('values_name', 'like', "%{$search}%")
                ->orWhere('short_name', 'like', "%{$search}%")
                ->orWhere('values_description', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.values.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_values_name'    => 'required|string|max:255',
            'edit_short_name'    => 'required|string|max:1',
            'edit_values_description'  => 'required',
        ]);

        $values = Values::findOrFail($id);

        $values->update([
            'values_name'   => $request->edit_values_name,
            'short_name'   => $request->edit_short_name,
            'values_description' => $request->edit_values_description,
            'updated_at'     => now(),
        ]);
        return redirect()->route('values.index')->withStatus(__('Values successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'values_name'    => 'required|string|max:255',
            'short_name'    => 'required|string|max:255',
            'values_description'  => 'required'
        ]);

        Values::create([
            'values_name'   => $request->values_name,
            'short_name'   => $request->short_name,
            'values_description' => $request->values_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->route('values.index')->withStatus('Values successfully added.');
    }


    public function destroy(String $id)
    {
        $check = Values::findOrFail($id);
        if(!$check){
            return redirect()->route('values.index')->withError(__('Values cannot finded.'));
        }
        try{
                Values::destroy($id);
                return redirect()->route('values.index')->withStatus(__('Values successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('values.index')->withError(__('Values data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
