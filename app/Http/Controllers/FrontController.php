<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\DetailCompany;
use App\Models\Faq;
use App\Models\Feedback;
use App\Models\Form;
use App\Models\GaleryProject;
use App\Models\Layanan;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use App\Models\Values;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use PhpParser\Node\Const_;

class FrontController extends Controller
{
    
    public function showLandingPage() {
        $service = Service::all();
        $project = Project::all();
        $galery = GaleryProject::all();
        $feedback = Feedback::all();
        $company = DetailCompany::all();
        $contact = Contact::all();

        // Mengirim data ke tampilan
        return view('front.pages.landing', compact('service', 'project', 'galery', 'feedback', 'company', 'contact'));
    }

    public function showAboutUsPage() {
        $visimisi = VisiMisi::all();
        $values = Values::all();
        $company = DetailCompany::all();
        $team = Team::all();
        $contact = Contact::all();

        // Mengirim data ke tampilan
        return view('front.pages.about-us', compact('visimisi', 'values', 'team', 'company', 'contact'));
    }

    public function showServicePage(String $id) {
        $service = Service::find($id);
        $all = Service::all();
        $project = Project::all();
        $galery = GaleryProject::all();
        $layanan = Layanan::where('service_id', $id)->get();
        $faq = Faq::all();
        $company = DetailCompany::all();
        $contact = Contact::all();

        // Mengirim data ke tampilan
        return view('front.pages.service', compact('service', 'project', 'galery', 'layanan', 'company', 'contact', 'faq', 'all'));
    }

    public function showPortofolioPage(Request $request) {
        $data = Project::query();
        $galery = GaleryProject::all();
        $company = DetailCompany::all();
        $contact = Contact::all();

        $page = $request->input('show', session('show', 2));

        if ($page === 'all') {
            $project = $data->get(); // Mengambil semua data
        } else {
            $project = $data->paginate($page)->withQueryString();; // Mengambil data dengan paginasi
        }
        // Mengirim data ke tampilan
        return view('front.pages.portofolio', compact( 'project', 'galery', 'company', 'contact', 'page'));
    }

    public function showPortofolioDetail(String $id) {
        $project = Project::find($id);
        $allProject = Project::all();
        $galery = GaleryProject::where('project_id', $id)->get();
        $allGalery = GaleryProject::all();
        $company = DetailCompany::all();
        $contact = Contact::all();
         // Mengirim data ke tampilan
         return view('front.pages.detail-portofolio', compact( 'project', 'galery', 'company', 'contact', 'allProject', 'allGalery'));
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

        form::create([
            'form_name'   => $request->form_name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'form_description' => $request->form_description,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        
        return redirect()->back()->withStatus('Message successfully sended.');
    }
}
