jQuery(document).ready(function($){
	$('.delete').click(function(e){
		var id = $(this).attr('data-id');
		$('#deleteId').val(id);
		$('.delete-modal').modal('show');
		e.preventDefault();
	});

	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
	});

	$('select').select2();
});