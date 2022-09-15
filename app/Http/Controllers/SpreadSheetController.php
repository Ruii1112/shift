<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;
use App\User;
use App\Time;
use App\Comment;
use App\ShiftTime;
use Yasumi\Yasumi;
use DateTime;

class SpreadSheetController extends Controller
{
    public function store(Shift $shift, User $user, ShiftTime $shifttime, Time $time, Comment $comment)
    {
        //各種情報の格納
        $spread_sheets = \App\SpreadSheet::instance();
        $spread_sheet_id = '1oUzVYRxG3lq0ftuF8w7h5VypnSt_19E_wVW5cwyAQGo';
        $response = $spread_sheets->spreadsheets->get($spread_sheet_id);
        $sheets = $response->getSheets();
        
        //シートIDの格納
        foreach ($sheets as $sheet) {
            $properties = $sheet->getProperties();
            $sheet_id = $properties->getSheetId(); 
        }
        
        //クリア
        $body = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => [
                'updateCells' => [
                    'range' => [
                        'sheetId' => $sheet_id
                    ],
                    'fields' => 'userEnteredValue,userEnteredFormat' // データ＆セルの装飾をクリア
                ]
            ]
        ]);
        $spread_sheets->spreadsheets->batchUpdate($spread_sheet_id, $body); //データ＆セルの装飾のクリアを実行
        
        //必要な情報の格納
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
                    $user_time[$i][] = '';
                    $user_time[$i][] = '';
                }
            }
        }
        
        //ユーザのコメントを格納
        for ($i = 1 ; $i <= count($all_user) ; $i++){
            if ($comment->where('user_id', '=', $i)->where('shift_id', '=', $shift->id)->get()->isNotEmpty()){
                $tmp = $comment->where('user_id', '=', $i)->where('shift_id', '=', $shift->id)->get();
                $user_comment[] = $tmp[0]->sentence;
            }else{
                $user_comment[] = null;
            }
        }
        
        //曜日
        for ($i = 0 ; $i < count($date) ; $i++){
            $youbi[] = $youbi_list[(new DateTime($date[$i]->date))->format('w')];
        }
        
        //1行目に代入
        $order = [
                '日付',
                '曜日'
            ];
        
        for($i = 0 ; $i < count($all_user) ; $i++) {
            array_push($order, $all_user[$i]->first_name);
            array_push($order, '');
        }
        
        $values = new \Google_Service_Sheets_ValueRange();
            $values->setValues([
                'values' => $order
            ]);
            $params = ['valueInputOption' => 'USER_ENTERED'];
            $spread_sheets->spreadsheets_values->append(
                $spread_sheet_id,
                'A1',
                $values,
                $params
            );
        
        //2行目以降の代入
        for($i = 0 ; $i < count($date) ; $i++) {
        
            $order = [
                (new DateTime($date[$i]->date))->format('m/d'),            // 日付
                $youbi[$i]               // 曜日
            ];
            for($j = 0 ; $j < count($user_time[0]) ; $j++){
                if($user_time[$i][$j] == ''){
                    array_push($order,'');
                }else{
                    array_push($order,(new DateTime('2000-01-01'.$user_time[$i][$j]))->format('H:i'));
                }
            }
    
            $values = new \Google_Service_Sheets_ValueRange();
            $values->setValues([
                'values' => $order
            ]);
            $params = ['valueInputOption' => 'USER_ENTERED'];
            $spread_sheets->spreadsheets_values->append(
                $spread_sheet_id,
                'A1',
                $values,
                $params
            );
        
        }
        return redirect('/output/'.$shift->id);
    }
}
