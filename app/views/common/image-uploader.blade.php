<div class="modal fade" id="image-upload-modal" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Featured Image</h4>
			</div>
			<div class="modal-body">
				
				<ul id="upload-modal-tabs" class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#library">Image Library</a></li>
					<li><a data-toggle="tab" href="#upload-new-image">Upload Image</a></li>
				</ul>

				<div class="tab-content">
					<div id="library" class="upload-tab tab-pane active">
						<div class="images-container">
							<ul>
								
							</ul>
						</div>
					</div>

					<div id="upload-new-image" class="upload-tab tab-pane">
						<form action="{{ url('files/new') }}" id="image-upload-form" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="file" name="uploadedFile" id="uploaded-files" class="file-input">
							<button type="button" class="btn btn-default file-btn">Upload New Image</button>
						</form>
					</div>
				</div>

			</div><!-- end of modal-body -->
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="set-featured-image-btn btn btn-primary" disabled>Set As Featured Image</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div><!-- end of modal-content -->
	</div><!-- end of modal-dialog -->
</div><!-- end of modal -->

@section('footer')
	<script src="{{ url( 'scripts/image-uploader.js' ) }}"></script>
@stop