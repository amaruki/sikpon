<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function guru()
    {
        $guru = Pegawai::where('jabatan', 'Guru')->get();
        $aguru = User::where('role', 'Guru')->get();
        return view('user.guru', compact('guru', 'aguru'));
    }

    public function siswa()
    {
        $siswa = Siswa::get();
        $asiswa = User::where('role', 'Siswa')->get();
        return view('user.siswa', compact('siswa', 'asiswa'));
    }

    public function store_guru(Request $request)
    {
        $massage = [
            'required' => ':attribute wajib di isi !!',
        ];

        $this->validate($request, [
            'username' => 'required|min:4|unique:users,username',
            'password' => 'required|min:4|max:12',
            'pegawai_id' => 'required|unique:users,pegawai_id',
        ], $massage);

        $user = new User;
        $user->role = $request->role;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->pegawai_id = $request->pegawai_id;
        $user->save();

        return back()->with('notif', 'User Guru berhasil dibuat');
    }

    public function store_siswa(Request $request)
    {
        $massage = [
            'required' => ':attribute wajib di isi !!',
        ];

        $this->validate($request, [
            'username' => 'required|min:4|unique:users,username',
            'password' => 'required|min:4|max:12',
            'siswa_id' => 'required|unique:users,siswa_id',
        ], $massage);

        $user = new User;
        $user->role = $request->role;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->siswa_id = $request->siswa_id;
        $user->save();

        return back()->with('notif', 'User Siswa berhasil dibuat');
    }

    // Edit User Guru
    public function edit_guru($id)
    {
        $user = User::where('role', 'Guru')->findOrFail($id);
        $guru = Pegawai::where('jabatan', 'Guru')->get();
        return view('user.edit_guru', compact('user', 'guru'));
    }

    public function update_guru(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute wajib di isi !!',
        ];

        $user = User::where('role', 'Guru')->findOrFail($id);

        $validation_rules = [
            'username' => 'required|min:4|unique:users,username,' . $id,
            'pegawai_id' => 'required|unique:users,pegawai_id,' . $id,
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $validation_rules['password'] = 'min:4|max:12';
        }

        $this->validate($request, $validation_rules, $massage);

        $user->username = $request->username;
        $user->pegawai_id = $request->pegawai_id;
        
        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();

        return redirect()->route('user.guru')->with('notif', 'Data User Guru berhasil diupdate');
    }

    // Edit User Siswa
    public function edit_siswa($id)
    {
        $user = User::where('role', 'Siswa')->findOrFail($id);
        $siswa = Siswa::get();
        return view('user.edit_siswa', compact('user', 'siswa'));
    }

    public function update_siswa(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute wajib di isi !!',
        ];

        $user = User::where('role', 'Siswa')->findOrFail($id);

        $validation_rules = [
            'username' => 'required|min:4|unique:users,username,' . $id,
            'siswa_id' => 'required|unique:users,siswa_id,' . $id,
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $validation_rules['password'] = 'min:4|max:12';
        }

        $this->validate($request, $validation_rules, $massage);

        $user->username = $request->username;
        $user->siswa_id = $request->siswa_id;
        
        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();

        return redirect()->route('user.siswa')->with('notif', 'Data User Siswa berhasil diupdate');
    }

    // Delete User (Enhanced with role validation)
    public function delete_guru($id)
    {
        $user = User::where('role', 'Guru')->findOrFail($id);
        $username = $user->username;
        $user->delete();
        
        return redirect()->back()->with('notif', 'User Guru <strong>' . $username . '</strong> berhasil dihapus');
    }

    public function delete_siswa($id)
    {
        $user = User::where('role', 'Siswa')->findOrFail($id);
        $username = $user->username;
        $user->delete();
        
        return redirect()->back()->with('notif', 'User Siswa <strong>' . $username . '</strong> berhasil dihapus');
    }

    // Profil (Existing methods - improved)
    public function edit($id)
    {
        $profil = User::where('uuid', $id)->firstOrFail();
        return view('profil.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute wajib di isi !!',
        ];

        $this->validate($request, [
            'password' => 'required|min:4|max:12',
        ], $massage);

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/home')->with('notif', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $user = User::where('uuid', $id)->firstOrFail();
        $username = $user->username ?? $user->name ?? 'User';
        $user->delete();
        
        return redirect()->back()->with('notif', 'User <strong>' . $username . '</strong> berhasil dihapus');
    }
}