@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min.css')}}">
    @endsection
    
@section('js_after')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/oneui.app.min.js') }}"></script>
    
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>
    
    <!-- Page JS Code -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
    </script>

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h2 class="h3 fw-bold mb-2">
                        User Profile
                    </h2>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                      
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Master</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            User
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
    <div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				Email : {{ Auth::user()->email }}
			</div>
			<div class="card-body">
				  <div class="card mb-3" style="max-width: 540px;">
					  <div class="row no-gutters">
					    <div class="col-md-4">
					      <img src="{{ asset('images/backend/adib3.jpg') }}" class="card-img" alt="">
					    </div>
					    <div class="col-md-8">
					      <div class="card-body">
					        <h5 class="card-title">{{ Auth::user()->name }}</h5>
					        
					        <p class="card-text"><small class="text-muted">{{ 'updated at '.\Carbon\Carbon::parse(Auth::user()->updated_at)->diffForHumans() }}</small></p>
					      </div>
					    </div>
					  </div>
					</div>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				Edit Profile
			</div>
			<div class="card-body">
				<form method="POST" action="">
				@csrf
				@method('PATCH')
					<div class="form-group">
						<label for="name">Name</label>
						<input required="" value="{{ Auth::user()->name }}" class="form-control" type="" id="name" name="name">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input required="" value="{{ Auth::user()->password }}" class="form-control" type="hidden" id="old_password" name="old_password">
						<input type="password" id="password" name="password" class="form-control">
						<small class="text-secondary">kosongkan kolom password jika tidak ingin mengubah password</small>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-sm">Update</button>
					</div>
				</form>
			</div>
			<div class="card-footer"></div>
		</div>
	</div>
</div>
    </div>
    <!-- END Page Content -->

    


    


    

    
@endsection
