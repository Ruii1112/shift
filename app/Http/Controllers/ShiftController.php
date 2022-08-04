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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    //ログイン時に管理者とユーザを分ける
    public function distinct()
    {
        if (Auth::user()->admin_flg){
            return redirect('/');
        }
        return redirect('/user/index');
    }
    
    //管理者のトップページ表示
    public function index()
    {
        return view("shifts/index");
    }
    
    //管理者用のメンバー一覧画面表示
    public function user(User $user)
    {
        return view('shifts/member')->with(['users' => $user->where('admin_flg','=',0)->get(), 'first_name'=>'', 'last_name'=>'']);
    }
    
    //管理者用のメンバーの新規登録画面表示
    public function user_new()
    {
        return view('shifts/new_member');
    }
    
    //管理者用の新規メンバーをテーブルに登録
    public function user_store(Request $request, User $user)
    {
        //バリデーションチェック開始
        $request->validate([
            'user.first_name' => 'required',
            'user.last_name' => 'required',
            'user.first_name_kana' => 'required|kana',
            'user.last_name_kana' => 'required|kana',
            'user.birth' => 'required',
            'user.sex' => 'required',
            'user.login_id' => 'required',
            'user.password' => 'required',
        ],
        [
            'user.first_name.required' => '苗字が入力されていません',
            'user.last_name.required' => '名前が入力されていません',
            'user.first_name_kana.required' => '苗字が入力されていません',
            'user.first_name_kana.kana' => '苗字がひらがなで入力されていません',
            'user.last_name_kana.required' => '名前が入力されていません',
            'user.last_name_kana.kana' => '名前がひらがなで入力されていません',
            'user.birth.required' => '生年月日が入力されていません',
            'user.sex.required' => '性別が選択されていません',
            'user.login_id.required' => 'ログインIDが入力されていません',
            'user.password.required' => 'パスワードが入力されていません',
        ]);
        //バリデーションチェック終了
        
        $input = $request['user'];
        $input['password'] = Hash::make($input['password']);
        $user->fill($input)->save();
        return redirect('/user');
    }
    
    //管理者用のメンバーの編集画面の表示
    public function user_edit(User $user)
    {
        return view('shifts/member_edit')->with(['user'=>$user]);
    }
    
    //管理者用のメンバーの編集情報をテーブルに再登録
    public function user_update(Request $request, User $user)
    {
        //バリデーションチェック開始
        $request->validate([
            'user.first_name' => 'required',
            'user.last_name' => 'required',
            'user.first_name_kana' => 'required|kana',
            'user.last_name_kana' => 'required|kana',
            'user.birth' => 'required',
            'user.sex' => 'required',
        ],
        [
            'user.first_name.required' => '苗字が入力されていません',
            'user.last_name.required' => '名前が入力されていません',
            'user.first_name_kana.required' => '苗字が入力されていません',
            'user.first_name_kana.kana' => '苗字がひらがなで入力されていません',
            'user.last_name_kana.required' => '名前が入力されていません',
            'user.last_name_kana.kana' => '名前がひらがなで入力されていません',
            'user.birth.required' => '生年月日が入力されていません',
            'user.sex.required' => '性別が選択されていません',
        ]);
        //バリデーションチェック終了
        
        $input = $request['user'];
        $user->fill($input)->save();
        return redirect('/user');
    }
    
    //管理者用のメンバーの削除
    public function user_delete(User $user)
    {
        $user->delete();
        return redirect('/user');
    }
    
    //管理者用のメンバー検索
    public function user_search(Request $request, User $user)
    {
        //htmlから苗字と名前の取得
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        
        //Userテーブルのクエリ作成
        $query = User::query();
        
        //入力されたボックスに何か入っているか判断→入力されたものがひらがなか判断→Userテーブルとマッチするものを探す
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
        
        $user = $query->where('admin_flg', '=', 0)->get();
 
        return view('shifts/member')->with(['users' => $user, 'first_name'=> $first_name, 'last_name'=>$last_name]);
    }
    
    //管理者用のシフト作成画面表示
    public function make(Shift $shift){
        return view('shifts/make')->with(['shifts'=>$shift->where('starting',1)->get()]);
    }
    
    //管理者用の新規シフト作成画面の表示
    public function create(){
        return view('shifts/create');
    }
    
    //管理者の新規シフトの名前をShiftテーブルに保存。日時をShift_timeテーブルに保存
    public function shift_store(Request $request, Shift $shift, ShiftTime $shifttime)
    {
        
        //htmlから情報を取得
        $input = $request['shift'];
        
        //ループの回すための最大値計算
        $num = (count($input) - 1) / 3;
        
        //shiftテーブルに名前を保存
        $shift->fill($input)->save();
        
        //shiftテーブルに保存したレコードのid取得
        $id = $shift->id;
        
        //shift_timeテーブルに日時とshift_idの保存
        for($i = 0; $i < $num; $i++){
            $shifttime->fill(['date'=>$input[$i.'_date'], 'start_time'=>$input[$i.'_start_time'], 'end_time'=>$input[$i.'_end_time'], 'shift_id'=>$id])->save();
            $shifttime = new ShiftTime();
        }
        
        return redirect('/make');
    }
    
    //管理者用の稼働中のシフト募集の停止
    public function finish(Shift $shift){
        $shift->starting = 0;
        $shift->save();
        return view('shifts/make')->with(['shifts'=>$shift->where('starting',1)->get()]);
    }
    
    //管理者用のシフト新規作成の最終編集
    public function shift_check(Request $request, Shift $shift)
    {
         //バリデーションチェック開始
        $request->validate([
            'shift.name' => 'required',
            'shift.start_date' => 'required',
            'shift.end_date' => 'required',
            'shift.weekday_start_time' => 'required',
            'shift.weekday_end_time' => 'required',
            'shift.holiday_start_time' => 'required',
            'shift.holiday_end_time' => 'required',
        ],
        [
            'shift.name.required' => '名前が入力されていません',
            'shift.start_date.required' => '希望の開始日が入力されていません',
            'shift.end_date.required' => '希望の終了日が入力されていません',
            'shift.weekday_start_time.required' => '平日の開始時間が入力されていません',
            'shift.weekday_end_time.required' => '平日の終了時間が入力されていません',
            'shift.holiday_start_time.required' => '休日の開始時間が入力されていません',
            'shift.holiday_end_time.required' => '休日の終了時間が入力されていません',
        ]);
        //バリデーションチェック終了
        
        $input = $request['shift'];
        $name = $input['name'];
        $date = [];
        $now = new DateTime($input['start_date']);
        $year = $now->format('Y');
        $holiday = Yasumi::create('Japan', $year,'ja_JP');
        $youbi_list = ['日','月','火','水','木','金','土','日'];
        $youbi = [];

        //日付をループで回して、その日が土日祝日かどうか判定し、そうだった場合、start_timeとend_timeをそれ用の時間に設定.曜日も格納
        for ($i = $input['start_date']; $i <= $input['end_date']; $i++){
            if ($holiday->isHoliday(new DateTime($i)) or (new DateTime($i))->format('w') == 0 or (new DateTime($i))->format('w') == 6)
            {
                $date[] = array('date'=>$i, 'start_time'=>$input['holiday_start_time'],'end_time'=>$input['holiday_end_time']);
            }else
            {
                $date[] = array('date'=>$i, 'start_time'=>$input['weekday_start_time'],'end_time'=>$input['weekday_end_time']);
            }
            $youbi[] = $youbi_list[(new DateTime($i))->format('w')];
        }
        

        return view('shifts/check')->with(['dates'=>$date, "name"=>$name, 'youbi'=>$youbi]);
    }
    
    //ユーザ用のトップページ表示
    public function user_index(Shift $shift)
    {
        return view('shifts/user_index')->with(["shifts_operation"=>$shift->where("starting", "=", 1)->orderby('created_at','desc')->get(), "shifts_past"=>$shift->where("starting", "=", 0)->orderby('created_at','desc')->get()]);
    }
    
    //ユーザ用のシフト提出画面表示
     public function user_shift(Shift $shift,  ShiftTime $shifttime, Time $time)
    {
        //シフトが提出済みか確認->提出されていたら、提出済用のページに遷移
        $user_id = Auth::user()->id;
        $shift_id = $shift->id;
        if ($time->where('user_id', '=', $user_id)->where('shift_id', '=', $shift_id)->get()->isNotEmpty()){
            return view('shifts/submitted');
        }
        
        $times = $shifttime->where("shift_id", "=", $shift->id)->get();
        $youbi_list = ['日','月','火','水','木','金','土','日'];
        $youbi = [];
        for ($i = 0 ; $i < count($times) ; $i++){
            $youbi[] = $youbi_list[(new DateTime($times[$i]->date))->format('w')]; //曜日を取得し格納
            $tmp = '2000-12-31 '.$times[$i]->start_time; //以下4行、時間をH:i形式に変換
            $times[$i]->start_time = date('H:i',strtotime($tmp));
            $tmp = '2000-12-31 '.$times[$i]->end_time;
            $times[$i]->end_time = date('H:i',strtotime($tmp));
        }

        return view('shifts/user_shift')->with(["times"=>$times, 'shift'=>$shift->id, 'youbi'=>$youbi]);
    }
    
    //ユーザが提出した希望シフトの保存
    public function usertime_store(Request $request, Shift $shift,  ShiftTime $shifttime, Comment $comment, Time $time)
    {
        $input = $request['time'];
        $user_id = Auth::user()->id;
        $shift_id = $input['shift_id'];
        
        $num = (count($input) - 2) / 3;
        //dd($input);
        //ユーザのコメントをcommentテーブルに保存
        if (!empty($input['comment']))
        {
            $comment->fill(['sentence'=>$input['comment'], 'user_id'=>$user_id, 'shift_id'=>$shift_id])->save();
        }
        
        //ユーザの希望時間をtimeテーブルに保存
        for ($i = 0; $i <= $num; $i++)
        {
            if (!empty($input[$i.'_start_time']))
            {
                $time->fill(['date'=>$input[$i.'_date'], 'start_time'=>$input[$i.'_start_time'], 'end_time'=>$input[$i.'_end_time'], 'user_id'=>$user_id, 'shift_id'=>$shift_id])->save();
                $time = new Time;
            }
        }
       
       return redirect('/user/index');
    }
    
    //ユーザ用の過去の希望のページ遷移
    public function user_past(Shift $shift, User $user)
    {
        return view('shifts/user_past')->with(["shifts"=>$shift, "users"=>$user->get()]);
    }
    
    //ユーザ用の過去の希望の閲覧
    public function user_check(Request $request, Shift $shift, User $user, ShiftTime $shifttime, Time $time, Comment $comment)
    {
        $user_id = Auth::user()->id;
        $shift_id = $shift->id;
        $shift_time = $shifttime->where('shift_id', "=", $shift_id)->get();
        $user_time = $time->where('user_id', '=', $user_id)->where('shift_id', '=', $shift_id)->get();
        $youbi_list = ['日','月','火','水','木','金','土','日'];

        $shifts = [];
        
        //日付を1日ずつ回し、その日にユーザが希望を出していたら、その時間を格納し、出していなかったら、nullを格納
        for ($i = 0; $i < count($shift_time); $i++){
            $flag = 0;
            for ($j = 0; $j < count($user_time); $j++){
                if ($shift_time[$i]->date === $user_time[$j]->date){
                    $shifts[] = array('date'=>$user_time[$j]->date, 'youbi'=>$youbi_list[(new DateTime($user_time[$j]->date))->format('w')], 'start_time'=>$user_time[$j]->start_time, 'end_time'=>$user_time[$j]->end_time);
                    $flag = 1;
                    break;
                }
            }
            if ($flag === 0){
                $shifts[] = array('date'=>$shift_time[$i]->date, 'youbi'=>$youbi_list[(new DateTime($shift_time[$i]->date))->format('w')], 'start_time'=>null, 'end_time'=>null);
            }
        }

        $comment_view = $comment->where('user_id', '=', $user_id)->where('shift_id', '=', $shift_id)->get();
        if($comment_view->isEmpty()){
            $comment_view = null;
        }else{
            $comment_view = $comment_view[0]->sentence;
        }
        
        return view('shifts/user_check')->with(['user'=>$user->where('id', '=', $user_id)->get(), 'shift'=>$shift, 'times'=>$shifts, 'comment'=>$comment_view]);
    }
    
    //管理者用のシフト出力ページ表示
    public function output(Shift $shift)
    {
        return view('shifts/output')->with(["shifts"=>$shift->where("starting", "=", 0)->orderby('created_at','desc')->get()]);;
    }
    
    //管理者用のシフト出力（表形式で表示）
    public function output_table(Shift $shift, User $user, ShiftTime $shifttime, Time $time, Comment $comment)
    {
        $all_user = $user->where('admin_flg', '=', 0)->get();
        $date = $shifttime->where('shift_id', '=', $shift->id)->get();
        $user_time = [[]];
        $user_comment = [];
        $youbi_list = ['日','月','火','水','木','金','土','日'];
        $youbi = [];
        
        //日付を1日ずつ回し、その日にユーザが希望を出していたら、その時間を格納し、出していなかったら、nullを格納
        for ($i = 0 ; $i < count($date) ; $i++){
            for ($j = 0 ; $j < count($all_user) ; $j++){
                if ($time->where('user_id', '=', $all_user[$j]->id)->where('shift_id', '=', $shift->id)->where('date', '=', $date[$i]->date)->get()->isNotEmpty()){
                    $tmp = $time->where('user_id', '=',  $all_user[$j]->id)->where('shift_id', '=', $shift->id)->where('date', '=', $date[$i]->date)->get();
                    $user_time[$i][] = $tmp[0]->start_time;
                    $user_time[$i][] = $tmp[0]->end_time;
                }else{
                    $user_time[$i][] = null;
                    $user_time[$i][] = null;
                }
            }
        }
        
        //ユーザのコメントを格納
        for ($i = 0 ; $i < count($all_user) ; $i++){
            if ($comment->where('user_id', '=', $all_user[$i]->id)->where('shift_id', '=', $shift->id)->get()->isNotEmpty()){
                $tmp = $comment->where('user_id', '=', $all_user[$i]->id)->where('shift_id', '=', $shift->id)->get();
                $user_comment[] = $tmp[0]->sentence;
            }else{
                $user_comment[] = null;
            }
        }
        
        $index_date = range(0, count($date) - 1);
        
        $index_user = range(0, count($all_user) * 2 - 1);
        
        for ($i = 0 ; $i < count($date) ; $i++){
            $youbi[] = $youbi_list[(new DateTime($date[$i]->date))->format('w')];
        }
        
        
        return view('shifts/output_table')->with(['shift'=>$shift, 'users'=>$all_user, 'shifttime'=>$date, 'indices_date'=>$index_date, 'youbi'=>$youbi, 'indices_user'=>$index_user, 'user_time'=>$user_time, 'comments'=>$user_comment]);
    }
}