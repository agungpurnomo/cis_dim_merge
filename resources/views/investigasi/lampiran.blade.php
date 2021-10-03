@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>


    <script>One.helpersOnLoad(['js-flatpickr']);</script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_forms_validation.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>          
        $("#createForm").on("submit",function(e){
            e.preventDefault()
            var id = $("#investigasi_id").val()
            var data = $(this).serialize();
            console.log(data);
            // alert('tes');
            // const alert = One.helpers('jq-notify', 
            //         {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
            $.ajax({
                url: "{{ route('updateinvestigasi.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success:function(){
                    One.helpers('jq-notify', 
                     {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil disimpan!'});
                     window.location.href = "/investigasi/"+id+"/detail"
                }
            })
        })
    </script>

    <!-- <script src="{{ asset('js/pages/tables_datatables.js') }}"></script> -->
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/pages/be_forms_validation.min.js')}}"></script>


@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-2">
                        Lampiran Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        No Case :<b>{{$data->no_case}}</b> | {{$data->nm_perusahaan}}
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{route('investigasi')}}">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Lampiran Investigasi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Lampiran Investigasi
                </h3>
                <button type="button" type="button" class="btn btn-alt-primary  btn-sm" data-bs-toggle="modal" data-bs-target="#modal-upload">
                    <i class="fa fa-plus text-info me-1"></i>Add Lampiran
                </button>  
            </div>
            
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th class="text-center" style="width: 15%;">Title</th>
                            <th class="text-center" style="width: 15%;">Lampiran/Foto</th>
                            <th class="text-center" class="d-none d-sm-table-cell">Keterangan</th>
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
     
            </div>
            
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->

     <!-- modal upload foto -->
     <div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Upload File</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">
                    <form id="upload-lampiran" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="row push">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Judul Foto</label>
                                    <input required class="form-control" type="text" name="judul" id="judul" placeholder="Title image">
                                </div>
                                <div class="form-group">
                                    <input hidden class="form-control" type="text"  id="ids" name="id" >
                                    <input required class="form-control" type="file" name="images[]" id="images" placeholder="Choose images" multiple >
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Keterangan</label>
                                    <textarea class="form-control" type="text" name="keterangan" id="keterangan" rows="4" placeholder="Keterangan"></textarea>
                                </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="mt-1 text-center">
                                <div class="show-multiple-image-preview"> </div>
                            </div>  
                        </div> -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-alt-primary mt-2" id="btnupload">Upload</button>
                        </div>
                    </div>     
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end modal upload foto -->

    
@endsection
