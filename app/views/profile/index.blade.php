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
						<i class="icon-users font-green"></i>
						<span class="caption-subject font-green bold uppercase">Balance Report</span>
					</div>
				</div><!-- end of portlet-title -->
				<div class="portlet-body">
					@include('profile.dates-form')
					@include('reports.table',['models'=>$models])
					@include('profile.pagination',['models'=>$models])
				</div>
			</div>
		</div>
	</div>
@stop