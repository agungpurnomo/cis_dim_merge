<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investigasi;
use App\Models\Updateinvestigasi;
use App\Models\FotoInvestigasi;
use App\Models\KategoriInvestigasi;
use App\Models\Investigator;
use Illuminate\Support\Facades\DB;
use Auth;
use File;

class UpdateInvestigasiController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Updateinvestigasi::create($request->all());
    }

    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
     
        if($request->TotalImages > 0)
            { 
                for ($x = 0; $x < $request->TotalImages; $x++) 
                {
      
                    if ($request->hasFile('images'.$x)) 
                     {
                         $file      = $request->file('images'.$x);
      
                         $path = $file->store('public/media');
                         $name = $file->getClientOriginalName();
                         $filename=$file->getClientOriginalName().time().'.'.$file->getClientOriginalExtension();
                         $file->move(public_path() . '/media/photos/', $filename);
      
                         $insert[$x]['judul'] = $request->judul;
                         $insert[$x]['updateinvestigasi_id'] = $request->id;
                         $insert[$x]['path'] = $filename;
                     }
                }
     
            FotoInvestigasi::insert($insert);
            return response()->json(['success'=>'Foto berhasil diupload']);
     
        }
        else
        {
            return response()->json(["message" => "Please try again."]);
        }
    }

    public function viewImg(Request $request,$id)
    {
        // $id = $request->id;
        $data = DB::table('foto_investigasis')
                    ->select('foto_investigasis.*')
                    ->where('updateinvestigasi_id', $id )
                    ->get();
        return response()->json($data);
    }

    public function destroyImg($id){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::user()->id;
        $kategori = KategoriInvestigasi::all();
        $investigator = Investigator::all();
        $data = Investigasi::findOrFail($id)
                    ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                    ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->where('investigasis.id', $id )
                    ->first();
        return view('investigasi.updateinvestigasi',compact('data','kategori','investigator','user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax()) {
            $data = UpdateInvestigasi::FindOrFail($id);
            return response()->json(['data'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UpdateInvestigasi $updateinvestigasi)
    {
        $updateinvestigasi->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Updateinvestigasi::find($id)->delete();
    }
}
