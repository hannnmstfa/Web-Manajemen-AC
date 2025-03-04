<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
    /**
     * Display the user's profile form.
     */

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore($id)],
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|same:password',
        ], [
            'username.unique' => 'Username Sudah dipakai',
            'password.min' => 'Panjang Password Minimal 8 karakter',
            'password_confirmation.same' => 'Pastikan Password Konfirmasi Sama',
        ]);
        if ($request) {
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password) ?? $user->password,
                'show_pw' => $request->password ?? $user->show_pw,
            ]);
            Alert::success('Sukses', 'Berhasil Mengupdate Profil');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Gagal Mengupdate Profil');
            return redirect()->back();
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($request->password == $user->show_pw) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);
            $user = $request->user();
            Auth::logout();
            $user->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        } else {
            Alert::error('Gagal', 'Password yang Anda Masukkan Salah');
            return redirect()->back();
        }
    }
    public function avatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|file|mimes:jpg,jpeg,png,svg,webp',
        ]);
        if ($request) {
            $user = Auth::user();
            if ($user->avatar !== null) {
                $path = public_path('/storage/image/avatar/') . $user->avatar;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $ekstensi = $request->file('avatar')->getClientOriginalExtension();
            $avatar = 'Avatar-' . Str::random(20) .'.'. $ekstensi;
            $request->file('avatar')->move(public_path('/storage/image/avatar/'), $avatar);
            $user->update([
                'avatar'=> $avatar,
            ]);
            Alert::success('Sukses','Berhasil Mengganti Avatar');
            return redirect()->back();
        }
    }
}
