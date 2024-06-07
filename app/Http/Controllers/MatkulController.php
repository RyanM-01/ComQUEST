<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MatkulController extends Controller
{
    public function usersearch(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');
        
        // Cari Matkul berdasarkan nama atau kode
        $matkuls = Matkul::where('name', 'LIKE', "%$query%")
                        ->orWhere('code', 'LIKE', "%$query%")
                        ->get();

        return view('user.dashboard', ['user' => $user,'matkuls' => $matkuls, 'query' => $query]);
    }

    public function adminsearch(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');
        
        // Cari Matkul berdasarkan nama atau kode
        $matkuls = Matkul::where('name', 'LIKE', "%$query%")
                        ->orWhere('code', 'LIKE', "%$query%")
                        ->get();

        return view('admin.dashboard', ['user' => $user,'matkuls' => $matkuls, 'query' => $query]);
    }


    public function create()
    {
        return view('admin.matkulform');
    }
    //index will take admin to the form that creates a new matkul

    public function store(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:255|unique:matkuls',
        'semester' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    // Cek apakah file foto diunggah
    if ($request->hasFile('foto')) {
        // Store new avatar and update user's avatar path
        $imageName = time().'.'. $request->foto->extension();
        $request->foto->move(public_path('matkulfoto'), $imageName);
    } else {
        // Jika tidak ada foto diunggah, gunakan nilai default atau kosong
        $imageName = '';
    }

    // Create the Matkul
    $matkul = new Matkul;
    $matkul->name = $request->name;
    $matkul->code = $request->code;
    $matkul->semester = $request->semester;
    $matkul->photo = $imageName;

    if ($matkul->save()) {
        return redirect()->route('admin.dashboard')->with('success', 'Matkul created successfully.');
    } else {
        return back()->with('error', 'Failed to create Matkul.');
    }
}




    public function edit(Matkul $matkul)
    {
        return view('admin.matkuledit', compact('matkul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:matkuls,code,' . $id,
            'semester' => 'required|string|max:255',
            'url_foto' => 'nullable|image|max:2048',
        ]);

        $matkul = Matkul::findOrFail($id);
        $matkulData = $request->all();

        // Update avatar if provided
        if ($request->hasFile('url_foto')) {
            // Delete old avatar if exists
            if ($matkul->picture) {
                Storage::delete($matkul->picture);
            }

            // Store new avatar and update user's avatar path
            $imageName = time().$request->file('url_foto')->extension(); // Menggunakan metode extension() pada UploadedFile
            $request->file('url_foto')->move(public_path('matkulfoto'), $imageName);
            $matkul->picture = $imageName;
        }

        $matkul->update($matkulData);

        return redirect()->route('admin.dashboard')->with('success', 'Matkul updated successfully.');
    }

    public function destroy(Matkul $matkul)
    {
        $matkul = Matkul::findOrFail($id);

        $matkul->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Matkul deleted successfully.');
    }
}
