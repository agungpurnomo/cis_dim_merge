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
use Illuminate\Support\Carbon;
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
        $user_id = Auth::user();

        if ($user_id->role =='master'){
            $data = DB::table('investigasis')
            ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->join('investigators','investigasis.investigator_id','=','investigators.id')
            ->join('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                        'users.name as username')
            ->orderBy('created_at', 'DESC')
            ->get();
        }
        if ($user_id->role =='user'){
            $data = DB::table('investigasis')
            ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
            ->join('investigators','investigasis.investigator_id','=','investigators.id')
            ->join('users','investigasis.user_id','=','users.id')
            ->select('investigasis.*','asuransis.nm_perusahaan','investigators.nm_investigator',
                    'users.name as username')
            ->orderBy('created_at', 'DESC')
            ->where('investigasis.user_id',$user_id->id)
            ->get();
        }
        
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
                           data-bs-toggle="tooltip" title="Upload Foto"><i class="fa fa-fw fa-cloud-upload-alt"></i>';
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

    // Temuan

    public function getTemuan(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('temuans')
                    ->where('temuans.investigasi_id',$id);

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('tanggal', function($row){
                        $tgl = date('d-m-Y', strtotime($row->tanggal));
                        return $tgl;
                    })     
                     ->addColumn('action', function($row){
                           
                            $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-temuan"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>';
                            $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-temuan"
                                     data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                            return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }
    // end Temuan

    public function getUangDiselamatkan(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('uangdiselamatkans')
                    ->where('uangdiselamatkans.investigasi_id',$id);

            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                           
                            $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-uangpertanggungan"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>';
                            $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-uangpertanggungan"
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
                           
                            $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-kesimpulan"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>';
                            $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-kesimpulan"
                                     data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                            return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function addKesimpulan(Request $request){
        Kesimpulan::create($request->all());
    }

    public function delKesimpulan($id){
        Kesimpulan::find($id)->delete();
    }

    public function getIdKesimpulan($id){
        $data = Kesimpulan::find($id);
        return response()->json($data);
    }

    public function updateKesimpulan(Request $request){
        $data = Kesimpulan::find($request->id);
        $data->kesimpulan = $request->kesimpulan;
        $data->save();
        return response()->json($data, 200);
    }

    public function getRekomendasi(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('rekomendasis')
            ->where('rekomendasis.investigasi_id',$id);

            return DataTables::of($data)
                    ->addIndexColumn()        
                     ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-edit-rekomendasi"
                                    data-bs-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>';
                        $btn .= '<a href="javascript:void(0)" id="'.$row->id.'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn-delete-rekomendasi"
                                    data-bs-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-times"></i></a></div>';
                           return $btn;
                    })
                    ->escapeColumns([])
                    ->make(true);
        }
    }

    public function addRekomendasi(Request $request){
        Rekomendasi::create($request->all());
    }

    public function delRekomendasi($id){
        Rekomendasi::find($id)->delete();
    }

    public function getIdRekomendasi($id){
        $data = Rekomendasi::find($id);
        return response()->json($data);
    }

    public function updateRekomendasi(Request $request){
        $data = Rekomendasi::find($request->id);
        $data->rekomendasi = $request->rekomendasi;
        $data->save();
        return response()->json($data, 200);
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
        $user = Auth::user();
        $asuransi = Asuransi::all();
        $detail = Investigasi::find($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('jenis_claims','investigasis.jenisclaim_id','=','jenis_claims.id')
                ->join('users','investigasis.user_id','=','users.id')
                ->select('investigasis.*','asuransis.id as asuransi_id','asuransis.nm_perusahaan',
                         'asuransis.kd_perusahaan','investigators.id as investigator_id',
                         'investigators.nm_investigator','jenis_claims.id as jenisklaim_id',
                         'jenis_claims.jenis_klaim','users.name as username')
                ->where('investigasis.id', $id )
                ->first();

        return view('investigasi.detail',compact('detail','asuransi','user'));
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
        $data = Investigasi::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json($data, 200);
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

         $data = Investigasi::findOrFail($id)
                ->join('asuransis','investigasis.asuransi_id','=','asuransis.id')
                ->join('investigators','investigasis.investigator_id','=','investigators.id')
                ->join('updateinvestigasis','investigasis.id','=','updateinvestigasis.investigasi_id')
                ->join('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
                ->select('updateinvestigasis.*','updateinvestigasis.id as id_upin','kategori_investigasis.*')
                ->where('investigasis.id', $id )
                ->get();
                
        $kategori = DB::table('updateinvestigasis as u')
                ->join('kategori_investigasis as k','k.id','=','u.kategoriinvestigasi_id')
                ->select('k.*')
                ->where('u.investigasi_id', $id )
                ->groupBy('k.id')
                ->get();

                $pdf = PDF::loadview('investigasi.generate_report_sementara_fix',
                compact('asuransi','detail','data','kategori'))
                // compact('asuransi','detail','data','kategori','foto','rekomendasi','kesimpulan'))
        ->setPaper('letter','potrait');
        return $pdf->stream('laporan_investigasi_sementara_');
        // return view('investigasi.generate_report_sementara_fix',compact('detail','asuransi'));

        // $pdf = PDF::loadview('investigasi.generate_report_sementara',compact('detail','asuransi'))
        // ->setPaper('letter','potrait');
        // return $pdf->stream('laporan-invesementara-pdf');
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
                ->select('updateinvestigasis.*','updateinvestigasis.id as id_upin','kategori_investigasis.*')
                ->where('investigasis.id', $id )
                ->get();
        // dd($data);
        // DB::enableQueryLog() ;
        $kategori = DB::table('updateinvestigasis as u')
                    ->join('kategori_investigasis as k','k.id','=','u.kategoriinvestigasi_id')
                    ->select('k.*')
                    ->where('u.investigasi_id', $id )
                    ->groupBy('k.id')
                    ->get();
        // dd($kategori);
        // dd(DB::enableQueryLog());
        $foto =  DB::table('updateinvestigasis as u')
                    ->join('foto_investigasis as f','u.id','=','f.updateinvestigasi_id')
                    ->select('u.*','f.*')
                    ->where('u.investigasi_id', $id )
                    ->get();
        // dd($foto);
        // 
        // rekomendasi
        $rekomendasi = DB::table('rekomendasis')
        ->where('rekomendasis.investigasi_id',$id)
        ->get();
        
        //kesimpulan
        $kesimpulan = DB::table('kesimpulans')
        ->where('kesimpulans.investigasi_id',$id)
        ->get();

        //KategoriCount
        $kategoriInvest = DB::table('updateinvestigasis')
        ->leftjoin('kategori_investigasis','kategori_investigasis.id','=','updateinvestigasis.kategoriinvestigasi_id')
        ->where('updateinvestigasis.investigasi_id',$id)
        ->distinct()
        ->get();

        $polislain = DB::table('polislains')
                    ->leftjoin('asuransis','polislains.asuransi_id','=','asuransis.id')
                    ->where('polislains.investigasi_id',$id)
                    ->select('polislains.*','asuransis.nm_perusahaan')
                    ->get();

        
        $pdf = PDF::loadview('investigasi.generate_report',
                compact('asuransi','detail','data','kategori','foto','rekomendasi',
                        'kesimpulan','kategoriInvest','polislain'))
        ->setPaper('letter','potrait');
    	return $pdf->stream('laporan-investigasi-pdf');
    }
}
