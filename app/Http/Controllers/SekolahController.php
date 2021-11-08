<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\Jenjang;
use App\Models\kecamatan;
use Illuminate\Support\Facades\File;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Sekolah = new Sekolah();
        $this->Jenjang = new Jenjang();
        $this->Kecamatan = new Kecamatan();
    }

    public function index()
    {
        $data = [
            'title' => 'Sekolah',
            'active' => 'sekolah',
            'sekolah' => $this->Sekolah->allData()
        ];

        return view('admin.sekolah.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Sekolah',
            'active' => 'sekolah',
            'jenjang' => $this->Jenjang->allData(),
            'kecamatan' => $this->Kecamatan->allData()
        ];

        return view('admin.sekolah.v_add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'sekolah' => 'required|unique:sekolahs',
            'status' => 'required',
            'id_jenjang' => 'required',
            'id_kecamatan' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'posisi' => 'required|regex:/^-?[\d]{0,3}.[\d]{1,17},\s?-?[\d]{0,3}.[\d]{1,17}$/',
            'foto' => 'required|max:1024|mimes:png,jpg,jpeg',
        ], [
            'id_jenjang.required'=> 'jenjang harus diisi.',
            'id_kecamatan.required'=> 'kecamatan harus diisi.',
            'posisi.regex' => 'posisi harus dalam format koordinat.',
            'foto.required' => 'foto harus diupload.',
            'foto.max' => 'file max 1Mb.',
            'foto.mimes' => 'tipe file harus png/jpg/jpeg.'
        ]);

        $file = Request()->foto;
        $filename =strtolower('foto_'.implode("_", explode(" ", Request()->sekolah)).'.'.Request()->foto->extension());
        $file->move(public_path('img/sekolah'), $filename);

        $data = [
            'sekolah' => Request()->sekolah,
            'slug' =>strtolower(implode("_", explode(" ", Request()->sekolah))),
            'id_jenjang' => Request()->id_jenjang,
            'id_kecamatan' => Request()->id_kecamatan,
            'status' => Request()->status,
            'alamat' => Request()->alamat,
            'deskripsi' => Request()->deskripsi,
            'posisi' => Request()->posisi,
            'foto' => $filename,
        ];

        $this->Sekolah->insertData($data);

        return redirect()->route('sekolah')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Sekolah',
            'active' => 'sekolah',
            'sekolah' => $this->Sekolah->detailData($slug),
            'jenjang' => $this->Jenjang->allData(),
            'kecamatan' => $this->Kecamatan->allData()
        ];

        return view('admin.sekolah.v_edit', $data);
    }

    public function update($slug)
    {
        $fileSize = File::size(public_path('img/sekolah/'.$this->Sekolah->detailData($slug)->foto));
        
        Request()->validate([
            'sekolah' => 'required|'.((request()->sekolah <> $this->Sekolah->detailData($slug)->sekolah)? 'unique:sekolahs': ''),
            'status' => 'required',
            'id_jenjang' => 'required',
            'id_kecamatan' => 'required',
            'alamat' => 'required',
            'deskripsi' => 'required',
            'posisi' => 'required|regex:/^-?[\d]{0,3}.[\d]{1,17},\s?-?[\d]{0,3}.[\d]{1,17}$/',
            'foto' => ((request()->foto)? 'max:1024|mimes:png,jpg,jpeg'. ((request()->foto->getClientOriginalName() == $this->Sekolah->detailData($slug)->foto && request()->foto->getSize() == $fileSize)?'|regex:/'.$this->Sekolah->detailData($slug)->foto.'/' : '' )
                        : '')
        ], [
            'id_jenjang.required'=> 'jenjang harus diisi.',
            'id_kecamatan.required'=> 'kecamatan harus diisi.',
            'posisi.regex' => 'posisi harus dalam format koordinat.',
            'foto.required' => 'foto harus diupload.',
            'foto.max' => 'file max 1Mb.',
            'foto.mimes' => 'tipe file harus png/jpg/jpeg.',
            'foto.regex' => 'file foto sama dengan yang lama.'
        ]);

        if(request()->foto)
        {
            // Jika ganti foto
            // hapus foto
            if ($this->Sekolah->detailData($slug)->foto <> '') {
                unlink(public_path('img/sekolah/'.$this->Sekolah->detailData($slug)->foto));
            }
            // endhapus foto
            $file = Request()->foto;
            $filename =strtolower('foto_'.implode("_", explode(" ", Request()->sekolah)).'.'.Request()->foto->extension());
            $file->move(public_path('img/sekolah'), $filename);

            $data = [
                'sekolah' => Request()->sekolah,
                'slug' =>strtolower(implode("_", explode(" ", Request()->sekolah))),
                'id_jenjang' => Request()->id_jenjang,
                'id_kecamatan' => Request()->id_kecamatan,
                'status' => Request()->status,
                'alamat' => Request()->alamat,
                'deskripsi' => Request()->deskripsi,
                'posisi' => Request()->posisi,
                'foto' => $filename,
            ];

            $this->Sekolah->updateData($slug, $data);
        } else {
            $data = [
                'sekolah' => Request()->sekolah,
                'slug' => strtolower(implode("_", explode(" ", Request()->sekolah))),
                'id_jenjang' => Request()->id_jenjang,
                'id_kecamatan' => Request()->id_kecamatan,
                'status' => Request()->status,
                'alamat' => Request()->alamat,
                'deskripsi' => Request()->deskripsi,
                'posisi' => Request()->posisi,
            ];

            $this->Sekolah->updateData($slug, $data);
        }
        
        return redirect()->route('sekolah')->with('pesan', 'Data berhasil diedit!');
    }

    public function delete($slug)
    {
        // hapus foto
        if ($this->Sekolah->detailData($slug)->foto) {
            unlink(public_path('img/sekolah/'.$this->Sekolah->detailData($slug)->foto));
        }
        // endhapus foto
        $this->Sekolah->deleteData($slug);
        return redirect()->route('sekolah')->with('pesan', 'Data berhasil dihapus!');

    }
}
