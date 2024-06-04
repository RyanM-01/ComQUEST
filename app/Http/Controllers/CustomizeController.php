<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class CustomizeController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('user.customize');

    }
}
