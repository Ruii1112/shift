<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpreadSheetController extends Controller
{
    public function store()
    {
        $sheets = \App\SpreadSheet::instance();
        $sheet_id = '1oUzVYRxG3lq0ftuF8w7h5VypnSt_19E_wVW5cwyAQGo';
        $faker = \Faker\Factory::create('ja_JP');
        
        for($i = 0 ; $i < 5 ; $i++) {
        
            $customer_name = $faker->name;
            $product_id = array_rand([1, 2, 3]);
            $qty = array_rand([3, 5, 10]);
            $amount = array_rand([1000, 5000, 10000]);
        
            $order = [
                $customer_name,            // お客さんの名前
                $product_id,               // 商品ID
                now()->toDateTimeString(), // 注文日時（今の時間）
                $amount,                   // 値段
                $qty,                      // 個数
                8,                         // 税金
                '=D:D*E:E',                // 小計
                '=G:G*(1+F:F*0.01)'        // 合計（小計 + 税額）
            ];
        
            $values = new \Google_Service_Sheets_ValueRange();
            $values->setValues([
                'values' => $order
            ]);
            $params = ['valueInputOption' => 'USER_ENTERED'];
            $sheets->spreadsheets_values->append(
                $sheet_id,
                'A1',
                $values,
                $params
            );
        
        }
        return redirect('/user/index');
    }
}
