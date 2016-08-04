@extends('layouts.app')


@section('content')
	
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-users font-green"></i>
				<span class="caption-subject font-green bold uppercase">New User</span>
				{{-- <span class="caption-subject font-green bold uppercase">{{ Route::getCurrentRoute()->getPath() }}</span> --}}
			</div>
			<div class="actions">
				<a href="{{ url('admin/users') }}" class="btn btn-circle btn-default">
					<i class="icon-users"></i>
					All Users
				</a>
			</div>
		</div><!-- end of portlet-body -->

		<div class="portlet-body">
			<form action="{{ url('admin/users/'.$model->id.'/change-password') }}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="put">
				
				<div class="form-group">
					<label for="" class="control-label">Current Password</label>
					<input type="password" name="old_password" placeholder="Password" class="form-control">
				</div>

				<div class="row">
					<div class="form-group col-md-6">
						<label for="" class="control-label">New Password</label>
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
@stop