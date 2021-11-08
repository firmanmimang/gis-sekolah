<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Kecamatan = new Kecamatan();
    }

    public function index()
    {
        $data = [
            'title' => 'Kecamatan',
            'active' => 'kecamatan',
            'kecamatan' => $this->Kecamatan->allData()
        ];
        return view('admin.kecamatan.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Data Kecamatan',
            'active' => 'kecamatan',
        ];
        return view('admin.kecamatan.v_add', $data);
    }

    public function insert()
    {
        request()->validate([
            'kecamatan' => 'required|unique:kecamatans',
            'warna' => 'required',
            'geojson' => 'required'
        ],
        [
            'kecamatan.required' => 'kecamatan wajib diisi.',
            'kecamatan.unique' => 'kecamatan sudah terdaftar.',
            'warna.required' => 'warna wajib diisi.',
            'geojson.required' => 'geoJSON wajib diisi.',
        ]
        );

        // jika validasi true lalu insert ke database
        $data = [
            'kecamatan' =>request()->kecamatan,
            'slug' =>strtolower(implode("_", explode(" ", Request()->kecamatan))),
            'warna' => request()->warna,
            'geojson' => request()->geojson
        ];
        $this->Kecamatan->insertData($data);

        return redirect()->route('kecamatan')->with('pesan', 'Data berhasil ditambahkan!');

    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Data Kecamatan',
            'active' => 'kecamatan',
            'kecamatan' => $this->Kecamatan->detailData($slug)
        ];
        return view('admin.kecamatan.v_edit', $data);
    }

    public function update($slug)
    {
        request()->validate([
            'kecamatan' => 'required|'.((request()->kecamatan !== $this->Kecamatan->detailData($slug)->kecamatan) ? 'unique:kecamatans': ''),
            'warna' => 'required',
            'geojson' => 'required'
        ],
        [
            'kecamatan.required' => 'kecamatan wajib diisi.',
            'kecamatan.unique' => 'kecamatan sudah terdaftar.',
            'warna.required' => 'warna wajib diisi.',
            'geojson.required' => 'geoJSON wajib diisi.',
        ]
        );

        // jika validasi true lalu insert ke database
        $data = [
            'kecamatan' =>request()->kecamatan,
            'slug' =>strtolower(implode("_", explode(" ", Request()->kecamatan))),
            'warna' => request()->warna,
            'geojson' => request()->geojson
        ];
        $this->Kecamatan->updateData($this->Kecamatan->detailData($slug)->slug, $data);

        return redirect()->route('kecamatan')->with('pesan', 'Data berhasil diedit!');

    }

    public function delete($slug)
    {
        $this->Kecamatan->deleteData($slug);
        return redirect()->route('kecamatan')->with('pesan', 'Data berhasil dihapus!');

    }
}
