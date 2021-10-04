<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProsesKesimpulanSementara;
use App\Models\Investigasi;
use Yajra\DataTables\DataTables;

class ProsesKesimpulanSementaraController extends Controller
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
        ProsesKesimpulanSementara::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data = Investigasi::findOrFail($id)
                    ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                    ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->where('investigasis.id', $id )
                    ->first();

        if ($request->ajax()) {
            $data = DB::table('proses_kesimpulan_sementaras as pks')
                    ->select('pks.*')
                    ->where('pks.investigasi_id',$id)
                    ->get();
            return DataTables::of($data)
                    ->addIndexColumn()        
                    ->addColumn('action', function($row){
                           $btn = '<div class="btn-group"><a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
        return view('investigasi.proseskesimpulansementara',compact('data'));
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
        ProsesKesimpulanSementara::find($id)->delete();
    }
}
