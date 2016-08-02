<?php
$username = 'You';
if($user->id != Auth::user()->id){
	$username  = $user->name;
}
?>

<div class="table-reponsive">
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<td>Type</td>
				<td>Balance Before</td>
				<td>Value</td>
				<td>Balance After</td>
				<td>Created At</td>
				<td>Notes</td>
			</tr>
		</thead>
		<tbody>
			@if($models)
				@foreach($models as $model)
				<tr>
					<td>
						@if($model->type == Operation::TYPE_DEPOSIT)
							<label class="label label-info">Deposit</label>
						@elseif($model->type == Operation::TYPE_WITHDRAWAL)
							<label class="label label-warning">Withdrawal</label>
						@elseif($model->type == Operation::TYPE_TRANSACTION_IN)
							<label class="label label-primary">Transaction</label>
						@elseif($model->type == Operation::TYPE_TRANSACTION_OUT)
							<label class="label label-danger">Transaction</label>
						@endif
					</td>
					<td>{{ $model->user_balance_before }}</td>
					<td>{{ $model->value }}</td>
					<td>
						@if( in_array($model->type, array( Operation::TYPE_DEPOSIT,Operation::TYPE_TRANSACTION_IN ) ) )
							{{ $model->user_balance_before + $model->value }}
						@else
							{{ $model->user_balance_before - $model->value }}
						@endif
					</td>
					<td>{{ date('Y-m-d H:i',strtotime($model->created_at)) }}</td>
					<td>
					@if($model->type == Operation::TYPE_DEPOSIT)
						Deposit Made from Bank "{{ $model->operationBank->bank->name }}"
					@elseif($model->type == Operation::TYPE_WITHDRAWAL)
						Withdrawal Made to Bank "{{ $model->operationBank->bank->name }}"
					@elseif($model->type == Operation::TYPE_TRANSACTION_IN)
						Transaction made from {{ $model->transactionTargetUser()->name }} to {{ $username }}
					@elseif($model->type == Operation::TYPE_TRANSACTION_OUT)
						Transaction made from {{ $username }} to {{ $model->transactionTargetUser()->name }} 
					@endif
					</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div>