<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Gelombang;

class HomeController extends Controller
{
    public function index()
    {
        // Redirect admin users to admin dashboard
        if (session('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        
        $jurusans = Jurusan::all();
        $gelombangs = Gelombang::all();
        return view('home', compact('jurusans', 'gelombangs'));
    }

    public function about()
    {
        return view('about');
    }

    public function jurusan()
    {
        $jurusans = Jurusan::all();
        $gelombangs = Gelombang::all();
        return view('jurusan', compact('jurusans', 'gelombangs'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function service()
    {
        return view('service');
    }

    public function program()
    {
        return view('program');
    }
}