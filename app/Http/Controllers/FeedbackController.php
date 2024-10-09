<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
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
        $query = Feedback::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('feedback_name', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%")
                ->orWhere('rate', 'like', "%{$search}%")
                ->orWhere('feedback_description', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.feedback.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_feedback_name'    => 'required|string|max:255',
            'edit_company_name'    => 'required|string|max:255',
            'edit_rate'     => 'required|numeric',
            'edit_feedback_description'  => 'required',
        ]);

        $feedback = Feedback::findOrFail($id);

        $feedback->update([
            'feedback_name'   => $request->edit_feedback_name,
            'feedback_description' => $request->edit_feedback_description,
            'rate'   => $request->edit_rate,
            'company_name'   => $request->edit_company_name,
            'updated_at'     => now(),
        ]);
        return redirect()->route('feedback.index')->withStatus(__('Feedback successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'feedback_name'    => 'required|string|max:255',
            'company_name'    => 'required|string|max:255',
            'rate'    => 'required|numeric',
            'feedback_description'  => 'required'
        ]);

        Feedback::create([
            'feedback_name'   => $request->feedback_name,
            'company_name' => $request->company_name,
            'rate'  => $request->rate,
            'feedback_description' => $request->feedback_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->route('feedback.index')->withStatus('Feedback successfully added.');
    }


    public function destroy(String $id)
    {
        $check = Feedback::findOrFail($id);
        if(!$check){
            return redirect()->route('feedback.index')->withError(__('Feedback cannot finded.'));
        }
        try{
                Feedback::destroy($id);
                return redirect()->route('feedback.index')->withStatus(__('Feedback successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('feedback.index')->withError(__('Feedback data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
