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
						<span class="caption-subject font-green bold uppercase">New Transaction</span>
					</div>
					<div class="actions">
						<a href="{{ url('transactions') }}" class="btn btn-circle btn-default">
							<i class="icon-cash"></i>
							Previous Transactions
						</a>
					</div>
				</div><!-- end of portlet-title -->

				<div class="portlet-body">
					
					<form action="{{ url('transactions/new') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<label for="" class="control-label">Target User Email</label>
							<input type="email" placeholder="Target User Email " name="email" class="form-control" value="{{ Input::old('email') }}">
						</div>

						<div class="form-group">
							<label for="" class="control-label">Value</label>
							<input type="text" placeholder="Transaction value " name="value" class="form-control" value="{{ Input::old('value') }}">
						</div>

						<div class="clearfix">
							<button class="btn blue pull-right" type="submit">Make Transaction</button>
						</div>
					</form>

				</div> <!-- end of portlet-body -->
			</div>
		</div>
	</div>

@stop