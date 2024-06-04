<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Matkul;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $matkuls = Matkul::all();
        return view('admin.dashboard',['user' => $user, 'matkuls' => $matkuls]);
    }


    public function profile(){
        $user = Auth::user();
        return view('admin.profile',['user' => $user]);
    }


    public function update(Request $request, string $id)
    {
        // Validate data
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'gender' => 'required',
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Find user by ID
        $user = User::findOrFail($id);

        // Update user attributes
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Update foto jika ada
        if ($request->hasFile('url_foto')) {
            // Hapus foto lama jika ada
            if ($user->avatar) {
                Storage::delete('public/images/' . $user->avatar);
            }

            // Simpan foto baru ke storage
            $path = $request->file('url_foto')->store('images', 'public');

            // Ambil nama file dari path baru untuk disimpan di database
            $fileName = basename($path);
            $user->avatar = $fileName;

        }

        // Simpan perubahan
        $user->save();
        return view('admin.profile',['user' => $user]);
    }



}
