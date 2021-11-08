<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenjang;
use Illuminate\Support\Facades\File;

class JenjangController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->jenjang = new Jenjang();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Jenjang',
            'active' => 'jenjang',
            'jenjang' => $this->jenjang->allData(),
            'jenjang2' => $this->jenjang->allData()
        ];

        return view('admin.jenjang.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Jenjang',
            'active' => 'jenjang',
        ];
        return view('admin.jenjang.v_add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'jenjang' => 'required|unique:jenjangs',
            'icon' => 'required|max:1024|mimes:png',
        ], [
            'jenjang.required' => 'jenjang wajib diisi.',
            'jenjang.unique' => 'jenjang sudah terdaftar.',
            'icon.required' => 'icon wajib diisi.',
            'icon.max' => 'file max 1Mb.',
            'icon.mimes' => 'tipe file harus png.'
        ]);

        $file = Request()->icon;
        $filename = $file->getClientOriginalName();
        $file->move(public_path('img/icon'), $filename);

        $data = [
            'jenjang' => Request()->jenjang,
            'slug' =>strtolower(implode("_", explode(" ", Request()->jenjang))),
            'icon' => $filename,
        ];

        $this->jenjang->insertData($data);

        return redirect()->route('jenjang')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Jenjang',
            'active' => 'jenjang',
            'jenjang' => $this->jenjang->detailData($slug)
        ];

        return view('admin.jenjang.v_edit', $data);
    }

    public function update($slug)
    {
        $fileSize = File::size(public_path('img/icon/'.$this->jenjang->detailData($slug)->icon));
        Request()->validate([
            'jenjang' => 'required|'.((request()->jenjang <> $this->jenjang->detailData($slug)->jenjang)? 'unique:jenjangs': ''),
            'icon' => ((request()->icon)? 'max:1024|mimes:png'. ((request()->icon->getClientOriginalName() == $this->jenjang->detailData($slug)->icon && request()->icon->getSize() == $fileSize)?'|regex:/'.$this->jenjang->detailData($slug)->icon.'/' : '' ): ''),
        ], [
            'jenjang.required' => 'jenjang wajib diisi.',
            'jenjang.unique' => 'jenjang sudah terdaftar.',
            'icon.max' => 'file max 1Mb.',
            'icon.mimes' => 'tipe file harus png.',
            'icon.regex' => 'file icon sama dengan yang lama.'
        ]);

        if(request()->icon)
        {
            // Jika ganti icon
            // hapus icon
            if ($this->jenjang->detailData($slug)->icon <> '') {
                unlink(public_path('img/icon/'.$this->jenjang->detailData($slug)->icon));
            }
            // endhapus icon
            $file = Request()->icon;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('img/icon'), $filename);

            $data = [
                'jenjang' => Request()->jenjang,
                'slug' =>strtolower(implode("_", explode(" ", Request()->jenjang))),
                'icon' => $filename,
            ];

            $this->jenjang->updateData($slug, $data);
        } else {
            $data = [
                'jenjang' => request()->jenjang,
                'slug' =>strtolower(implode("_", explode(" ", Request()->jenjang))),
            ];

            $this->jenjang->updateData($slug, $data);
        }
        
        return redirect()->route('jenjang')->with('pesan', 'Data berhasil diedit!');
    }

    public function delete($slug)
    {
        // hapus icon
        if ($this->jenjang->detailData($slug)->icon) {
            unlink(public_path('img/icon/'.$this->jenjang->detailData($slug)->icon));
        }
        // endhapus icon
        $this->jenjang->deleteData($slug);
        return redirect()->route('jenjang')->with('pesan', 'Data berhasil dihapus!');
    }
}
