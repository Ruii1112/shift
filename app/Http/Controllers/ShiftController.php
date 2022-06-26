<?php

namespace App\Http\Controllers;

use DateTime;
use App\Shift;
use App\User;
use App\Time;
use App\Comment;
use App\ShiftTime;
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
        return view('shifts/member')->with(['users' => $user->get(), 'first_name'=>'', 'last_name'=>'']);
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
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        
        $query = User::query();
        
        if (!empty($first_name) and !empty($last_name)){
            if (preg_match("/^[あ-ゞ]+$/u", $first_name) and preg_match("/^[あ-ゞ]+$/u", $last_name)){
                $query->where('first_name_kana', 'LIKE', "%{$first_name}%")->where('last_name_kana', 'LIKE', "%{$last_name}%");
            }else{
                $query->where('first_name', 'LIKE', "%{$first_name}%")->where('last_name', 'LIKE', "%{$last_name}%");
            }
        }else if (!empty($first_name)){
            if (preg_match("/^[あ-ゞ]+$/u", $first_name)){
                $query->where('first_name_kana', 'LIKE', "%{$first_name}%");
            }else{
                $query->where('first_name', 'LIKE', "%{$first_name}%");
            }
        }else if (!empty($last_name)){
            if (preg_match("/^[あ-ゞ]+$/u", $last_name)){
                $query->where('last_name_kana', 'LIKE', "%{$last_name}%");
            }else{
                $query->where('last_name', 'LIKE', "%{$last_name}%");
            }
        }
        
        $user = $query->get();
 
        return view('shifts/member')->with(['users' => $user, 'first_name'=> $first_name, 'last_name'=>$last_name]);
    }
    
    public function make(Shift $shift){
        return view('shifts/make')->with(['shifts'=>$shift->where('starting',1)->get()]);
    }
    
    public function create(){
        return view('shifts/create');
    }
    
    public function shift_store(Request $request, Shift $shift, ShiftTime $shifttime)
    {
        $input = $request['shift'];
        $num = (count($input) - 1) / 3;
        $shift->fill($input)->save();
        $id = $shift->id;
        //dd($input);
        for($i = 0; $i < $num; $i++){
            $shifttime->fill(['date'=>$input[$i.'_date'], 'start_time'=>$input[$i.'_start_time'], 'end_time'=>$input[$i.'_end_time'], 'shift_id'=>$id])->save();
            $shifttime = new ShiftTime();
        }
        //$shifttime->fill
        //dd($shift->id);
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
        $name = $input['name'];
        $date = [];
        $now = new DateTime($input['start_date']);
        $year = $now->format('Y');
        $holiday = Yasumi::create('Japan', $year,'ja_JP');
        //dd(date($input['end_date'], strtotime("+1 day")));
        //dd((new DateTime($input['start_date']))->format('w'));
        for ($i = $input['start_date']; $i <= $input['end_date']; $i++){
            if ($holiday->isHoliday(new DateTime($i)) or (new DateTime($i))->format('w') == 0 or (new DateTime($i))->format('w') == 6)
            {
                $date[] = array('date'=>$i, 'start_time'=>$input['holiday_start_time'],'end_time'=>$input['holiday_end_time']);
            }else
            {
                $date[] = array('date'=>$i, 'start_time'=>$input['weekday_start_time'],'end_time'=>$input['weekday_end_time']);
            }
        }
        //dd($name);
        //$now = new DateTime();
        
        //dd($holiday->isHoliday(new DateTime($i)));
        //dd($holiday);
        return view('shifts/check')->with(['dates'=>$date, "name"=>$name]);
    }
}