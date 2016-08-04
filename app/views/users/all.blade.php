@extends('layouts.app')

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
				<span class="caption-subject font-green bold uppercase">Preview Users</span>
			</div>
			<div class="actions">
				<a href="{{ url('admin/users/new') }}" class="btn btn-circle btn-default">
					<i class="icon-user"></i>
					New User
				</a>
			</div>
		</div><!-- end of portlet-body -->

		<div class="portlet-body">
			<div class="reponsive-table">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<td>#</td>
							<td>Image</td>
							<td>Account Id</td>
							<td>Name</td>
							<td>Email</td>
							<td>Phone</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td>#</td>
							<td>Image</td>
							<td>Account Id</td>
							<td>Name</td>
							<td>Email</td>
							<td>Phone</td>
							<td>Actions</td>
						</tr>
					</tfoot>
					<tbody>
						@if($models)
							<?php $count = 0 ?>
							@foreach($models as $model)
								<tr>
									<td>{{ ++$count }}</td>
									<td><img width="75" height="75" src="{{ AppHelpers::getImageUrl($model->featuredImage,75,75) }}" alt="{{ $model->name }}"></td>
									<td>{{ $model->account_id }}</td>
									<td>{{ $model->name }}</td>
									<td>{{ $model->email }}</td>
									<td>{{ $model->phone }}</td>
									<td>
										<div class="dropdown">
										  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										    	Actions
										    	<span class="caret"></span>
										  	</button>
										  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
											    <li><a href="{{ url('user/'.$model->id) }}">Show User</a></li>
											    <li><a href="{{ url('admin/reports/user/'.$model->id) }}">User Report</a></li>
											    <li><a href="{{ url('admin/users/'.$model->id.'/edit') }}">Edit</a></li>
											    <li><a href="{{ url('admin/users/'.$model->id.'/change-password') }}">Change Password</a></li>
											    <li><a href="#" class="delete" data-id="{{ $model->id }}">Delete</a></li>
										  	</ul>
										</div>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div><!-- end of portlet -->

@include('common.delete-modal',['item'=>'User','url'=>url('admin/users/delete')]);
@stop