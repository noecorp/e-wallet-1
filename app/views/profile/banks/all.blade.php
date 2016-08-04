@extends('layouts.app')

@section('head')
	<link href="{{ url('public/css/profile.css') }}" rel="stylesheet" >
@stop

@section('content')

	<div class="row">
		@include('common.user-card')

		<div class="col-md-8">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-cash font-green"></i>
						<span class="caption-subject font-green bold uppercase">Preview Banks</span>
					</div>
					@if(Auth::user()->can('create-new-bank-account',$user))
					<div class="actions">
						<a href="{{ url('banks/new') }}" class="btn btn-circle btn-default">
							<i class="icon-user"></i>
							New Bank Account
						</a>
					</div>
					@endif
				</div><!-- end of portlet-title -->

				<div class="portlet-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<td>Bank Name</td>
									<td>Beneficiary Name</td>
									<td>Swift Code</td>
									<td>Iban</td>
									@if(Auth::user()->can('create-new-bank-account',$user))
									<td>Actions</td>
									@endif
								</tr>
							</thead>
							<tbody>
							<?php $banks = $user->banks ?>
							@if($user->banks)
								@foreach($banks as $bank)
									<tr>
										<td>{{ $bank->name }}</td>
										<td>{{ $bank->beneficiary_name }}</td>
										<td>{{ $bank->swift_code }}</td>
										<td>{{ $bank->iban }}</td>
										@if(Auth::user()->can('create-new-bank-account',$user))
										<td>
											<div class="dropdown">
											  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											    	Actions
											    	<span class="caret"></span>
											  	</button>
											  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
												    <li><a href="{{ url('bank/'.$bank->id.'/edit') }}">Edit</a></li>
												    <li><a href="#" class="delete" data-id="{{ $bank->id }}">Delete</a></li>
											  	</ul>
											</div>
										</td>
										@endif
									</tr>
								@endforeach
							@endif
							</tbody>
						</table>
					</div><!-- end of table-reponsive -->
				</div> <!-- end of portlet-body -->
			</div>
		</div>
	</div>

	@include('common.delete-modal',['item'=>'Bank Account','url'=>url('banks/delete')])
@stop