<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigasi extends Model
{
    use HasFactory;

    protected $fillable = ['no_case','tgl_registrasi','no_polis','asuransi_id', 'nm_tertanggung','nm_pemegang_polis',
    'nm_agen','alamat_tertanggung','tgl_spaj','tgl_efektif_polis','usia_polis','pekerjaan','matauang','premi',
    'total_premi','tempat_meninggal','tgl_meninggal','diagnosa_utama','tgl_dirawat_dr','tgl_dirawat_smp',
    'jenisclaim_id','rumah_sakit','area_investigasi','provinsi','investigasi_fee','investigator_id',
    'informasi_lain','user_id','uang_pertanggungan','tgl_kirim_dokumen','tambahan_waktu','status'];

    public function updateinvest(){
        return $this->hasMany(Updateinvestigasi::class);
    }
}
