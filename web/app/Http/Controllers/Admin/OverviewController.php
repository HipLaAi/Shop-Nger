<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\Models\User::where('roleid', 2);
        $product = \App\Models\Product::all();
        $saleBill = \App\Models\SaleBill::all();
        $product = \App\Models\Product::all();
        $outOfStock = 0;
        foreach($product as $item){
            if($item->productDetails->sum('quantity') < 50){
                $outOfStock += 1;
            }
        }

        $saleBillNowMonth = \App\Models\SaleBill::whereMonth('created_at',now()->month)->latest()->take(10)->get();
        $userNew = \App\Models\User::where('roleid', 2)->whereMonth('created_at',now()->month)->latest()->take(10)->get();
        $data = \App\Models\SaleBill::selectRaw('MONTH(created_at) as month, SUM(moneytotal) as total')
                                    ->groupByRaw('MONTH(created_at)')
                                    ->pluck('total', 'month')
                                    ->all();

        $dataBestSelling = \App\Models\SaleBillDetail::select('name_product as name', DB::raw('SUM(quantity) as quantity'))
                                            ->groupBy('name_product')
                                            ->orderByDesc(DB::raw('SUM(quantity)'))
                                            ->take(5)
                                            ->get();

        return view('admin.overview.index',compact('dataBestSelling','data','userNew','saleBillNowMonth','outOfStock','user','product','saleBill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
