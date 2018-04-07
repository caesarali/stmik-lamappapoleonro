<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Jurusan;
use App\Tahun;
use App\Mahasiswa;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusans = Jurusan::orderBy('name', 'ASC')->get();
        return view('admin.jurusan.index', compact('jurusans'));
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
            'name.unique' => 'Jurusan ini sudah terdaftar.',
            'name.max' => 'Nama jurusan terlalu panjang'
        ];

        $request->validate([
            'name' => 'required|unique:jurusan|string|max:50',
            'jenjang' => 'required|string|max:2',
        ], $messages);

        Jurusan::create([
            'name' => $request->name,
            'jenjang' => $request->jenjang,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('jurusan.index')->withSuccess('Jurusan telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Jurusan $jurusan)
    {
        $tahun = Tahun::orderBy('tahun', 'DESC')->get();
        
        if ($request->stambuk) {
            $key = $request->stambuk;
            $mahasiswas = Mahasiswa::where('jurusan_id', $jurusan->id)->where('stambuk', $key)->where('status', '<', 2)->paginate(10);
            if (Auth::guest()) {
                return view('mahasiswa', compact('jurusan', 'mahasiswas', 'key'));    
            }
            return view('admin.mahasiswa.index', compact('jurusan', 'tahun', 'mahasiswas', 'key'));
        }

        $mahasiswas = Mahasiswa::where('jurusan_id', $jurusan->id)->where('status', '<', 2)->paginate(10);

        if (Auth::guest()) {
            return view('mahasiswa', compact('jurusan', 'mahasiswas'));    
        }
        return view('admin.mahasiswa.index', compact('jurusan', 'tahun', 'mahasiswas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $messages = [
            'name.unique' => 'Jurusan ini sudah terdaftar.',
            'name.max' => 'Nama jurusan terlalu panjang'
        ];

        if ($request->name !== $jurusan->name) {
            $request->validate([
                'name' => 'required|unique:jurusan|string|max:50'
            ], $messages);
        }

        $request->validate([
            'jenjang' => 'required|string|max:2',
        ]);

        $jurusan->name = $request->name;
        $jurusan->jenjang = $request->jenjang;
        $jurusan->save();

        return redirect()->route('jurusan.index')->withSuccess('Perubahan data telah disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);
        if ($jurusan->mahasiswa->count() > 0) {
            return redirect()->back()->with('error', 'Data jurusan tidak dapat dihapus.');
        }
        $jurusan->delete();
        return redirect()->route('jurusan.index')->withSuccess('Jurusan telah dihapus');
    }
}
