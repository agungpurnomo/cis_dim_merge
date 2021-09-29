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
              <td align="center" style="padding-top:15px;">
                <h2> PENDING INVESTIGASI REPORT </h2>
                    <?php echo $tgl1;?> S/D  <?php echo $tgl2;?>
              </td>
              <td><?php echo str_repeat("&nbsp;",5);?></td>
            </tr>
          </table>
        </div>
      <hr style="border: 1px solid black;">
    </div>
    <div id="footer">footerin on each page</div>
   
      <div id="content">
         <table class="garis" style="padding-top :0px">
           <thead>
              <tr>
                <th>&nbsp;No&nbsp;</th>
                <th>&nbsp;No. Polis&nbsp;</th>
                <th>&nbsp;Nama Tertanggung&nbsp;</th>
                <th>&nbsp;Nama Pemegang Polis&nbsp;</th>
                <th>&nbsp;Efektif Polis&nbsp;</th>
                <th>&nbsp;Uang Pertanggungan&nbsp;</th>
                <th>&nbsp;Jenis Klaim&nbsp;</th>
                <th>&nbsp;Agent&nbsp;</th>
                <th>&nbsp;Investigator&nbsp;</th>
              </tr>
           </thead>
           <tbody>
             <?php $no=1; ?>
             @foreach ($data as $item)
                <tr>
                  <td align="center">&nbsp;<?php echo $no++ ?>&nbsp;</td>
                  <td>&nbsp;{{$item->no_polis}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_tertanggung}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_pemegang_polis}}&nbsp;</td>
                  <td>&nbsp;{{$item->tgl_efektif_polis}}&nbsp;</td>
                  <td>&nbsp;{{$item->matauang}} @currency($item->uang_pertanggungan)&nbsp;</td>
                  <td>&nbsp;{{$item->jenis_klaim}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_agen}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_investigator}}&nbsp;</td>
                </tr>
             @endforeach
           </tbody>
         </table>
      </div>
   
  </body>
</html>
  