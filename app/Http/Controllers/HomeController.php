<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
use App\Mahasiswa;
use App\Beasiswa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function jurusan()
    {
        $jurusans = Jurusan::orderBy('name', 'ASC')->get();
        return view('jurusan', compact('jurusans'));
    }

    public function alumni()
    {
        return view('alumni');
    }

    public function alumniJob(Request $request)
    {
        $alumnus = Mahasiswa::where('status', 2)->paginate(10);
        if ($request->keyword) {
            $alumnus = Mahasiswa::when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->keyword}%");
            })->where('status', 2)->paginate(10);
            $alumnus->appends($request->only('keyword'));
        }
        return view('job', compact('alumnus'));
    }

    public function beasiswa(Request $request)
    {
        $beasiswas = Beasiswa::paginate(10);
        if ($request->keyword) {
            $beasiswas = Beasiswa::when($request->keyword, function ($query) use ($request) {
                $query->where('nama', 'like', "%{$request->keyword}%")
                ->orWhere('sumber', 'like', "%{$request->keyword}%")
                ->orWhere('syarat', 'like', "%{$request->keyword}%");
            })->paginate(10);

            $beasiswas->appends($request->only('keyword'));
        }
        return view('beasiswa', compact('beasiswas'));
    }
}
