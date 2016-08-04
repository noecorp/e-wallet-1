<div class="modal fade delete-modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Deleting {{ $item }}</h3>
			</div>
			<form action="{{ $url }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="DELETE">
				<div class="modal-body">
					<p>Are You sure you Wanna delete {{ $item }} ?</p>
					<input type="hidden" name="deletedId" id="deleteId" value="">
				</div>
				<div class="modal-footer">
					<div class="btn-group">
						<button class="btn btn-default" data-dismiss="modal">Close</button>
						<button class="btn btn-danger" type="submit">Delete</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>