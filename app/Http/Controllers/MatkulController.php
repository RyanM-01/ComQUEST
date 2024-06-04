<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class MatkulController extends Controller
{
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
            'url_foto' => 'nullable|image|max:2048',
        ]);

        $matkulData = $request->all();

        if ($request->hasFile('url_foto')) {
            $path = $request->file('url_foto')->store('images', 'public');
            $fileName = basename($path);
            $matkulData['picture'] = $fileName;
        }

        Matkul::create($matkulData);

        return redirect()->route('admin.dashboard')->with('success', 'Matkul created successfully.');
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

        if ($request->hasFile('url_foto')) {
            // Delete old picture if exists
            if ($matkul->picture && $matkul->picture != 'default.jpeg') {
                Storage::delete('public/images/' . $matkul->picture);
            }

            // Store new picture
            $path = $request->file('url_foto')->store('images', 'public');
            $fileName = basename($path);
            $matkulData['picture'] = $fileName;
        }

        $matkul->update($matkulData);

        return redirect()->route('admin.dashboard')->with('success', 'Matkul updated successfully.');
    }

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Matkul deleted successfully.');
    }
}
