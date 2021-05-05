<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transfer;
use DB;
class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(["data"=>Transfer::where("t_date","like","$request->month%")->where("t_date","like","%$request->year")->get()]);
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
        $data = $request->validate([
            "t_id"=>"required",
            "t_date"=>"required",
            "t_fname"=>"required",
            "t_mname"=>"required",
            "t_lname"=>"required",
            "t_sname"=>"required",
            "t_kapisanan"=>"required",
            "t_gender"=>"required",
            "t_distrito"=>"required",
            "t_dcode"=>"sometimes|nullable",
            "t_lokal"=>"required",
            "t_lcode"=>"sometimes|nullable",
            "t_status"=>"required"
        ]);
        Transfer::updateOrCreate(["id"=>$request->id],$data);
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
        return response()->json([Transfer::findOrfail($id)]);
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
        return Transfer::destroy($id);
    }

    public function printReport(Request $request)
    {
        $header = $request->status==="In"?"Pinaggalingan na lokal at distrtio":"Lilipatang lokal at distrito";
        $printData=Transfer::where("t_date","like","$request->month%")->where("t_date","like","%$request->year")->where("t_status","=","$request->status")->get();
        $mydate =  date('F', mktime(0, 0, 0, $request->month, 10));
        $year = $request->year;
        $status = $request->status;
        return view("print.print",compact('printData','header','mydate','status','year'));
        // dd(printData);
    }

    public function year()
    {
        return response()->json(Transfer::select("t_date")->distinct("t_date")->get());
    }

    public function filterYear(Request $request)
    {
        return response()->json(Transfer::select("t_date")->distinct("t_date")->where("t_date","like","%$request->year")->get());
    }
    
    public function wholeYear(Request $request)
    {
        return response()->json(DB::table("transfers")->select("t_status",DB::raw("count(t_status) as total"))->groupBy("t_status")->where("t_date","like","%$request->year")->get());
    }

    public function perMonth(Request $request)
    {
        return response()->json([DB::table('transfers')->select("t_status",DB::raw("count(t_status) as total"))->groupBy("t_status")->where("t_date","like","$request->month%")->where("t_date","like","%$request->year")->get()]);
    }
}
