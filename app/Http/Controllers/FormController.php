<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use App\Models\Form;
use App\Notifications\ConsultationOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class FormController extends Controller
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
        $query = Form::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where('form_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('no_telp', 'like', "%{$search}%")
                ->orWhere('form_description', 'like', "%{$search}%");
        }

        // Menentukan hasil yang akan ditampilkan
        if ($view === 'all') {
            $data = $query->get(); // Mengambil semua data
        } else {
            $data = $query->paginate($perPage)->withQueryString();; // Mengambil data dengan paginasi
        }

        // Mengirim data ke tampilan
        return view('admin.pages.form.index', compact('data'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'edit_form_name'    => 'required|string|max:255',
            'edit_email'    => 'required|email|max:255',
            'edit_no_telp'     => 'required|string|regex:/^[0-9]{12,13}$/|min:12',
            'edit_form_description'  => 'required',
        ]);

        $form = form::findOrFail($id);

        $form->update([
            'form_name'   => $request->edit_form_name,
            'form_description' => $request->edit_form_description,
            'no_telp'   => $request->edit_no_telp,
            'email'   => $request->edit_email,
            'updated_at'     => now(),
        ]);
        return redirect()->route('form.index')->withStatus(__('Form successfully updated.'));     
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'form_name'    => 'required|string|max:255',
            'email'    => 'required|email',
            'no_telp'    => 'required|string|regex:/^[0-9]{12,13}$/|min:12',
            'form_description'  => 'required'
        ]);

        $form = Form::create([
            'form_name'   => $request->form_name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'form_description' => $request->form_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        Mail::to('neddypratama92@gmail.com')->send(new HelloMail($request->all()));

        return redirect()->route('form.index')->withStatus('Form successfully added.');
    }


    public function destroy(String $id)
    {
        $check = form::findOrFail($id);
        if(!$check){
            return redirect()->route('form.index')->withError(__('Form cannot finded.'));
        }
        try{
                form::destroy($id);
                return redirect()->route('form.index')->withStatus(__('Form successfully deleted.'));
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('form.index')->withError(__('Form data failed to be deleted because there is another table associated with this data.'));
        }
    }
}
