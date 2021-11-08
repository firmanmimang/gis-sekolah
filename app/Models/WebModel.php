<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebModel extends Model
{
    use HasFactory;

    public function dataKecamatan()
    {
        return DB::table('kecamatans')
        ->select('kecamatan', 'slug', 'warna', 'geojson')
        ->get();
    }

    public function detailKecamatan($slug)
    {
        return DB::table('kecamatans')
        ->select('kecamatan', 'slug', 'warna', 'geojson')
        ->where('slug', $slug)
        ->first();
    }

    public function dataJenjang()
    {
        return DB::table('jenjangs')
        ->select('jenjang', 'slug', 'icon')
        ->get();
    }

    public function detailJenjang($slug)
    {
        return DB::table('jenjangs')->where('slug', $slug)->first();
    }

    public function dataSekolahAll()
    {
        return DB::table('sekolahs')
        ->select('sekolah', 'sekolahs.slug', 'status', 'posisi', 'sekolahs.foto', 'jenjang', 'icon', 'kecamatan')
        ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.id_jenjang')
        ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.id_kecamatan')
        ->orderBy('sekolahs.id', 'asc')
        ->get();
    }

    public function detailSekolah($slug)
    {
        return DB::table('sekolahs')
        ->select('sekolah', 'sekolahs.slug', 'status', 'alamat', 'posisi', 'sekolahs.foto', 'jenjang', 'icon', 'kecamatan')
        ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.id_jenjang')
        ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.id_kecamatan')
        ->where('sekolahs.slug', $slug)
        ->orderBy('sekolahs.id', 'asc')
        ->first();
    }

    public function dataSekolahKecamatan($slug)
    {
        return DB::table('sekolahs')
        ->select('sekolah', 'sekolahs.slug', 'status', 'posisi', 'sekolahs.foto', 'jenjang', 'jenjangs.slug as slugjenjang', 'icon', 'kecamatan')
        ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.id_jenjang')
        ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.id_kecamatan')
        ->where('kecamatans.slug', $slug)
        ->orderBy('sekolahs.id', 'asc')
        ->get();
    }

    public function dataSekolahJenjang($slug)
    {
        return DB::table('sekolahs')
        ->select('sekolah', 'sekolahs.slug', 'status', 'posisi', 'sekolahs.foto', 'jenjang', 'jenjangs.slug as slugjenjang', 'icon', 'kecamatan')
        ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.id_jenjang')
        ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.id_kecamatan')
        ->where('jenjangs.slug', $slug)
        ->orderBy('sekolahs.id', 'asc')
        ->get();
    }
}
