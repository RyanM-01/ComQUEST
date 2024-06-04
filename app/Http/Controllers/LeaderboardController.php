<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index(){

        $user = Auth::user();
        return view('user.leaderboard',['user' => $user]);
    }
}
