<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\Jenjang;
use App\Models\kecamatan;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->Sekolah = new Sekolah();
        $this->Jenjang = new Jenjang();
        $this->Kecamatan = new Kecamatan();
        $this->User = new User();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'active' => 'home',
            'jenjang' => $this->Jenjang->allData(),
            'kecamatan' => $this->Kecamatan->allData(),
            'sekolah' => $this->Sekolah->allData(),
            'user' => $this->User->allData()
        ];
        return view('admin.home.v_home', $data);
    }
}
