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
						<i class="icon-users font-green"></i>
						<span class="caption-subject font-green bold uppercase">Balance Report from {{ date('Y-m-01') }} to {{ date('Y-m-t') }}</span>
					</div>
				</div><!-- end of portlet-title -->
				<div class="portlet-body">
					@include('reports.table',['models'=>$models])
				</div>
			</div>
		</div>
	</div>
@stop