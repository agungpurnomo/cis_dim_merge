
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
    background-color: rgb(8, 152, 235);width: 900px; height: 250px" >
    <table style="color: #ffffff;margin-left: 220px; font-size: 21px; font-display: ">
      <tr align="center">
        <td>
          <h2 style="color: #ffffff;">{{$detail->nm_perusahaan}}</h2>
        </td>
      </tr>
      <tr align="center">
        <td>
          <b>Policy No. {{$detail->no_case}}</b>
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
<table  style="margin-left: 30px;margin-top:32px">
  <tr valign="center">
    <td align="center">
      <p style="font-size: 49px; font-weight: bold"> External <br> Investigasi </p> 
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
<div style="margin-bottom: 80px;  font-family: Arial, Helvetica, sans-serif;">
<h2 style="margin-left: 280px;margin-top:120px">KATA PENGANTAR</h2>
<table style="margin-left: 60px;margin-right: 60px;margin-top:20px">
  <tr>
    <td align ="" style="width: 150px;text-align: justify;">
      Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan oleh <b> {{$detail->nm_perusahaan}} </b>
      kepada PT Deswa Invisco Multitama  (DIM) untuk melakukan  investigasi atas  
      klaim – klaim asuransi yang terjadi, bersama dengan ini pula secara 
       khusus kami menyampaikan laporan akhir hasil investigasi atas klaim 
       <b> No. Polis {{$detail->no_case}} atas  {{$detail->nm_pemegang_polis}}l </b>untuk dapat diterima dengan baik, 
       perlu kami sampaikan bahwa proses investigasi <b> kami lakukan 
       dalam periode 07/07/2021 sd. 20/07/2021 *(diisi sesuai dengan periode investigasi )</b>, 
       dimana proses investigasi ini memerlukan tambahan waktu sehubungan dengan penelusuran  
       pada beberapa faskes di Malaysia dan Singapura. 
      <br><br>
      Perlu kami sampaikan bahwa Investigasi kasus ini <b> melingkupi wilayah *(diisi sesuai wilayah 
      investigasi) </b> untuk mencari dan mendapatkan informasi serta data yang berkaitan dengan Nasabah. 
      Secara lebih lengkap mengenai perjalanan  proses investigasi, temuan dilapangan, 
      kesimpulan hasil investigasi serta rekomendasi keputusan klaim dapat di lihat pada laporan akhir 
      investigasi ini. 
      <br><br>
      Kami berharap agar laporan akhir investigasi ini bisa menjadi dasar serta acuan dalam pengambilan 
      keputusan akhir klaim tersebut. 
      <br><br>	 
      Jika ada informasi atau hal‐hal dalam laporan ini yang  masih perlu untuk dimintakan penjelasan 
      lebih lanjut kami akan dengan senang hati membantu.  
      <br><br>
      Demikian informasi ini kami sampaikan, kami berharap  semoga kerjasama yang terjalin dengan 
      baik selama ini akan terus dapat kita tingkatkan kedepan.
      <br><br>
      Salam,
      <br><br>
      Jakarta, 20 Juli 2021
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
{{-- End Page Kata pengantar --}}

{{-- Star Daftar Isi --}}
<div style="margin-top: 60px; margin-left: 50px; font-family: Arial, Helvetica, sans-serif;">
<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt="">
    </td>
    <td>
      <h2><?php echo str_repeat("&nbsp;",10);?>DAFTRA ISI</h2>
    </td>
  </tr>
</table>
<table style="margin-left: 40px; margin-top: 50px;">
  <tr>
    <td>
      
      1. Pengantar
      <p> 
      2. Daftar Isi
      <p>
      3. Metode Investigasi
      <p>
      4. Informasi Polis & Klaim
      <p>
      5. Hal-Hal Memerlukan Pendalaman
      <p>
      6. Investigasi Lapangan
      <p>
      7. Kesimpulan Investigasi
      <p>
      8. Rekomendasi Keputusan Klaim
      <p>
      9. Lampiran (Suporting Dokumen Investigasi)


    </td>
  </tr>
</table>
</div>
{{-- End Star Daftar Isi --}}

{{-- page metode --}}
{{-- <?php echo str_repeat("<br>",50);?> --}}
<div style="margin-top: 370px"></div>
<div style="margin-top: 60px; margin-left: 50px; font-family: Arial, Helvetica, sans-serif;">

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
<img style="margin-top: 25px;" src="{{ public_path('lib_report/metode.png') }}">
</div>
{{-- end page metode --}}

