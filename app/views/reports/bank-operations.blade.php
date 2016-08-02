@extends('layouts.app')

@section('content')
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-users font-green"></i>
				<span class="caption-subject font-green bold uppercase">{{ $item }} Report {{ $user? 'for '.$user->name : '' }}</span>
			</div>
		</div><!-- end of portlet-body -->

		<div class="portlet-body">
			@include('reports.single-operation-form',[
				'start_date'=>$start_date,
				'end_date'=>$end_date,
				'user'=>$user
			])
			@include('reports.bank-operation-table',['models'=>$models,'item'=>$item])
		</div>
	</div>
@stop