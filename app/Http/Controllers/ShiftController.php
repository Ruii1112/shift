<?php

namespace App\Http\Controllers;

use DateTime;
use App\Shift;
use App\User;
use App\Time;
use App\Comment;
use Illuminate\Http\Request;
use Yasumi\Yasumi;

class ShiftController extends Controller
{
    public function index()
    {
        return view("shifts/index");
    }
    
    public function user(User $user)
    {
        return view('shifts/member')->with(['users' => $user->get(), 'keyword1'=>'', 'keyword2'=>'']);
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
    
    public function user_edit(User $user)
    {
        return view('shifts/member_edit')->with(['user'=>$user]);
    }
    
    public function user_update(Request $request, User $user)
    {
        $input = $request['user'];
        $user->fill($input)->save();
        return redirect('/user');
    }
    
    public function user_delete(User $user)
    {
        $user->delete();
        return redirect('/user');
    }
    
    public function user_search(Request $request, User $user)
    {
        $input1 = $request['keyword1'];
        $input2 = $request['keyword2'];
        
        $query = User::query();
        
        if (!empty($input1) and !empty($input2)){
            $query->where('first_name', 'LIKE', "%{$input1}%")->where('last_name', 'LIKE', "%{$input2}%");
        }else if (!empty($input1)){
            $query->where('first_name', 'LIKE', "%{$input1}%");
        }else if (!empty($input2)){
            $query->where('last_name', 'LIKE', "%{$input2}%");
        }
        
        $user = $query->get();
 
        return view('shifts/member')->with(['users' => $user, 'keyword1'=> $input1, 'keyword2'=>$input2]);
    }
    
    public function make(Shift $shift){
        return view('shifts/make')->with(['shifts'=>$shift->where('starting',1)->get()]);
    }
    
    public function create(){
        return view('shifts/create');
    }
    
    public function shift_store(Request $request, Shift $shift)
    {
        $input = $request['shift'];
        $shift->fill($input)->save();
        return redirect('/make');
    }
    
    public function finish(Shift $shift){
        $shift->starting = 0;
        $shift->save();
        return view('shifts/make')->with(['shifts'=>$shift->where('starting',1)->get()]);
    }
    
    public function shift_check(Request $request, Shift $shift)
    {
        $input = $request['shift'];
        $date = [];
        $now = new DateTime($input['start_date']);
        $year = $now->format('Y');
        $holiday = Yasumi::create('Japan', $year,'ja_JP');
        //dd($now->format('w'));
        dd((new DateTime($input['start_date']))->format('w'));
        for ($i = $input['start_date']; $i < $input['end_date']; $i++){
            $date[] = $i;
            if ($holiday->isHoliday(new DateTime($i)))
            {
                
            }
        }
        $now = new DateTime();
        
        //dd($holiday->isHoliday(new DateTime($i)));
        dd($holiday);
        return view('shifts/check')->with(['dates'=>$date, 'time'=>$input]);
    }
}