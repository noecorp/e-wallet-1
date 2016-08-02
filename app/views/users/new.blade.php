@extends('layouts.app')

@section('head')
	<link href="{{ url('css/image-uploader.css') }}" rel="stylesheet" >
@stop

@section('content')
	{{-- <div class="page-head">
		<!-- BEGIN PAGE TITLE -->
	    <div class="page-title">
	        <h1>Users
	            <small>All</small>
	        </h1>
	    </div>
	</div><!-- end of page-head --> --}}
	
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-users font-green"></i>
				<span class="caption-subject font-green bold uppercase">New User</span>
			</div>
			<div class="actions">
				<a href="{{ url('admin/users') }}" class="btn btn-circle btn-default">
					<i class="icon-users"></i>
					All Users
				</a>
			</div>
		</div><!-- end of portlet-body -->

		<div class="portlet-body">
			<form action="{{ url('admin/users/new') }}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				<p class="hint"> Personal Details: </p>
				<div class="form-group">
					<label for="" class="control-label">Full Name</label>
					<input type="text" name="name" placeholder="Full Name" class="form-control" value="{{ Input::old('name') }}">
				</div>

				<div class="form-group">
					<label for="" class="control-label">E-mail</label>
					<input type="email" name="email" placeholder="E-mail" class="form-control" value="{{ Input::old('email') }}">
				</div>

				<div class="form-group">
					<label for="" class="control-label">Phone</label>
					<input type="tel" name="phone" placeholder="Phone" class="form-control" value="{{ Input::old('phone') }}">
				</div>

				<div class="form-group">
					<label for="" class="control-label">Profile Picture</label>
					{{ AppHelpers::imageUploadInput('image') }}
				</div>

				<p class="hint"> Password Details: </p>

				<div class="row">
					<div class="form-group col-md-6">
						<label for="" class="control-label">Password</label>
						<input type="password" name="password" placeholder="Password" class="form-control">
					</div>

					<div class="form-group col-md-6">
						<label for="" class="control-label">Password Confirmation</label>
						<input type="password" name="password_confirmation" placeholder="Re-type Your Password" class="form-control">
					</div>
				</div>

				<div class="clearfix">
					<button class="pull-right btn btn-primary" type="submit">Save</button>
				</div>

			</form>		
	
		</div>
	</div><!-- end of portlet -->

@include('common.image-uploader')
@stop