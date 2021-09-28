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
      div {page-break-inside: auto;}
      table { page-break-inside:auto }
      tr { page-break-inside:avoid; page-break-after:auto }
    }
  
    .border-solid{
      border-style: solid;
      margin : 40px 40px 40px 40px; 
      padding : 5px 5px 15px 15px;
    }

  
  
  
  </style>

  <div style="font-family: Arial, Helvetica, sans-serif;">
    <table>
      <tr>
        <td>
         
          <div class="border-solid">
            <table>
            {{-- HEAD --}}
              
              <tr valign="top">
                <td width="150px">
                  <img src="{{ public_path('lib_report/logo_head.png') }}">
                </td>
                <td align="center">
                  <h2> LAPORAN INVESTIGASI SEMENTARA </h2>
                 Per Tanggal 14/06/2021
                </td>
                <td><?php echo str_repeat("&nbsp;",5);?></td>
              </tr>
              {{-- end HEAD --}}
            </table>
            <hr>
  <table>
    <tr>
      <td colspan="2">
         <h4>INFORMASI POLIS</h4>
      </td>
    </tr>
    <tr valign="top">
      <td>
        <table>
           <tr>
            <td>No.case</td>
            <td> : </td>
            <td style="width:30%">{{$detail->no_case}}</td>
          </tr>
           <tr valign="top">
            <td >Nama Perusahaan</td>
            <td> : </td>
            <td> <?php echo wordwrap($detail->nm_perusahaan,20,"<br>\n")?> </td>
          </tr>
          <tr>
            <td>No.Polis</td>
            <td> : </td>
            <td>{{$detail->no_polis}}</td>
          </tr>
          <tr>
            <td>Nama Tertanggung</td>
            <td> : </td>
            <td>{{$detail->nm_tertanggung}}</td>
          </tr>
          <tr>
            <td>Nama Pemegang Polis</td>
            <td> : </td>
            <td>{{$detail->nm_pemegang_polis}}</td>
          </tr>
          <tr>
            <td>Nama Agen</td>
            <td> : </td>
            <td>{{$detail->nm_pemegang_polis}}</td>
          </tr>
          <tr>
            <td>Uang Pertanggungan</td>
            <td> : </td>
            <td>{{$detail->nm_pemegang_polis}}</td>
          </tr>
        </table>
      </td>
    
      <td>
        <table>
          <tr>
            <td>Tanggal Penerbitan</td>
            <td> : </td>
            <td></td>
          </tr>
          <tr>
            <td>UP Dasar</td>
            <td> : </td>
            <td></td>
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
            <td>{{$detail->usia_polis}}</td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td> : </td>
            <td>{{$detail->alamat_tertanggung}}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  {{-- Informasi Polis --}}
  {{-- informasi Klaim --}}
   <h4> INFORMASI KLAIM</h4>
  <table>
    <tr>
      <td>
        <table style="width:100%">
            <tr>
              <td>Tempat Meninggal</td>
              <td> : </td>
              <td style="width:50%">{{$detail->tempat_meninggal}}</td>
            </tr>
            <tr>
              <td>Tanggal Meningal</td>
              <td> : </td>
              <td style="width:50%">{{$detail->tgl_meninggal}}</td>
            </tr>
            <tr>
              <td>Tanggal Di Rawat</td>
              <td> : </td>
              <td style="width:50%">{{$detail->tgl_meninggal}}</td>
            </tr>
            <tr>
              <td>Diagnosa Utama</td>
              <td> : </td>
              <td style="width:50%">{{$detail->diagnosa_utama}}</td>
            </tr>
        </table>
      </td>
      <td>
        <table>
           <tr>
              <td>Area Investigasi</td>
              <td> : </td>
              <td style="width:30%">{{$detail->area_investigasi}}</td>
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

  {{-- Asuransi Lain --}}
  <table>
    <tr >
      <td colspan ="2">
        Kepemilkan  Asuransi Lain :
      </td>
    </tr>
    <tr>
      <td>
        PRUDENTIAL : N
      </td>
       <td>
        ALLIANZ : N
      </td>
       <td>
        AIA FINANCIAL : N
      </td>
       <td>
        MANULIFE : N
      </td>
       <td>
        PANIN LIFE : N
      </td>
    </tr>
  </table>
    <h5>
      TAMBAHAN INFORMASI LAINNYA :
    </h5>
    <div style="border-style: solid; border-color: blue;
        background-color: black; color: white; padding : 5px 5px 5px 5px">
        {{$detail->informasi_lain}}
    </div>
  </div>

  {{-- UPdate Investigasi --}}
<div class="border-solid" style="page-break-inside:avoid;">
  @foreach ($kategori as $item)
  <?php $no=1; ?>
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
    <?php }?>
    @endforeach
  @endforeach
</div>

  