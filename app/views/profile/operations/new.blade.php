@extends('layouts.app')

@section('head')
	<link href="{{ url('css/profile.css') }}" rel="stylesheet" >
@stop

@section('content')
	<?php
		$item = 'Deposit';
		$url = 'deposits';
		if($type == 'withdrawal'){
			$item = 'Withdrawal';
			$url = 'withdrawals';
		}
	?>
	<div class="row">
		@include('common.user-card')

		<div class="col-md-8">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-cash font-green"></i>
						<span class="caption-subject font-green bold uppercase">New {{ $item }}</span>
					</div>
					<div class="actions">
						<a href="{{ url($url) }}" class="btn btn-circle btn-default">
							<i class="icon-cash"></i>
							Previous {{ $item }}s
						</a>
					</div>
				</div><!-- end of portlet-title -->

				<div class="portlet-body">
					
					<form action="{{ url($url.'/new') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="" class="control-label">Value</label>
							<input type="value" placeholder="{{ $item }} value " name="value" class="form-control" value="{{ Input::old('value') }}">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Bank</label>
							<select name="bank_id" class="form-control">
							@forelse($user->banks as $bank)
								<option value="{{ $bank->id }}" {{ Input::old('bank_id') == $bank->id?'selected':'' }} >{{ $bank->name }}</option>
							@empty
					
							@endforelse
							</select>
						</div>
						<div class="clearfix">
							<button class="btn blue pull-right" type="submit">Make {{ $item }}</button>
						</div>
					</form>

				</div> <!-- end of portlet-body -->
			</div>
		</div>
	</div>

@stop