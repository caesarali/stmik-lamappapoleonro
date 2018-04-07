<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jurusan;
use App\Mahasiswa;
use App\Tahun;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Jurusan $jurusan)
    {
        // $tahun = Tahun::orderBy('tahun', 'DESC')->get();
        // $mahasiswa = Mahasiswa::where('status', '<', 2)->where('jurusan_id', $jurusan->id)->paginate(10);
        // return view('admin.mahasiswa.index', compact('jurusan', 'tahun', 'mahasiswa'));
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
        $messages = [
            'stambuk.required' => 'Stambuk tidak boleh dikosongkan.',
            'stambuk.unique' => 'Stambuk ini sudah digunakan.',
            'stambuk.max' => 'Format stambuk terlalu panjang.',
            'name.required' => 'Nama tidak boleh dikosongkan.',
            'name.max' => 'Nama menggunakan karakter terlalu banyak.',
            'tahun.max' => 'Masukkan tahun saat ini atau tahun sebelumnya yang lebih lama.',
            'jurusan.required' => 'Jurusan tidak ditemukan.',
        ];

        $nowYear = date('Y');

        $request->validate([
            'stambuk' => 'required|string|unique:mahasiswa|max:20',
            'name' => 'required|string|max:191',
            'jk' => 'required|integer|max:1',
            'tahun' => 'required|integer|max:'.$nowYear,
            'jurusan_id' => 'required|integer',
        ], $messages);

        $tahun = Tahun::firstOrCreate(['tahun' => $request->tahun]);
        $jurusan = Jurusan::find($request->jurusan_id);

        $mahasiswa = Mahasiswa::create([
            'name' => $request->name,
            'stambuk' => $request->stambuk,
            'jk' => $request->jk,
            'tahun_id' => $tahun->id,
            'jurusan_id' => $request->jurusan_id,
            'status' => 1
        ]);

        return redirect()->route('mahasiswa.jurusan', $jurusan->slug)->withSuccess('Data mahasiswa telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $tahun = Tahun::orderBy('tahun', 'DESC')->get();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'tahun'));
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
        $mahasiswa = Mahasiswa::find($id);
        $nowYear = date('Y');

        $messages = [
            'stambuk.required' => 'Stambuk tidak boleh dikosongkan.',
            'stambuk.unique' => 'Stambuk ini sudah digunakan.',
            'stambuk.max' => 'Format stambuk terlalu panjang.',
            'name.required' => 'Nama tidak boleh dikosongkan.',
            'name.max' => 'Nama menggunakan karakter terlalu banyak.',
            'tahun.max' => 'Masukkan tahun saat ini atau tahun sebelumnya yang lebih lama.',
            'jurusan_id.required' => 'Jurusan tidak ditemukan.',
        ];

        if ($request->stambuk !== $mahasiswa->stambuk) {
            $request->validate([
                'stambuk' => 'required|string|unique:mahasiswa|max:20',
            ], $messages);
        }

        $request->validate([
            'name' => 'required|string|max:191',
            'jk' => 'required|integer|max:1',
            'tahun' => 'required|integer|max:'.$nowYear,
            'jurusan_id' => 'required|integer',
            'status' => 'required|integer|max:1',
        ], $messages);

        $tahun = Tahun::firstOrCreate(['tahun' => $request->tahun]);

        $mahasiswa->stambuk = $request->stambuk;
        $mahasiswa->name = $request->name;
        $mahasiswa->jk = $request->jk;
        $mahasiswa->tahun_id = $tahun->id;
        $mahasiswa->jurusan_id = $request->jurusan_id;
        $mahasiswa->status = $request->status;
        $mahasiswa->save();

        $jurusan = Jurusan::find($request->jurusan_id);

        return redirect()->route('mahasiswa.jurusan', $jurusan->slug)->withSuccess('Perubahan data disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        return redirect()->back()->withSuccess('Data mahasiswa telah dihapus.');
    }
}
