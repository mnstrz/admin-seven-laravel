@extends('layouts.frontend_page')

@section('content')
	<section class="container-fluid">
		<div class="row">
			<div class="col-12 col-lg-2 sidebar">
				<div class="row pt-3 px-0">
					<div class="col-12 px-0">
						<div class="brand">
							<div class="d-flex flex-row align-items-center justify-content-center">
								@if(AdminSeven::appConfig()->logo)
									<img src="{{ \Storage::url(AdminSeven::appConfig()->logo) }}" width="40px">
								@else
									<img src="{{ asset('admin/images/admin-seven-logo.png') }}" width="40px">
								@endif
								<h5 class="mt-3">{{ AdminSeven::appConfig()->app_name }}</h5>
							</div>
							<div class="d-flex flex-row justify-content-center">
								<small>v 1.0.0</small>
							</div>
						</div>
					</div>
				</div>
				@include('frontend.menu')
			</div>
			<div class="col-12 col-lg-10 bg-grey main-content">
				<div class="row pt-3 mb-2">
					<div class="col-12 text-right">
						<div class="input-group input-group-sm mb-3 float-end" style="width: 200px">
						  <input type="text" class="form-control" placeholder="Search">
						  <button class="btn btn-outline-secondary" type="button">
						  	  <i class="fas fa-search"></i>
						  </button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-lg-10 mx-auto">
						<textarea id="markdown"></textarea>
					</div>
				</div>
				<div class="row py-3 navigation-content">
					<div class="col-12 col-lg-10 mx-auto">
						<div class="d-flex flex-row">
							<div id="prev_doc" class="me-auto">
								<a href="#!" id="link_prev">
									<i class="fas fa-arrow-left"></i> Previous
								</a><br>
								<small>Title</small>
							</div>
							<div id="next_doc" class="ms-auto">
								<a href="#!" id="link_next">
									Next <i class="fas fa-arrow-right"></i>
								</a><br>
								<small>Title</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop
@push('css')
	<style type="text/css">
		.CodeMirror{
			border : none;
		}
		.bg-grey{
			background-color: #fafafa;
			min-height: 100vh;
		}
		pre{
			padding-top: 1rem !important;
			padding-bottom: 1rem !important;
			padding-left: 2rem !important;
		}
	</style>
@endpush