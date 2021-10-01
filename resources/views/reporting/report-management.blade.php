<html>
  <head>
    <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px;  text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -280px; right: 0px; height: 150px; }
    #footer .page:after { content: counter(page, upper-roman); }
      
      
      table.garis{ 
        padding-top: 100px;
        border-collapse: collapse;
        border: 1px solid black;
        font-family: Arial, Helvetica, sans-serif;
      }
      table.garis td{ 
      border-collapse: collapse;
      border: 1px solid black;
    }

    table.garis th{ 
      border-collapse: collapse;
      border: 1.5px solid black;
    }

    td{
      font-size: 14px;
    }
    </style>
  </head>
  <body>
    <div id="header">
        <div style="font-family: Arial, Helvetica, sans-serif;">
          <table style="padding-top: -500px">
            <tr valign="top">
              <td width="150px">
                <img src="{{ public_path('lib_report/logo_head.png') }}">
              </td>
              <td><?php echo str_repeat("&nbsp;",25);?></td>
              <td align="center">
                <h2> MANAGEMENT REPORT </h2>
                    Periode : <b> <?php echo $tgl1;?> S/D  <?php echo $tgl2;?> </b><br>
                    Perusahaan : <b>{{$peru->nm_perusahaan}}</b> 
              </td>
              <td><?php echo str_repeat("&nbsp;",5);?></td>
            </tr>
          </table>
        </div>
      <hr style="border: 2px solid black;">
    </div>
    <div id="footer">DIM | <?php echo date('d/m/Y') ?></div>
   
      <div id="content">
         <table class="garis" style="padding-top :0px">
           <thead>
              <tr>
                <th>No.</th>
                <th>Total Kasus</th>
                <th>Total Temuan Kasus</th>
                <th>Total Tidak Ada Temuan Kasus</th>
                <th>Total Keterlibatan agen</th>
                <th>Indikasi Insurance Shoping</th>
                <th>Uang Pertanggungan</th>
                <th>Uang Pertanggungan Diselamatkan</th>
              </tr>
           </thead>
           <tbody>
             <?php $no=1; ?>
             @foreach ($data as $item)
                <tr>
                  <td align="center">&nbsp;<?php echo $no++ ?>&nbsp;</td>
                  <td align="center">&nbsp;{{$item->tot_kasus}}&nbsp;</td>
                  <td align="center">&nbsp;{{$item->tot_temuan}}&nbsp;</td>
                  <td align="center">&nbsp;{{$item->tidak_ada_temuan}}&nbsp;</td>
                  <td align="center">&nbsp;{{$item->agen}}&nbsp;</td>
                  <td align="center">&nbsp;{{$item->insurance_shop}}&nbsp;</td>
                  <td style="text-align:right;"> @currency($item->uang_per)&nbsp;</td>
                  <td style="text-align:right;"> @currency($item->uang_selamat)&nbsp;</td>
                </tr>
             @endforeach
           </tbody>
         </table>
      </div>
   
  </body>
</html>
  