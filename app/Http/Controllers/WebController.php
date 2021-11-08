<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;

class WebController extends Controller
{
    public function __construct()
    {
        $this->WebModel = new WebModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Pemetaan',
            'kecamatan' => $this->WebModel->dataKecamatan(),
            'jenjang' => $this->WebModel->dataJenjang(),
            'sekolah' => $this->WebModel->dataSekolahAll()
        ];
        return view('v_web', $data);
    }

    public function kecamatan($slug)
    {
        $data = [
            'title' => 'Kecamatan '. $this->WebModel->detailKecamatan($slug)->kecamatan,
            'kecamatan' => $this->WebModel->dataKecamatan(),
            'jenjang' => $this->WebModel->dataJenjang(),
            'detailkecamatan' => $this->WebModel->detailKecamatan($slug),
            'sekolah' => $this->WebModel->dataSekolahKecamatan($slug)
        ];

        return view('v_kecamatan', $data);
    }

    public function jenjang($slug)
    {
        $data = [
            'title' => 'Jenjang '. $this->WebModel->detailJenjang($slug)->jenjang,
            'kecamatan' => $this->WebModel->dataKecamatan(),
            'jenjang' => $this->WebModel->dataJenjang(),
            'detailjenjang' => $this->WebModel->detailJenjang($slug),
            'sekolah' => $this->WebModel->dataSekolahJenjang($slug)
        ];

        return view('v_jenjang', $data);
    }

    public function sekolah($slug)
    {
        $data = [
            'title' => 'Detail '. $this->WebModel->detailSekolah($slug)->sekolah,
            'kecamatan' => $this->WebModel->dataKecamatan(),
            'jenjang' => $this->WebModel->dataJenjang(),
            'sekolah' => $this->WebModel->detailSekolah($slug)
        ];

        return view('v_detailsekolah', $data);
    }
}
