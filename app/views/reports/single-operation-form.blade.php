<form action="" method="get">
	<div class="row">
		<div class="form-group col-md-3">
			<label for="" class="control-label">User</label>
			<?php $users = User::get(); ?>
			<select name="user_id" class="form-control">
				<option value="">All</option>
			@if($users)
				@foreach($users as $model)
				<option value="{{ $model->id }}" {{ $user&&$model->id==$user->id?'selected':'' }} >{{ $model->name }}</option>
				@endforeach
			@endif
			</select>
		</div>

		<div class="form-group col-md-3">
			<label for="" class="control-label">From Date</label>
			<input type="text" name="start_date" class="datepicker form-control" value="{{ date('Y-m-d',strtotime($start_date) ) }}">
		</div>
		<div class="form-group col-md-3">
			<label for="" class="control-label">To Date</label>
			<input type="text" name="end_date" class="datepicker form-control" value="{{ date('Y-m-d',strtotime($end_date) ) }}">
		</div>
		<div class="form-group col-md-3">
			<button class="btn green btn-block form-go-btn" type="submit">Go</button>
		</div>
	</div>
</form>