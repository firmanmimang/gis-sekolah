<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->User = new User();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'active' => 'user',
            'user' => $this->User->allData()
        ];

        return view('admin.user.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add User',
            'active' => 'user',
            'user' => $this->User->allData()
        ];

        return view('admin.user.v_add', $data);
    }

    public function insert()
    {
        Request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'foto' => 'max:1024|mimes:png,jpg,jpeg',
        ]);

        if(!Request()->foto){ goto a; }
        $file = Request()->foto;
        $filename = strtolower('foto_'.implode("_", explode(" ", Request()->name)).'.'.Request()->foto->extension());
        $file->move(public_path('img/user'), $filename);
        a:

        $data = [
            'name' => Request()->name,
            'username' => Request()->username,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            'foto' => (Request()->foto)? $filename : null
        ];

        $this->User->insertData($data);

        return redirect()->route('user')->with('pesan', 'Data berhasil ditambahkan!');
    }

    public function edit($username)
    {
        $data = [
            'title' => 'Add User',
            'active' => 'user',
            'user' => $this->User->detailData($username)
        ];

        return view('admin.user.v_edit', $data);
    }

    public function update($username)
    {
        (file_exists(public_path('img/user/'.$this->User->detailData($username)->foto)))? $fileSize = File::size(public_path('img/user/'.$this->User->detailData($username)->foto)) : '';
        Request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['regex:/^'.$username.'$/'],
            'email' => ['regex:/^'.$this->User->detailData($username)->email.'$/'],
            'foto' => ((request()->foto)? 'max:1024|mimes:png,jpg,jpeg'.((file_exists(public_path('img/user/'.$this->User->detailData($username)->foto)))? ((request()->foto->getClientOriginalName() == $this->User->detailData($username)->foto && request()->foto->getSize() == $fileSize)? '|regex:/'.$this->User->detailData($username)->foto.'/' 
                    : '')
                : '')
            : ''),
        ], [
            'username.regex' => 'username tidak boleh diganti.',
            'email.regex' => 'email tidak boleh diganti.',
            'foto.regex' => 'file foto sama dengan yang lama.'
        ]);

        if(request()->foto)
        {
            // Jika ganti foto
            (
                (file_exists(public_path('img/user/'.$this->User->detailData($username)->foto)))?
                    // hapus foto
                    (($this->User->detailData($username)->foto)?
                        unlink(public_path('img/user/'.$this->User->detailData($username)->foto)) : '' )
            : ''
            );
            // endhapus foto
            $file = Request()->foto;
            $filename =strtolower('foto_'.implode("_", explode(" ", Request()->name)).'.'.Request()->foto->extension());
            $file->move(public_path('img/user'), $filename);

            $data = [
                'name' => Request()->name,
                // 'username' => Request()->username,
                // 'email' => Request()->email,
                'foto' => $filename
            ];

            $this->User->updateData($username, $data);
        } else {
            $data = [
                'name' => Request()->name,
                // 'username' => Request()->username,
                // 'email' => Request()->email,
            ];

            $this->User->updateData($username, $data);
        }
        
        return redirect()->route('user')->with('pesan', 'Data berhasil diedit!');
    }

    public function delete($username)
    {
        // hapus foto
        if ($this->User->detailData($username)->foto) {
            unlink(public_path('img/user/'.$this->User->detailData($username)->foto));
        }
        // endhapus foto
        $this->User->deleteData($username);
        return redirect()->route('user')->with('pesan', 'Data berhasil dihapus!');

    }
}