{{-- page informasi --}}
<div style="margin-top: 230px"></div>
<div style="margin-top: 60px; margin-left: 50px; font-family: Arial, Helvetica, sans-serif;">
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
          <td>675765211982</td>
        </tr>
        <tr>
          <td>UP Dasar</td>
          <td> : </td>
          <td>{{$detail->usia_polis}}</td>
        </tr>
        <tr>
          <td>Plan</td>
          <td> : </td>
          <td>675765211982</td>
        </tr>
        <tr>
          <td>SPAJ</td>
          <td> : </td>
          <td>{{$detail->tgl_spaj}}</td>
        </tr>
        <tr>
          <td>Total Premi</td>
          <td> : </td>
          <td>{{$detail->total_premi}}</td>
        </tr>
        <tr>
          <td>Pekerjaan Tertanggung</td>
          <td> : </td>
          <td>{{$detail->pekerjaan}}</td>
        </tr>
        <tr>
          <td>Usia Polis</td>
          <td> : </td>
          <td>675765211982</td>
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
          <td>Tanggal Meningal</td>
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
          <td>12 September 2021</td>
        </tr>
        <tr>
          <td>Konologi Singkat</td>
          <td> : </td>
          <td>12 September 2021</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<h4><u>PENDALAMAN INVESTIGASI</u></h4>
<table style="margin-right: 25px;">
  <tr>
    <td>
      <b>DIM</b> melakukan  pengecekan pada dokumen klaim, pada Surat Penutupan Asuransi Jiwa (SPAJ) serta indikasi‐indikasi 
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
          “dipakai” sebagai perpanjangan tangan orang‐orang yang mencari keuntungan atas polis tersebut.
        </td>
      </tr>
     <tr valign="top">
        <td>2. </td>
        <td>
          Membuktikan kesesuaian antara informasi yang diberikan pada SPAJ serta fakta‐fakta yang ada dilapangan  
          nantinya, terutama menyangkut penandatanganan SPAJ,financial background,dll. 
        </td>
      </tr>
     <tr valign="top">
        <td>3. </td>
        <td>
          Melakukan 	 pengecekan ke beberapa fasilitas kesehatan yang ada disekitar tempat tinggal 
          Tertanggung termasuk pengecekan pada beberapa faskes di Malaysia dan Singapura untuk 
          mengetahui riwayat perawatan.
        </td>
      </tr>
     <tr valign="top">
        <td>4. </td>
        <td>
          Melakukan  wawancara kepada tetangga dan kepala desa setempat apabila mengetahui 
          mengenai riwayat  kesehatan Tertanggung dan hal‐hal lainnya. 
        </td>
      </tr>
     <tr valign="top">
        <td>5. </td>
        <td>
          Melakukan wawancara kepada Ahli waris untuk mendalami berbagai macam hal mengenai 
          riwayat perawatan serta informasi polis Tertanggung. 
        </td>
      </tr>
</table>
</div>

{{-- end page informasi --}}

{{-- INvestigasi Lapangan --}}
{{-- <div style="margin-top: 230px"></div> --}}
<div style="margin-top: 60px; margin-left: 50px; font-family: Arial, Helvetica, sans-serif;">
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
<p style="font-weight: bold;margin-bottom: 1px;">{{$item->kategori_investigasi}}</p>
  @foreach ($data as $val)
    <?php if ($item->id == $val->kategoriinvestigasi_id) { ?>
      
    
        <table style="margin-right: 55px; text-align: justify">
          <tr>
            <td valign="top"><?php echo $no++; ?>. </td>
            <td>{{$val->update_investigasi}}</td>
           
          </tr>
         
        </table>
       
            <table>
              <?php  
                $arr = [];
                $con = 0;
              ?>
              <tr style="width:300px">
                  @foreach ($foto as $res)
                    <?php if ($val->id == $res->updateinvestigasi_id) { 
                          $picture = $res->file_path;
                          array_push($arr,$res->file_path);
                          $con = count($arr);  
                    ?>
                        <td>
                          <p><img src="{{ public_path('media/photos/'.$picture) }}" alt="" style="width: 250; height: 200"><br/> </p>
                          
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
@endforeach

</div>
{{-- End INvestigasi Lapangan --}}
