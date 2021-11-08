<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenjang extends Model
{
    use HasFactory;

    public function allData()
    {
        return DB::table('jenjangs')->get();
    }

    public function insertData($data)
    {
        DB::table('jenjangs')->insert($data);
    }

    public function detailData($slug)
    {
        return DB::table('jenjangs')->where('slug', $slug)->first();
    }

    public function updateData($slug, $data)
    {
        DB::table('jenjangs')->where('slug', $slug)->update($data);
    }

    public function deleteData($slug)
    {
        DB::table('jenjangs')->where('slug', $slug)->delete();
    }
}
