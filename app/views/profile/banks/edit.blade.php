@extends('layouts.app')

@section('head')
	<link href="{{ url('css/profile.css') }}" rel="stylesheet" >
@stop

@section('content')

	<div class="row">
		@include('common.user-card')

		<div class="col-md-8">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-cash font-green"></i>
						<span class="caption-subject font-green bold uppercase">Edit Bank Account</span>
					</div>
					<div class="actions">
						<a href="{{ url('banks/') }}" class="btn btn-circle btn-default">
							<i class="icon-user"></i>
							All Bank Accounts
						</a>
					</div>
				</div><!-- end of portlet-title -->

				<div class="portlet-body">
					<form action="{{ url('bank/'.$model->id.'/edit') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">
						
						<div class="form-group">
							<label class="control-label">Bank Name</label>
							<input type="text" name="name" placeholder="Bank Name" class="form-control" value="{{ $model->name }}">
						</div>

						<div class="form-group">
							<label class="control-label">Beneficiary Name</label>
							<input type="text" name="beneficiary_name" placeholder="Beneficiary Name" class="form-control" value="{{ $model->beneficiary_name }}">
						</div>

						<div class="form-group">
							<label for="" class="control-label">Swift Code</label>
							<input type="text" name="swift_code" placeholder="Swift Code" class="form-control" value="{{ $model->swift_code }}">
						</div>

						<div class="form-group">
							<label for="" class="control-label">Iban</label>
							<input type="text" name="iban" placeholder="Iban" class="form-control" value="{{ $model->iban }}">
						</div>

						<div class="clearfix">
							<button class="btn blue pull-right" type="submit">Save Bank Account</button>
						</div>

					</form>
				</div> <!-- end of portlet-body -->
			</div>
		</div>
	</div>
@stop