<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\Jurusan;
use App\Beasiswa;

class HomeController extends Controller
{
    public function index()
    {
    	$jurusanCount = Jurusan::all()->count();
    	$mahasiswaCount = Mahasiswa::where('status', '<', 2)->count();
    	$alumniCount = Mahasiswa::where('status', 2)->count();
    	$beasiswaCount = Beasiswa::all()->count();

    	return view('admin.dashboard', compact('jurusanCount', 'mahasiswaCount', 'alumniCount', 'beasiswaCount'));
    }
}
