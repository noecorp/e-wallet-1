@extends('layouts.app')

@section('content')
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-directions font-green"></i>
				<span class="caption-subject font-green bold uppercase">Transactions Report {{ $user? 'for '.$user->name : '' }}</span>
			</div>
		</div><!-- end of portlet-body -->

		<div class="portlet-body">
			@include('reports.single-operation-form',[
				'start_date'=>$start_date,
				'end_date'=>$end_date,
				'user'=>$user
			])

			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<td>#</td>
							<td>From User</td>
							<td>Value</td>
							<td>To User</td>
							<td>Transaction Made At</td>
						</tr>
					</thead>
					<tbody>
					<?php  ?>
					@if($models)
						<?php $count=0 ?>
						@foreach($models as $model)
							<tr>
								<td>{{ ++$count }}</td>
								<td>{{ $model->user->name }}</td>
								<td>{{ $model->value }}</td>
								<td>{{ $model->transactionTargetUser()->name }}</td>
								<td>{{ date('Y-m-d H:i',strtotime($model->created_at)) }}</td>
							</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div><!-- end of table-reponsive -->
			<?php
			$appended_array = array();
			if( isset($_GET['user_id'])){
				$appended_array['user_id'] = $_GET['user_id'];
			}
			if( isset($_GET['start_date'])){
				$appended_array['start_date'] = $_GET['start_date'];
			}
			if( isset($_GET['end_date'])){
				$appended_array['end_date'] = $_GET['end_date'];
			}
			?>

			{{ $models->appends($appended_array)->links() }}
		</div>
	</div>
@stop