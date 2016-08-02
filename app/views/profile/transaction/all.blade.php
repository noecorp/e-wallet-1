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
						<span class="caption-subject font-green bold uppercase">Preview Previous Transaction</span>
					</div>
					@if(Auth::user()->can('create-deposit',$user))
					<div class="actions">
						<a href="{{ url('transactions/new') }}" class="btn btn-circle btn-default">
							<i class="icon-cash"></i>
							New Transaction
						</a>
					</div>
					@endif
				</div><!-- end of portlet-title -->

				<div class="portlet-body">
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
										<td>
										@if($model->type == Operation::TYPE_TRANSACTION_IN)
											{{ $model->transactionTargetUser()->name }}
										@else
											You
										@endif
										</td>
										<td>{{ $model->value }}</td>
										<td>
										@if($model->type == Operation::TYPE_TRANSACTION_IN)
											You
										@else
											{{ $model->transactionTargetUser()->name }}
										@endif
										</td>
										<td>{{ date('Y-m-d H:i',strtotime($model->created_at)) }}</td>
									</tr>
								@endforeach
							@endif
							</tbody>
						</table>
					</div><!-- end of table-reponsive -->
					{{ $models->links() }}
				</div> <!-- end of portlet-body -->
			</div>
		</div>
	</div>

@stop