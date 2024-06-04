<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\Quiz;

class KuisController extends Controller
{
    public function create(Bab $bab)
    {
        return view('admin.quizform', compact('bab'));
    }

    public function store(Request $request, Bab $bab)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bab->quizzes()->create($request->all());
        return redirect()->route('admin.quiz.create', $bab->matkul_id)->with('success', 'Quiz created successfully.');
    }

    public function update(Request $request, Bab $bab, Quiz $quiz)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $quiz->update($request->all());
        return redirect()->route('admin.quiz.create', $bab->matkul_id)->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Bab $bab, Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quiz.create', $bab->matkul_id)->with('success', 'Quiz deleted successfully.');
    }
}
