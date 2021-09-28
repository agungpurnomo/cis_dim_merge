<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Updateinvestigasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigasi_id','tanggal','kategoriinvestigasi_id','investigator_id','update_investigasi','user_id'
    ];

    public function invest() {
        return $this->belongsTo(Investigasi::class);
    }

    public function kategori(){
        return $this->hasMany(KategoriInvestigasi::class);
    }
}
