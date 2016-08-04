@extends('layouts.app')

@section('head')
	<link href="{{ url('public/css/profile.css') }}" rel="stylesheet" >
@stop

@section('content')
	<?php
	$item = 'Deposit';
	$url = 'deposits';
	if($type == 'withdrawals'){
		$item = 'Withdrawal';
		$url = "withdrawals";
	}
	?>
	<div class="row">
		@include('common.user-card')

		<div class="col-md-8">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-cash font-green"></i>
						<span class="caption-subject font-green bold uppercase">Preview Previous {{ $item }}s</span>
					</div>
					@if(Auth::user()->can('create-deposit',$user))
					<div class="actions">
						<a href="{{ url($url.'/new') }}" class="btn btn-circle btn-default">
							<i class="icon-cash"></i>
							New {{ $item }}
						</a>
					</div>
					@endif
				</div><!-- end of portlet-title -->

				<div class="portlet-body">
					@include('profile.dates-form')
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<td>#</td>
									<td>Value</td>
									<td>{{ $item }} Bank</td>
									<td>{{ $item }} Made At</td>
								</tr>
							</thead>
							<tbody>
							<?php  ?>
							@if($models)
								<?php $count=0 ?>
								@foreach($models as $model)
									<tr>
										<td>{{ ++$count }}</td>
										<td>{{ $model->value }}</td>
										<td>{{ $model->operationBank->bank->name }}</td>
										<td>{{ date('Y-m-d H:i',strtotime($model->created_at)) }}</td>
									</tr>
								@endforeach
							@endif
							</tbody>
						</table>
					</div><!-- end of table-reponsive -->
					@include('profile.pagination',['models'=>$models])
				</div> <!-- end of portlet-body -->
			</div>
		</div>
	</div>

@stop