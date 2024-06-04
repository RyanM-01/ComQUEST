<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LihatQuizController extends Controller
{
    public function index(Bab $bab)
    {
        $user = Auth::user();
        $quizzes = $bab->quizzes;
        return view('user.lihatquiz', compact('bab', 'quizzes','user'));
    }
}
