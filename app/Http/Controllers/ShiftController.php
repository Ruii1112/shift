<?php

namespace App\Http\Controllers;

use App\Shift;
use App\User;
use App\Time;
use App\Comment;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        return view("shifts/index");
    }
    
    public function user(User $user)
    {
        return view('shifts/member')->with(['users' => $user->get()]);
    }
    
    public function user_new()
    {
        return view('shifts/new_member');
    }
    
    public function user_store(Request $request, User $user)
    {
        $input = $request['user'];
        $user->fill($input)->save();
        return redirect('/user');
    }
}
