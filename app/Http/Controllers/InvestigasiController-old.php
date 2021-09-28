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
use Validator;

use PDF;

class InvestigasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = DB::table('investigasis')
            ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->join('investigators','investigasis.investigator_id','=','investigators.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('investigasi.list',compact('data','user_id'));
    }

    public function getDetailUpdate($id)
    {
        if(request()->ajax())
        {
            $data = Investigasi::findOrFail($id)
                    ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                    ->join('investigators','investigasis.investigator_id','=','investigators.id')
                    ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                    ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                    // ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator')
                    ->select('updateinvestigasis.*','kategori_investigasis.kategori_investigasi')
                    ->where('investigasis.id', $id )
                    ->get();
            
            return DataTables::of($data)
            ->addIndexColumn()        
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group"><a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-upload" 
                           data-bs-toggle="tooltip" title="Upload Foto"><i class="fa fa-fw fa-cloud-upload-alt"></i></span>';
                    $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-imageview"
                    data-bs-toggle="tooltip" title="View Foto"><i class="fa fa-fw fa-images"></i></a>';
                    $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit"
                           data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>';
                    $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-update"
                            data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                    return $btn;
            })
            ->escapeColumns([])
            ->make(true);
            
        }

        return response()->json(['data' => $data]);
    }


    public function getPolis(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('polislains')
                    ->leftjoin('asuransis','polislains.asuransi_id','=','asuransis.id')
                    ->where('polislains.investigasi_id',$id)
                    ->select('polislains.*','asuransis.nm_perusahaan')
                    ->orderBy('polislains.created_at','DESC');
            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-polis"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function getKesimpulan(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('kesimpulans')
                    ->where('kesimpulans.investigasi_id',$id);

            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-polis"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function getRekomendasi(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('rekomendasis')
            ->where('rekomendasis.investigasi_id',$id);

            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-polis"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
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
    
    public function lastNocase(Request $request)
    {
        if(request()->ajax())
        {
            $asuransi = Asuransi::all();
            $klaim = JenisClaim::all();
            $investigator = Investigator::all();
            $provinsi = Provinsi::all();
            $bulan = date('n');
            $tahun = date ('Y');
            $data = DB::table('investigasis')
                    ->whereMonth('created_at', '=', $bulan)
                    ->whereYear('created_at', '=', $tahun)
                    ->orderBy('id', 'desc')->first();
            // $data = Investigasi::max('no_case');
        }

        return response()->json(['data' => $data]);
    }

    
    public function store(Request $request)
    {
        Investigasi::create($request->all());
    }

    public function registrasi(Request $request)
    {
        $asuransi = Asuransi::all();
        $klaim = JenisClaim::all();
        $investigator = Investigator::all();
        $provinsi = Provinsi::all();
        $user_id = Auth::user()->id;
        return view('investigasi.registrasi',compact('asuransi','klaim','investigator','provinsi','user_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $kategori = KategoriInvestigasi::all();
        $asuransi = Asuransi::all();
        $detail = Investigasi::find($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id','jenis_claims.jenis_klaim')
                ->where('investigasis.id', $id )
                ->first();

        return view('investigasi.detail',compact('detail','asuransi'));
    }


    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asuransi = Asuransi::all();
        $klaim = JenisClaim::all();
        $investigator = Investigator::all();
        $provinsi = Provinsi::all();
        $detail = Investigasi::find($id)
        ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
        ->join('investigators','investigasis.investigator_id','=','investigators.id')
        ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
        ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                 'asuransis.kd_perusahaan','investigators.id as inestigator_id',
                 'investigators.nm_investigator','jenis_claims.id as jenisklaim_id','jenis_claims.jenis_klaim')
        ->where('investigasis.id', $id )
        ->first();

        return view('investigasi.edit',compact('asuransi','klaim','investigator','provinsi','detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investigasi $investigasi)
    {
        $investigasi->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Investigasi::find($id)->delete();
    }

    public function sendApprove($id)
    {
        if(request()->ajax()) {
            $data = Investigasi::FindOrFail($id)->first();
            return response()->json(['data'=>$data]);
        }
    }

    public function updateSendApprove(Request $request, Investigasi $investigasi)
    {
        $investigasi->update($request->all());
    }

    public function generate($id)
    {
        $asuransi = Asuransi::all();
        $detail = Investigasi::find($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id','jenis_claims.jenis_klaim')
                ->where('investigasis.id', $id )
                ->first();
        return view('investigasi.generate_report_sementara',compact('detail','asuransi'));
    }

    public function generateAkhir($id)
    {
        $asuransi = Asuransi::all();
        $detail = Investigasi::find($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id','jenis_claims.jenis_klaim')
                ->where('investigasis.id', $id )
                ->first();

        $data = Investigasi::findOrFail($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                ->select('updateinvestigasis.*','kategori_investigasis.*')
                ->where('investigasis.id', $id )
                ->get();
        // dd($data);
        $kategori = DB::table('updateinvestigasis as u')
                    ->join('kategori_investigasis as k','k.id','=','u.kategoriinvestigasi_id')
                    ->select('k.*')
                    ->where('u.investigasi_id', $id )
                    ->groupBy('k.id')
                    ->get();
        // dd($kategori);
        $foto =  DB::table('updateinvestigasis as u')
                    ->join('foto_investigasis as f','u.id','=','f.updateinvestigasi_id')
                    ->select('u.*','f.*')
                    ->where('u.investigasi_id', $id )
                    ->get();
        // dd($foto);
        
        // rekomendasi
        $rekomendasi = DB::table('rekomendasis')
        ->where('rekomendasis.investigasi_id',$id)
        ->get();
        
        //kesimpulan
        $kesimpulan = DB::table('kesimpulans')
        ->where('kesimpulans.investigasi_id',$id)
        ->get();

        
        $pdf = PDF::loadview('investigasi.generate_report',
                compact('asuransi','detail','data','kategori','foto','rekomendasi','kesimpulan'))
        ->setPaper('letter','potrait');
    	return $pdf->stream('laporan-investigasi-pdf');
    }
}
