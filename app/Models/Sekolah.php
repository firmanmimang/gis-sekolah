<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sekolah extends Model
{
    use HasFactory;
    
    public function allData()
    {
        return DB::table('sekolahs')
        ->select('sekolah', 'sekolahs.slug', 'status', 'sekolahs.foto', 'jenjang', 'kecamatan')
        ->join('jenjangs', 'jenjangs.id', '=', 'sekolahs.id_jenjang')
        ->join('kecamatans', 'kecamatans.id', '=', 'sekolahs.id_kecamatan')
        ->orderBy('sekolahs.id', 'asc')
        ->get();
    }

    public function insertData($data)
    {
        DB::table('sekolahs')->insert($data);
    }

    public function detailData($slug)
    {
        return DB::table('sekolahs')->where('slug', $slug)->first();
    }

    public function updateData($slug, $data)
    {
        DB::table('sekolahs')->where('slug', $slug)->update($data);
    }

    public function deleteData($slug)
    {
        DB::table('sekolahs')->where('slug', $slug)->delete();
    }
}
