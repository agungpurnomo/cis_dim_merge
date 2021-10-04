<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LampiranFoto;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Auth;
use Validator;

class LampiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLampiranFoto($id)
    {
        if(request()->ajax())
        {
            $data = LampiranFoto::findOrFail($id)
                    ->select('*')
                    ->where('investigasis.id', $id )
                    ->get();
            
            return DataTables::of($data)
            ->addIndexColumn()        
                ->addColumn('action', function($row){
                    $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit"
                           data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>';
                    $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-update"
                            data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                    return $btn;
            })
            ->escapeColumns([])
            ->make(true);
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
