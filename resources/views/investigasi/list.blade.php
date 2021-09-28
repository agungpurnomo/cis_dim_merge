@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
@endsection

@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <!-- <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script> -->

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-2">
                        Investigasi
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Data List Investigasi
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Investigasi</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            List
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
                    LIST DATA INVESTIGASI
                </h3>
                <a href="{{route('registrasi')}}" class="btn btn-alt-success  btn-sm">
                    <i class="fa fa-plus-circle text-info me-1"></i>Registrasi Baru</a>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th class="text-center" style="width: 15%;">No Case & Tgl Reg</th>
                            <th class="text-center" style="width: 15%;">Nama Tertanggung</th>
                            <th class="text-center" class="d-none d-sm-table-cell">Perusahaan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0 ?>
                        @foreach ($data as $datas)
                        <?php $no++ ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td class="text-center">
                                {{$datas->no_case}}
                                {{$datas->tgl_registrasi}}
                            </td>
                            <td>{{$datas->nm_tertanggung}}</td>
                            <td>{{$datas->nm_perusahaan}}</td>
                            <td>
                                @if($datas->status=='1')
                                    <span class="fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success fs-sm">Completed</span>
                                @endif
                                @if($datas->status=='0')
                                    <span class="fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning fs-sm">In Progress</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form method="get" action="/investigasi/{{$datas->id}}/detail">
                                    <button class="btn btn-outline-info btn-sm mr-2" type="submit"><i class="fa fa-info-circle text-info me-1"></i>detail</button>
                                </form>
                                <!-- <a href="" class="btn btn-alt-info me-1  btn-sm">detail</a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->

    
@endsection
