<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\Tahun;
use App\Alumni;
use App\Jabatan;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alumnus = Mahasiswa::where('status', 2)->paginate(10);
        if ($request->keyword) {
            $alumnus = Mahasiswa::when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->keyword}%");
            })->where('status', 2)->paginate(10);
            $alumnus->appends($request->only('keyword'));
        }

        return view('admin.alumni.index', compact('alumnus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tahun = Tahun::orderBy('tahun', 'DESC')->get();
        $jabatan = Jabatan::orderBy('name', 'ASC')->get();
        if ($request->stambuk) {
            $mahasiswa = Mahasiswa::where('stambuk', $request->stambuk)->first();
            if (count($mahasiswa) === 0) {
                return redirect()->route('alumni.create')->with('message', 'Data mahasiswa tidak ditemukan.');
            }
            return view('admin.alumni.create', compact('tahun', 'mahasiswa', 'jabatan'));
        }
        return view('admin.alumni.create', compact('tahun', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'stambuk.required' => 'Stambuk harus di-input. Data mahasiswa diperlukan untuk menginput data alumni.',
            'nama_inst.required' => 'Nama instansi tidak boleh dikosongkan.',
            'alamat_inst.required'=> 'Alamat instansi tidak boleh dikosongkan.',
            'jabatan.required' => 'Jabatan tidak boleh dikosongkan.',
            'tahun.required' => 'Tahun tidak boleh dikosongkan',
        ];

        $request->validate([
            'stambuk' => 'required|integer',
            'nama_inst' => 'required|string|max:191',
            'alamat_inst' => 'required|string',
            'jabatan' => 'required|string|max:191',
            'tahun' => 'required|integer'
        ], $messages);

        $mahasiswa = Mahasiswa::find($request->stambuk);
        $mahasiswa->status = 2;
        $mahasiswa->save();
        $jabatan = Jabatan::firstOrCreate(['name' => $request->jabatan]);
        $tahun = Tahun::firstOrCreate(['tahun' => $request->tahun]);

        $alumni = Alumni::updateOrCreate(
            ['mahasiswa_id' => $mahasiswa->id], 
            [
                'nama_inst' => $request->nama_inst,
                'alamat_inst' => $request->alamat_inst,
                'jabatan_id' => $jabatan->id,
                'tahun_id' => $tahun->id,
            ]
        );

        return redirect()->route('alumni.index')->withSuccess('Data alumni telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($stambuk)
    {
        $tahun = Tahun::orderBy('tahun', 'DESC')->get();
        $jabatan = Jabatan::orderBy('name', 'ASC')->get();
        $mahasiswa = Mahasiswa::where('stambuk', $stambuk)->first();
        return view('admin.alumni.create', compact('tahun', 'mahasiswa', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumni = Alumni::find($id);
        $mahasiswa = Mahasiswa::where('id', $alumni->mahasiswa_id)->update(['status' => 1]);
        $alumni->delete();

        return redirect()->back()->withSuccess('Data alumni telah dihapus');
    }

    public function alumniJurusan()
    {
        return view('admin.alumni.all');
    }
}
