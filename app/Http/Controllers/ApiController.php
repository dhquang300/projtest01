<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use App\Wager;
use App\Purchase;
// use App\Http\Requests\UserWagerRequest;

class ApiController extends Controller
{
    public function getListWager(Request $request) {
         $wager = new Wager;
         $page = $request->has('page') ? $request->get('page') : 1;
         $limit = $request->has('limit') ? $request->get('limit') : 5;
         return $wager->limit($limit)->offset(($page - 1) * $limit)
         ->select('wager_id AS id', 'total_wager_value', 'odds', 'selling_percentage', 'selling_price',
            'current_selling_price', 'percentage_sold', 'amount_sold', 'placed_at')
         ->get()->toArray();
    }

    public function createPlaceWager(Request $request) {
        $validator = Validator::make($request->all(), [
            'total_wager_value' => 'required|gt:0',
            'odds' => 'required|gt:0',
            'selling_percentage' => 'required|gte:1|lte:100',
            'selling_price' => 'required|gt:0'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        
        if($request->selling_price <= $request->total_wager_value * ($request->selling_percentage/100))
        {
            $error = '{"selling_price": ["The selling price must be greater than total wager value * (selling percentage / 100)"]}';
            return response()->json(['errors' => json_decode($error)], 422);
        }
        
          $wager = new Wager;
          $wager->total_wager_value = $request->total_wager_value;
          $wager->odds = $request->odds;
          $wager->selling_percentage = $request->selling_percentage;
          $wager->selling_price = $request->selling_price;
          $wager->placed_at = date('Y-m-d H:i:s');
          $wager->save();
          return response()->json($wager, 201);
    }

    public function createBuyWager(Request $request, $wager_id) {
        $validator = Validator::make($request->all(), [
            'buying_price' => 'required|gt:0',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 422);
        }
        try{
            //Begin transaction handing
            DB::beginTransaction();
            //Step 1: regist to table 'purchase'
            $purchase = new Purchase;
            $purchase->wager_id = $wager_id;
            $purchase->buying_price = $request->buying_price;
            $purchase->bought_at = date('Y-m-d H:i:s');
            $purchase->save();
            //Step 2: Update to table 'wager'
            $wager = DB::table('wager')->where(['wager_id'=>$wager_id])->first();
            $sum_buying_price = DB::table('purchase')->where(['wager_id'=>$wager_id])->sum('buying_price');
            $percentage_sold = round($sum_buying_price / $wager->selling_price*100,0);
            
            if($wager->selling_price - $sum_buying_price < 0){
                DB::rollBack();
                $error = '{"selling_price": ["SUM(bought wagers) can never total more than selling price"]}';
                return response()->json(['errors' => json_decode($error)], 422);
            }
            
            DB::table('wager')->where(['wager_id'=>$wager_id])
            ->update(
            ['current_selling_price' => $wager->selling_price - $sum_buying_price,
            'percentage_sold' => $percentage_sold,
            'amount_sold' => $sum_buying_price
            ]
            );
            // current_selling_price = selling_price - SUM(bought wagers)
            //Handing commit
            DB::commit();
            return response()->json($purchase, 201);
        }
        catch (\Exception $e) {
            //Rollback handling when an error occurred
            DB::rollBack();
            return response()->json([
            "error" => $e->getMessage()
            ], 400);
        }
    }
}
