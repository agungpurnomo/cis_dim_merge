@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
@endsection

@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.js') }}"></script>
    
    <!-- Page JS Plugins -->

    <!-- Page JS Code -->
    <script>
      $(document).ready(function()
        {   
            var html = '<div></div>';
            var id = $('#id').text();
            console.log(id);
            $.ajax
            ({
                url: '{{ url("getdetail") }}'+ '/' + id,
                method: "GET",
                dataType : "json",
                success:function(data)
                {
                    // console.log(data);
                    // $.each(data, function(index) {
                    //     $("#pr_result").append(data[index].dbcolumn);
                    // });

                    // var string1 = JSON.stringify(data);
                    // var parsed = JSON.parse(string1);
                    // $.each(parsed, function(i){
                    //     console.log(data[i]);
                    //     $("#pr_result").append(data[i].id);
                    // })

                    if(data)
                        {
                            for(var i=0; i < data.data.length; i++)
                            {
                                {
                                    // html += '<option value='+data.data[i].id+'>'+data.data[i].id+'</option>';
                                    html +=       // '<div class="block-content">'
                                                // '<p>'+data.data[i].kategori_investigasi+'</p>'
                                                '<p>'+data.data[i].update_investigasi+'</p><hr>'
                                                // '</div>'
                                            
                                    // html += '<p>'+data.data[i].update_investigasi+'</p><hr>';
                                }
                            }
                            $('#updateinvestigasi').html(html);
                        }
                }
            });
        });
    </script>

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light d-print-none">
      <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
          <div class="flex-grow-1">
            <h1 class="h3 fw-bold mb-2">
              Generate Report Sementara
            </h1>
            <h2 class="fs-base lh-base fw-medium text-muted mb-0">
              Report Sementara
            </h2>
          </div>
          <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
              <li class="breadcrumb-item">
                <a class="link-fx" href="javascript:void(0)">Investigasi</a>
              </li>
              <li class="breadcrumb-item" aria-current="page">
                Generate Report Sementara
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    
    <div class="content content-boxed">
      <!-- Invoice -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <div class="block-options">
            <!-- Print Page functionality is initialized in Helpers.onePrint() -->
            <button type="button" class="btn-block-option" onclick="One.helpers('one-print');">
              <i class="si si-printer me-1"></i> Print Report
            </button>
          </div>
        </div>

        <div class="block-content">
          <!-- title report -->
          <div class="container">
            <div class="border title">
              <div class="row mb-2">
                  <!-- logo -->
                  <div class="col-4 fs-sm">
                    <img src="{{ asset('media/photos/logo-dim.png') }}" class="img-fluid w-75"  alt="Responsive image">
                  </div>
                  <!-- END logo -->

                  <!-- title -->
                  <div class="col-8 text-left fs-sm d-flex align-items-center">
                    <h3>LAPORAN INVESTIGASI SEMENTARA</h3>
                  </div>
                  <!-- END Client Info -->
              </div>
            </div>  
            <div class="border push">
              <div class="row">
                <h5>INFORMASI POLIS</h5>
              </div>
            
              <div class="row">
                <p hidden id="id">{{$detail->id}}</p>
                <div class="col">
                  No Case
                </div>
                <div class="col">
                  : {{$detail->no_case}}
                </div>
                <div class="col text-end">
                  Tanggal SPAJ :
                </div>
                <div class="col text-end">
                  {{$detail->tgl_spaj}}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  Nama Perusahaan
                </div>
                <div class="col">
                  : {{$detail->nm_perusahaan}}
                </div>
                <div class="col text-end">
                  Efektif Polis :
                </div>
                <div class="col text-end">
                  {{$detail->tgl_efektif_polis}}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  No Polis
                </div>
                <div class="col">
                  : {{$detail->no_polis}}
                </div>
                <div class="col text-end">
                  Usia Polis :
                </div>
                <div class="col text-end">
                 {{$detail->usia_polis}}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  Nama Tertanggung
                </div>
                <div class="col">
                  : {{$detail->nm_tertanggung}}
                </div>
                <div class="col text-end">
                  Pekerjaan :
                </div>
                <div class="col text-end">
                  {{$detail->pekerjaan}}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  Nama Pemegang Polis
                </div>
                <div class="col">
                  : {{$detail->nm_pemegang_polis}}
                </div>
                <div class="col text-end">
                  Premi :
                </div>
                <div class="col text-end">
                 {{$detail->premi}}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  Nama Agen
                </div>
                <div class="col">
                  : {{$detail->nm_agen}}
                </div>
                <div class="col text-end">
                  Total Premi :
                </div>
                <div class="col text-end">
                  {{$detail->total_premi}}
                </div>
              </div>
              <div class="row push">
                <div class="col">
                  Uang Pertanggungan
                </div>
                <div class="col">
                  : {{$detail->uang_pertanggungan}}
                </div>
                <div class="col text-end">
                  Alamat Tertanggung :
                </div>
                <div class="col text-end">
                  {{$detail->alamat_tertanggung}}
                </div>
              </div>
              <hr>
              <div class="row">
                <h5>INFORMASI KLAIM</h5>
                
              </div>
              
              <div class="row">
                <div class="col">
                  Tempat Meninggal
                </div>
                <div class="col">
                  : {{$detail->tempat_meninggal}}
                </div>
                <div class="col text-end">
                  Jenis Klaim :
                </div>
                <div class="col text-end">
                  {{$detail->jenis_klaim}}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  Tanggal Meninggal
                </div>
                <div class="col">
                  : {{$detail->tgl_meninggal}}
                </div>
                <div class="col text-end">
                  Tempat Perawatan :
                </div>
                <div class="col text-end">
                  {{$detail->tempat_perawatan}}
                </div>
              </div>
              <div class="row">
                <div class="col">
                  Tanggal Dirawat
                </div>
                <div class="col">
                  : {{$detail->tgl_dirawat_dr}} sd {{$detail->tgl_dirawat_smp}}
                </div>
                <div class="col text-end">
                  Area Investigasi :
                </div>
                <div class="col text-end">
                  {{$detail->area_investigasi}}
                </div>
              </div>
              <div class="row push">
                <div class="col">
                  Diagnosa Utama
                </div>
                <div class="col">
                  : {{$detail->diagnosa_utama}}
                </div>
                <div class="col text-end">
                  Provinsi :
                </div>
                <div class="col text-end">
                {{$detail->provinsi}}
                </div>
              </div>

              <div class="row">
                <h5>TAMBAHAN INFORMASI LAINNYA</h5>
                <div class="border infolain">
                  <p>{{$detail->informasi_lain}}</p>
                </div>
              </div>
            </div>

            <div class="border push">
              <p id="updateinvestigasi">

              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- END Invoice -->
    </div>
    <!-- END Page Content -->

    <style>
      .col{
        font-size:14px;
      }

      .p{
        font-size:14px;
      }

      .border{
        padding: 25px 25px 25px;
      }

      .border.title{
        padding: 5px 5px 5px;
      }

      .border.infolain{
        padding: 5px 5px 5px;
      }


    </style>

    
@endsection
