<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kecamatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function allData()
    {
        return DB::table('kecamatans')->get();
    }

    public function insertData($data)
    {
        DB::table('kecamatans')->insert($data);
    }

    public function detailData($slug)
    {
        return DB::table('kecamatans')->where('slug', $slug)->first();
    }

    public function updateData($slug, $data)
    {
        DB::table('kecamatans')->where('slug', $slug)->update($data);
    }

    public function deleteData($slug)
    {
        DB::table('kecamatans')->where('slug', $slug)->delete();
    }
}
