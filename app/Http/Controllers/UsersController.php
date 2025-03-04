<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('superadmin.users.index', compact('users'));
    }
    public function create(){
        return view('superadmin.users.create');
    }
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name'=> 'required|string|max:255',
            'username'=> 'required|string|unique:users,username',
            'password'=> 'required|string|min:8',
            'password_confirmation'=> 'required|same:password',
            'role'=> 'required|string'
        ], [
            'username.unique'=> 'Username sudah dipakai',
            'password.min'=> 'Panjang password minimal 8 karakter',
            'password_confirmation.same'=> 'Pastikan Konfirmasi Password sama dengan password yang Anda masukkan'
        ]);
        if($request){
            User::create([
                'name'=> $request->name,
                'username'=> $request->username,
                'password'=> Hash::make($request->password),
                'show_pw'=> $request->password,
                'role'=> $request->role,
            ]);
            Alert::success('Sukses', 'Berhasil Menambahkan Pengguna');
            return redirect()->route('users.index');
        }else{
            Alert::error('Gagal', 'Tidak dapat Menambahkan Pengguna');
            return redirect()->back();
        }
    }
    public function edit($id){
        $user = User::findOrFail($id);
        return view('superadmin.users.edit', compact('user'));
    }
    public function update(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'name'=> 'required|string|max:255',
            'username'=> ['required', 'string', Rule::unique('users', 'username')->ignore($id)],
            'password'=> 'nullable|string|min:8',
            'password_confirmation'=> 'nullable|same:password',
            'show_pw'=> 'nullable|string',
            'role'=> 'required|string'
        ], [
            'username.unique'=> 'Username sudah dipakai',
            'password.min'=> 'Panjang password minimal 8 karakter',
            'password_confirmation.same'=> 'Pastikan Konfirmasi Password sama dengan password yang Anda masukkan'
        ]);
        $pw_lama = $user->show_pw;
        if($request){
            $user->update([
                'name'=> $request->name,
                'username'=> $request->username,
                'password'=> Hash::make($request->password),
                'show_pw'=> $request->password ?? $pw_lama,
                'role'=> $request->role,
            ]);
            Alert::success('Sukses', 'Berhasil Mengupdate Pengguna');
            return redirect()->route('users.index');
        }else{
            Alert::error('Gagal', 'Tidak dapat Mengupdate Pengguna');
            return redirect()->back();
        }
    }
    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            Alert::success('Sukses', 'Pengguna Berhasil Dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data Tidak Ditemukan');
            return redirect()->back();
        }
    }
}
