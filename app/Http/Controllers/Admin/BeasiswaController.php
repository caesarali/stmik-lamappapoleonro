<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JenisBeasiswa;
use App\Beasiswa;
use App\Tahun;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beasiswas = Beasiswa::paginate(10);
        $jenisBeasiswa = JenisBeasiswa::all();
        $tahunBeasiswa = Tahun::orderBy('tahun', 'DESC')->get();
        return view('admin.beasiswa.index', compact('beasiswas', 'jenisBeasiswa', 'tahunBeasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:191',
            'jenis' => 'required|string|max:191',
            'sumber' => 'required|string|max:191',
            'tahun' => 'required|integer',
        ]);

        $jenis = JenisBeasiswa::firstOrCreate(['name' => $request->jenis]);
        $tahun = Tahun::firstOrCreate(['tahun' => $request->tahun]);

        $beasiswa = Beasiswa::create([
            'nama' => $request->nama,
            'jenis_beasiswa_id' => $jenis->id,
            'sumber' => $request->sumber,
            'syarat' => $request->syarat,
            'tahun_id' => $tahun->id,
        ]);

        return redirect()->route('beasiswa.index')->withSuccess('Beasiswa telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Beasiswa $beasiswa)
    {
        return view('admin.beasiswa.show', compact('beasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Beasiswa $beasiswa)
    {
        $jenisBeasiswa = JenisBeasiswa::all();
        $tahunBeasiswa = Tahun::orderBy('tahun', 'DESC')->get();
        return view('admin.beasiswa.edit', compact('beasiswa', 'jenisBeasiswa', 'tahunBeasiswa'));
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
        $request->validate([
            'nama' => 'required|string|max:191',
            'jenis' => 'required|string|max:191',
            'sumber' => 'required|string|max:191',
            'tahun' => 'required|integer',
        ]);

        $jenis = JenisBeasiswa::firstOrCreate(['name' => $request->jenis]);
        $tahun = Tahun::firstOrCreate(['tahun' => $request->tahun]);

        $beasiswa = Beasiswa::where('id', $id)->update([
            'nama' => $request->nama,
            'jenis_beasiswa_id' => $jenis->id,
            'sumber' => $request->sumber,
            'syarat' => $request->syarat,
            'tahun_id' => $tahun->id,
        ]);

        return redirect()->route('beasiswa.index')->withSuccess('Perubahan data telah disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Beasiswa::destroy($id);
        return redirect()->back()->withSuccess('Data beasiswa telah dihapus.');
    }
}
