<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EMPST;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function logEmpstData()
    {

        $sampleData = [
            ['month_from' => 0, 'month_to' => 202302, 'did' => 3500, 'level' => 0, 'money' => 23],
            ['month_from' => 0, 'month_to' => 202302, 'did' => 3500, 'level' => 1, 'money' => 66000],
            ['month_from' => 0, 'month_to' => 202302, 'did' => 3500, 'level' => 2, 'money' => 67000],
            ['month_from' => 0, 'month_to' => 202302, 'did' => 3500, 'level' => 3, 'money' => 68000],
            ['month_from' => 202303, 'month_to' => 202305, 'did' => 3500, 'level' => 0, 'money' => 25],
            ['month_from' => 202303, 'month_to' => 202305, 'did' => 3500, 'level' => 1, 'money' => 68000],
            ['month_from' => 202303, 'month_to' => 202305, 'did' => 3500, 'level' => 2, 'money' => 70000],
            ['month_from' => 202303, 'month_to' => 202305, 'did' => 3500, 'level' => 3, 'money' => 80000],
        ];

        $result = [];

        // 年月の増加
        function incrementMonth($month)
        {
            $year = (int)substr($month, 0, 4);
            $mon = (int)substr($month, 4, 2);

            $mon++;

            if ($mon > 12) {
                $mon = 1;
                $year++;
            }

            return sprintf("%04d%02d", $year, $mon);
        }

        foreach ($sampleData as $data) {
            $month_from = $data['month_from'] === 0 ? "202212" : $data['month_from'];
            $month_to = $data['month_to'];
            $did = $data['did'];
            $level = $data['level'];
            $money = $data['money'];

            for ($month = $month_from; $month <= $month_to; $month = incrementMonth($month)) {
                $result[] = [
                    'month' => $month,
                    'did' => $did,
                    'level' => $level,
                    'money' => $money,
                ];
            }
        }

        // 結果の確認（例として出力）
        print_r($result);


        $empsts = EMPST::where('HID', 1)
            ->where('DID', 100)
            ->where('PID', 10)
            ->get();
        // $empsts = EMPST::where('HID', 1)
        //     ->where('DID', 100)
        //     ->where('PID', 10)
        //     ->selectRaw('HID as Hid, DID as Did, PID as Pid, HNM as Hnm')
        //     ->get();

        // データが存在しない場合の処理
        // if ($empst === null) {
        //     Log::info('EMPST データが見つかりませんでした。');
        //     return response()->json(['message' => 'EMPST データが見つかりませんでした。']);
        // }
        $transformedEmpsts = $empsts->map(function ($empst) {
            return [
                'HID' => $empst->HID,
                'DID' => $empst->DID,
                'PID' => $empst->PID,
                'KOSU' => $empst->KOSU,
                'HNM' => $empst->HNM // ここでアクセサが呼び出される
            ];
        });

        Log::info($transformedEmpsts);
        Log::info(json_encode($transformedEmpsts));


        // foreach ($empsts as $empst) {
        //     $hnm = $empst->HNM; // これによって getHNMAttribute が呼び出される
        // }
        // Log::info($empsts);
        // if ($empst) {
        //     $hnm = $empst->HNM;  // これによって getHNMAttribute が呼び出される
        // }
        // Log::info('EMPST データ:', ['empst' => $empst->toArray()]);

        return response()->json(['message' => 'ログに EMPST データが書き込まれました。']);
    }
}
