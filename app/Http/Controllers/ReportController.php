<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investigasi;
use App\Models\KategoriInvestigasi;
use App\Models\Updateinvestigasi;
use App\Models\Investigator;
use App\Models\Asuransi;
use App\Models\JenisClaim;
use App\Models\Provinsi;
use App\Models\Kesimpulan;
use App\Models\Rekomendasi;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pendingCase(Request $request)
    {
        $asuransi=Asuransi::all();
        $data = [];
        if ($request->ajax()) {
            if($request->dr_tgl != '' && $request->smp_tgl != '')
            {
                $data = DB::table('investigasis')
                        ->join('investigators','investigasis.investigator_id','=','investigators.id')
                        ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                        ->select('investigasis.*','investigators.*','jenis_claims.*')
                        ->where('asuransi_id',$request->asuransi)
                        ->whereBetween('tgl_registrasi', array($request->dr_tgl, $request->smp_tgl))
                        ->get();
            }else{
                $data = DB::table('investigasis')
                        ->join('investigators','investigasis.investigator_id','=','investigators.id')
                        ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                        ->select('investigasis.*','investigators.*','jenis_claims.*')
                        // ->where('investigasis.id', $id )
                        ->get();
            }
          
            return DataTables::of($data)
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('reporting.pendingcase',compact('asuransi'));
    }

    public function portofolio(Request $request)
    {
        $asuransi=Asuransi::all();
        if ($request->ajax()) {
            $data = Investigasi::select('*')->orderBy('created_at','DESC');
            return DataTables::of($data)
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('reporting.portofolio',compact('asuransi'));
    }

    public function management(Request $request)
    {
        $asuransi=Asuransi::all();
        if ($request->ajax()) {
            $data = Investigasi::select('*')->orderBy('created_at','DESC');
            return DataTables::of($data)
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('reporting.management',compact('asuransi'));
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
