
<style>

/* @page { 
  margin: 10px; 
  margin-top: 0cm;
  margin-bottom: 0cm;

  margin: 0;
  page-break-before: always;
} */


@page {
      size: A4;
      margin: 0;
  }
  
  .page {
      margin: 0;
      page-break-before: always;
  }

  @media print{
    pre, blockquote {page-break-inside: avoid;}
    table { page-break-inside:auto }
    tr { page-break-inside:avoid; page-break-after:auto }
  }

  .border-dot{
    border-style: dotted; 
    padding : 5px 5px 15px 15px;
  }

  .table-polis {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  .td-polis, .th-polis {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  div {
  margin-bottom: 15px;
  padding: 4px 12px;
}

.danger {
  background-color: #ffdddd;
  border-left: 35px solid #f44336;
}

.success {
  background-color: #ddffdd;
  border-left: 35px solid #04AA6D;
}

.info {
  background-color: #e7f3fe;
  border-left: 35px solid #2196F3;
}


.warning {
  background-color: #ffffcc;
  border-left: 35px solid #ffeb3b;
}

</style>

<div style="margin-bottom: 100px; font-family: Arial, Helvetica, sans-serif;">
<table style="margin-top: 90px">
  <tr valign="center">
    <td align="center">
      <H1>LAPORAN AKHIR INVESTIGASI</H1>
    </td>
    <td>
      <img src="{{ public_path('lib_report/logo.png') }}" >
    </td>
  </tr>
</table>


<div style="margin-left: -50px; margin-top: 30px; 
    background-color: #4379aa;width: 900px; height: 250px" >
    <table style="color: #ffffff;margin-left: 220px; font-size: 21px; font-display: ">
      <tr align="center">
        <td>
          <h2 style="color: #ffffff;">{{$detail->nm_perusahaan}}</h2>
        </td>
      </tr>
      <tr align="center">
        <td>
          <b>Policy No. {{$detail->no_polis}}</b>
        </td>
        </tr>
      <tr align="center">
        <td>
          <b>Pemegang Polis : {{$detail->nm_pemegang_polis}}</b>
        </td>
      </tr>
       <tr align="center">
        <td>
          <b>Tertanggung : {{$detail->nm_tertanggung}}</b>
        </td>
       </tr>
    </table>
</div> <br> <br>
<table  style="margin-top:32px">
  <tr valign="center">
    <td align="center">
      <p style="font-size: 49px; font-weight: bold; padding-left:20px;"> External <br> Investigasi </p> 
    </td>
    <td><?php echo str_repeat("&nbsp;",35);?></td>
    <td> 
      <img src="{{ public_path('lib_report/pic_1.png') }}" >
    </td>
  </tr>
</table>
</div>
{{-- page judul end --}}


{{-- star Kata Pengantar --}}
<div class="page" style="margin-top: 80px;  margin-left: 50px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
<h2 style="text-align:center;">KATA PENGANTAR</h2>
<div class="border-dot">
<table style="padding:5px 15px 15px 5px">
  <tr>
    <td align ="" style="width: 150px;text-align: justify;">
      Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan oleh <b> {{$detail->nm_perusahaan}} </b>
      kepada PT Deswa Invisco Multitama  (DIM) untuk melakukan  investigasi atas  
      klaim &#45; klaim asuransi yang terjadi, bersama dengan ini pula secara 
       khusus kami menyampaikan laporan akhir hasil investigasi atas klaim 
       <b> No. Polis {{$detail->no_polis}} atas nama {{$detail->nm_pemegang_polis}}l </b>untuk dapat diterima dengan baik, 
       perlu kami sampaikan bahwa proses investigasi <b> kami lakukan 
       dalam periode {{$detail->tgl_registrasi}} sd. {{$detail->tgl_kirim_dokumen}}</b>, 
       {{$detail->tambahan_waktu}}. 
      <br><br>
      Perlu kami sampaikan bahwa Investigasi kasus ini <b> melingkupi wilayah {{$detail->area_investigasi}} </b> untuk mencari dan mendapatkan informasi serta data yang berkaitan dengan Nasabah. 
      Secara lebih lengkap mengenai perjalanan  proses investigasi, temuan dilapangan, 
      kesimpulan hasil investigasi serta rekomendasi keputusan klaim dapat di lihat pada laporan akhir 
      investigasi ini. 
      <br><br>
      Kami berharap agar laporan akhir investigasi ini bisa menjadi dasar serta acuan dalam pengambilan 
      keputusan akhir klaim tersebut. 
      <br><br>	 
      Jika ada informasi atau hal &#45; hal dalam laporan ini yang  masih perlu untuk dimintakan penjelasan 
      lebih lanjut kami akan dengan senang hati membantu.  
      <br><br>
      Demikian informasi ini kami sampaikan, kami berharap  semoga kerjasama yang terjalin dengan 
      baik selama ini akan terus dapat kita tingkatkan kedepan.
      <br><br>
      Salam,
      <br><br>
      Jakarta, {{$detail->tgl_kirim_dokumen}}
      <br>
      <b>Management PT Deswa Invisco Multitama (DIM)</b> 
      <br><br>
      <img src="{{ public_path('lib_report/ttd.png') }}" alt="">          
      <br>
      <?php echo str_repeat("&nbsp;",14);?><b><u>Suyadi Wahri</u></b>
      <br>
      <?php echo str_repeat("&nbsp;",18);?><b><i>Direktur</i></b>
    </td>
  </tr>
</table>
</div>
</div>
{{-- End Page Kata pengantar --}}

{{-- Star Daftar Isi --}}
<div class="page" style="margin-top: 60px; margin-left: 50px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt="">
    </td>
    <td>
      <h2><?php echo str_repeat("&nbsp;",10);?>DAFTAR ISI</h2>
    </td>
  </tr>
</table>
<div class="border-dot" style="margin-top:30px">
<table style="padding: 5px 15px 15px 5px">
  <tr>
    <td>
      
      1. Pengantar
      <br> 
      2. Daftar Isi
      <br>
      3. Metode Investigasi
      <br>
      4. Informasi Polis & Klaim
      <br>
      5. Hal-Hal Memerlukan Pendalaman
      <br>
      6. Investigasi Lapangan
      <br>
      7. Kesimpulan Investigasi
      <br>
      8. Rekomendasi Keputusan Klaim
      <br>
      9. Lampiran (Suporting Dokumen Investigasi)


    </td>
  </tr>
</table>
</div>
</div>
{{-- End Star Daftar Isi --}}

{{-- page metode --}}
{{-- <?php echo str_repeat("<br>",50);?> --}}
<div class="page" style="margin-top: 50px; margin-left: 50px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
  <table style="margin-left: 25px;">
    <tr>
      <td>
        <img src="{{ public_path('lib_report/logo_head.png') }}" alt="">
      </td>
      <td>
        <h2><?php echo str_repeat("&nbsp;",10);?>METODE INVESTIGASI</h2>
      </td>
    </tr>
  </table>
<!-- <img style="margin-top: 25px;" src="{{ public_path('lib_report/metode.png') }}"> -->
  <div class="metode" style="margin-top:35px; padding-right:30px; padding-left:30px;">
    <h2>Metode Investigasi</h2>
    <div class="danger">
      <p><strong></strong>Pemeriksaan Dokumen Klaim & Polis...</p>
    </div>

    <div class="success">
      <p><strong></strong>Tindak lanjut atas indikasi dari pemeriksaan dokumen klaim & polis...</p>
    </div>

    <div class="info">
      <p><strong></strong>Pengecekan ke lapangan berkaitan dengan RS/Klinik, Instansi pemerintan, dll...</p>
    </div>

    <div class="warning">
      <p><strong></strong>{{$detail->metode_investigasi}}</p>
    </div>
  </div>
</div>
{{-- end page metode --}}

{{-- page informasi --}}
<div class="page" style="margin-top: 50px; margin-left: 50px; margin-right: 50px;font-family: Arial, Helvetica, sans-serif;">
<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt=""> 
    </td>
    <td >
    <h2 style="text-align: center; margin-left : 50px">INFORMASI POLIS, KLAIM & <br>
       PENDALAMAN INVESTIGASI </h2>
    </td>
  </tr>
</table>

<div class="border-dot" style="margin-top:30px;">
<table>
  <tr valign="top">
    <td>
      <h5><u> INFORMASI KLAIM </u></h5>
      <table>
        <tr>
          <td>Policy</td>
          <td> : </td>
          <td>{{$detail->no_polis}}</td>
        </tr>
        <tr>
          <td>Nama Pemegang Polis</td>
          <td> : </td>
          <td>{{$detail->nm_pemegang_polis}}</td>
        </tr>
        <tr>
          <td>Nama Tertanggung</td>
          <td> : </td>
          <td>{{$detail->nm_tertanggung}}</td>
        </tr>
        <tr>
          <td>Tanggal Penerbitan</td>
          <td> : </td>
          <td>{{$detail->tl_efektif_polis}}</td>
        </tr>
        <tr>
          <td>Uang Pertanggungan</td>
          <td> : </td>
          <td>{{$detail->uang_pertanggungan}}</td>
        </tr>
        <tr>
          <td>Plan</td>
          <td> : </td>
          <td></td>
        </tr>
        <tr>
          <td>SPAJ</td>
          <td> : </td>
          <td>{{$detail->tgl_spaj}}</td>
        </tr>
        <tr>
          <td>Premi</td>
          <td> : </td>
          <td>@currency($detail->premi)</td>
        </tr>
        <tr>
          <td>Total Premi</td>
          <td> : </td>
          <td>@currency($detail->total_premi)</td>
        </tr>
        <tr>
          <td>Pekerjaan Tertanggung</td>
          <td> : </td>
          <td>{{$detail->pekerjaan}}</td>
        </tr>
        <tr>
          <td>Usia Polis</td>
          <td> : </td>
          <td>{{$detail->usia_polis}}</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td> : </td>
          <td>{{$detail->alamat_tertanggung}}</td>
        </tr>
      </table>
    </td>
      <td><?php echo str_repeat("&nbsp;",10);?></td>
    <td>
      <h5><u> INFORMASI KLAIM </u></h5>
      <table>
        <tr>
          <td>Tanggal Meninggal</td>
          <td> : </td>
          <td>{{$detail->tgl_meninggal}}</td>
        </tr>
        <tr>
          <td>Tempat Meninggal</td>
          <td> : </td>
          <td>{{$detail->tempat_meninggal}}</td>
        </tr>
        <tr>
          <td>Diagnosa</td>
          <td> : </td>
          <td>{{$detail->diagnosa_utama}}</td>
        </tr>
        <tr>
          <td>Area Investigasi</td>
          <td> : </td>
          <td>{{$detail->area_investigasi}}</td>
        </tr>
        <tr>
          <td>Pengaju Klaim</td>
          <td> : </td>
          <td>{{$detail->pengaju_klaim}}</td>
        </tr>
        <tr>
          <td>Konologi Singkat</td>
          <td> : </td>
          <td>{{$detail->kronologi_singkat}}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>

<h4><u>PENDALAMAN INVESTIGASI</u></h4>
<div class="border-dot">
<table style="margin-right: 25px;">
  <tr>
    <td>
      <b>DIM</b> melakukan  pengecekan pada dokumen klaim, pada Surat Penutupan Asuransi Jiwa (SPAJ) serta indikasi&#45;indikasi 
      lainnya maka ada beberapa hal yang perlu dibuktikan dalam investigasi di lapangan 
      nantinya : 
    </td>
  </tr>
</table>
<table style="margin-right: 55px; text-align: justify">
      <tr valign="top">
        <td>1. </td>
        <td>
          Membuktikan bahwa benar Tertanggung membeli polis asuransi secara mandiri (sendiri) dan bukan  
          “dipakai” sebagai perpanjangan tangan orang&#45;orang yang mencari keuntungan atas polis tersebut.
        </td>
      </tr>
     <tr valign="top">
        <td>2. </td>
        <td>
          Membuktikan kesesuaian antara informasi yang diberikan pada SPAJ serta fakta&#45;fakta yang ada dilapangan  
          nantinya, terutama menyangkut penandatanganan SPAJ,financial background,dll. 
        </td>
      </tr>
      <?php
        $no=2;
      ?>
      @foreach ($pendalaman as $item)
      <?php $no++; ?>
      <tr valign="top">
        <td>{{$no}}.</td>
        <td>
          {{$item->pendalaman}}
        </td>
      </tr>
      @endforeach
</table>
</div>
</div>
{{-- end page informasi --}}

{{-- INvestigasi Lapangan --}}
<div class="page" style="margin-top: 50px; margin-left: 50px; margin-right: 50px;font-family: Arial, Helvetica, sans-serif;">
<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt=""> 
    </td>
    <td >
    <h2 style="text-align: center; margin-left : 50px">INVESTIGASI LAPANGAN</h2>
    </td>
  </tr>
</table>


@foreach ($kategori as $item)
<?php $no=1; ?>
<div class="border-dot" style="margin-top:30px;">
<p style="font-weight: bold;margin-bottom: 1px;">{{$item->kategori_investigasi}}</p>
  @foreach ($data as $val)
    <?php if ($item->id == $val->kategoriinvestigasi_id) { ?>
        <table style="margin-right: 55px; text-align: justify">
          <tr>
            <td valign="top"><?php echo $no++; ?>. </td>
            <td>{{$val->update_investigasi}}
            </td>
          </tr>
        </table>
       
            <table>
              <?php  
                $arr = [];
                $con = 0;
              ?>
              <tr style="width:300px">
                {{$val->investigasi_id}}
                  @foreach ($foto as $res)
                    <?php if ($val->id_upin == $res->updateinvestigasi_id) { 
                          $picture = $res->path;
                          array_push($arr,$res->path);
                          $con = count($arr);  
                    ?>
                        <td>
                          <p><img src="{{ public_path('storage/'.$picture) }}" alt="" style="width: 240; height: 190"><br/> </p>
                          <p align=center;>{{$res->judul}}</p>
                        </td>
                        <?php if ($con==2) { 
                          $con=0;
                        ?>
                          </tr>
                        <?php } ?>
                      
                      <?php } ?>
                  @endforeach
                </tr>
            </table>
   <?php }?>
  @endforeach
</div>
@endforeach

{{-- End INvestigasi Lapangan --}}


{{-- kepemilikan polis --}}

<div  class="page" style="margin-top: 50px; font-family: Arial, Helvetica, sans-serif;">

<div class="border-dot">
  <div style="margin-top:30px;">
      <h4>KEPEMILIKAN POLIS ASURANSI</h4>
  </div>
  <table class="table-polis">
    <tr>
      <th class="th-polis">No</th>
      <th class="th-polis">Perusahaan Asuransi</th>
      <th class="th-polis">Issued Polis</th>
      <th class="th-polis">Uang Pertanggungan</th>
      <th class="th-polis">Klaim</th>
      <th class="th-polis">Keputusan</th>
    </tr>
    <tr>
      <td class="td-polis">1</td>
      <td class="td-polis">{{$detail->nm_perusahaan}}</td>
      <td class="td-polis">{{$detail->no_polis}}</td>
      <td class="td-polis">@currency($detail->uang_pertanggungan)</td>
      <td class="td-polis"></td>
      <td class="td-polis"></td>
    </tr>
    <?php $no=2; ?>
    @foreach ($polislain as $polis)
    <tr>
      <td class="td-polis"><?php echo $no++; ?></td>
      <td class="td-polis">{{$polis->nm_perusahaan}}</td>
      <td class="td-polis"></td>
      <td class="td-polis"></td>
      <td class="td-polis"></td>
      <td class="td-polis"></td>
    </tr>
    @endforeach
  </table>
</div>
{{-- End kepemilikan polis --}}


{{-- kesimpulan --}}

<div class="page" style="margin-top: 50px; font-family: Arial, Helvetica, sans-serif;">
<table>
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt=""> 
    </td>
    <td >
    <h2 style="text-align: center; margin-left : 30px">KESIMPULAN AKHIR INVESTIGASI</h2>
    </td>
  </tr>
</table>

<?php $no=1; ?>
<div style="margin-top:30px;">
    <h4>KESIMPULAN</h4>
</div>
<div class="border-dot">
  <p style="font-weight: bold;margin-bottom:2px;">
  Berdasarkan investigasi yang telah kami lakukan dan juga telah kami jabarkan secara 
  detail diatas berikut ini kami sampaikan kesimpulan akhir investigasi atas case ini sbb :
  </p>
  @foreach ($kesimpulan as $val)
    <div>
    <table style="margin-right: 80px; text-align: justify">
      <tr>
        <td valign="top" style="margin-right: 80px;"><?php echo $no++; ?>. </td>
        <td>{{$val->kesimpulan}}</td>
      </tr>
    </table>
    </div>
  @endforeach
  </div>
    <br>

  <h4>REKOMENDASI KEPUTUSAN KLAIM</h4>
  <?php $no=1; ?>
  <div class="border-dot">
    <p style="font-weight: bold;margin-bottom:3px;">
      Bahwa berdasarkan kesimpulan akhir investigasi yang kami sampaikan sebelumnya, maka berikut
      kami sampaikan rekomendasi keputusan klaim yang dapat diambil lebih lanjut :
    </p>
    @foreach ($rekomendasi as $val)
      <div class="mr-3">
      <table style="margin-right: 80px; text-align: justify">
        <tr>
          <td valign="top"><?php echo $no++; ?>. </td>
          <td>{{$val->rekomendasi}}</td>
        </tr>
      </table>
      </div>
    @endforeach
  </div>
</div>
{{-- End kesimpulan --}}

{{-- lampiran --}}

<div style="page-break-inside: auto; page-break-before:auto; margin-top: 60px; margin-left: 0px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
 
  <?php $no=1;?>
  
    @foreach ($lampiran as $key)
      <div class="page" style="margin-left: 0px; margin-bottom: 100px; margin-top: 50px">
        <h2 style="text-align: center; margin-left : 30px;">LAMPIRAN <?php echo $no++?></h2>
        <p style="font-weight: bold">{{$key->title}}</p>
        <?php $data_img = $key->path;
         $data_img_fix = public_path("storage/$data_img ");
        ?>
        <p><img style="width: 600px; height: 500px;" src="<?php echo $data_img_fix ?>" alt=""></p>
      </div>
    @endforeach
</div>
{{--end lampiran--}}

