'use strict'

jQuery(document).ready(function($){
	var host = 'http://localhost/e_wallet/';	
	var imageUploader = {
		//objects for containers user in the modal
		modal : $('#image-upload-modal'),
		launcher : $('.upload-image'),
		launcherInstance : '',
		imagesContainer: $('.images-container ul'),
		uploadedImage : $('.uploaded-image'),
		//currentPage used for pagination
		currentPage: 1,

		setImageBtn : $('.set-featured-image-btn'),
		//image upload form
		fileForm : $('#image-upload-form'),
		fileInpue : $('.file-input'),
		fileBtn : $('.file-btn'),
		getRandomInt: function (min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		},
		UploadedImageContainer : function(originalName,newName,extension,id){
			var item = '<li>';
			item += '<a href="#" class="uploaded-image" data-id="'+id+'" data-new-name="'+newName+'.'+extension+'">';
			item += '<img src="'+host+'public/uploads/'+newName+'-125-125.'+extension+'" alt="'+originalName+'" />';
			item += '</a>';
			item += '</li>';

			iu.imagesContainer.prepend(item);
		},
		UploadingImageContainer : function(id){
			var item = '<li class="uploading-image-container" id="'+id+'">';
			item += '<div class="progress">';
			item += ' <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">';
			item += '<span class="sr-only">70% Complete</span>';
			item += '</div>';
			item += '</div>';
			item += '</li>';

			iu.imagesContainer.prepend(item)
		},
		getImages : function(){
			$.ajax({
				url: host+'files?page='+iu.currentPage,
				type : 'get',
				beforeSend: function(){
					var loader = '<li class="loader"><i class="fa fa-spin fa-spinner"></i></li>';
					iu.imagesContainer.append(loader);
				},
				success : iu.onGetImageSuccess
			});
		},
		onGetImageSuccess : function(data){
			if(data != -1){
				data = data.data;
				if(data.length){
					iu.modal.addClass('has-images');
					for(var key in data){
						iu.UploadedImageContainer(data[key].original_name,data[key].new_name,data[key].extension,data[key].id);
					}
					iu.imagesContainer.find('.loader').remove();
				}
			}
		},
		onFileFormSubmit : function(e){
			e.preventDefault();
			console.log("onFileFormSubmit");
			var fd = new FormData(this);

			//create a random id to distinguish object when multi uploads
			var id = 'new-image-'+iu.getRandomInt(0,1000);
			
			$.ajax({
				url: $(this).attr('action'),
				xhr: function() { // custom xhr (is the best)
					var xhr = new XMLHttpRequest();
				   	var total = 0;

					   // Get the total size of files
					
					$.each(document.getElementById('uploaded-files').files, function(i, file) {
						total += file.size;
					});

					iu.UploadingImageContainer(id);
					$('#upload-modal-tabs a[href="#library"]').tab('show');

					   // Called when upload progress changes. xhr2
				   	xhr.upload.addEventListener("progress", function(evt) {

						// show progress like example
						var loaded = (evt.loaded / total).toFixed(2)*100; // percent

						$(id).find('.progress-bar').css('width',loaded+'%');

					}, false);

					return xhr;
				},
				type: 'post',
				processData: false,
				contentType: false,
				data: fd,
				success: function(data) {
					$('#'+id).remove();
					if(data != -1){
						data = JSON.parse(data);
						iu.UploadedImageContainer(data.original_name,data.new_name,data.extension,data.id);
					}else{

					}
				}
			});
			console.log("after xhr");
		},
		activateSetFeaturedImageBtn : function(){
			var parent = $('.uploaded-image').parent();
			if(parent.hasClass('active')){
				iu.setImageBtn.removeAttr('disabled');
			}else{
				iu.setImageBtn.attr('disabled','disabled');
			}
		},
		onLauncherClicked : function(){
			iu.launcherInstance = $(this);
			if(!iu.modal.hasClass('has-images')){
				iu.getImages();
			}
		},
		onUploadedImageClicked: function(e){
			var parent = $(this).parent();
			if(parent.hasClass('active')){
				parent.removeClass('active');
			}else{
				$('.uploaded-image').parent().removeClass('active');
				$(this).parent().addClass('active');
			}
			iu.activateSetFeaturedImageBtn();
			e.preventDefault();
		},
		init : function(){
			$('body').on('click','.upload-image',iu.onLauncherClicked);
			$('body').on('click','.uploaded-image',iu.onUploadedImageClicked);

			iu.fileBtn.click(function(){
				iu.fileInpue.click();
			});
			iu.fileInpue.change(function(){
				iu.fileForm.submit();
			});

			iu.fileForm.submit(iu.onFileFormSubmit);

			iu.setImageBtn.click(function(){
				var imageContainer = iu.imagesContainer.find('li.active').find('a');
				var image = imageContainer.attr('data-new-name');
				var id = imageContainer.attr('data-id');
				var parent = iu.launcherInstance.parent().parent();
				console.log(parent.find('.choosen-image').attr('src'));
				parent.find('.choosen-image').attr('src',host+'public/uploads/'+image).load().show();
				parent.find('.choosen-image-id').val(id);
				iu.modal.modal('hide');
			});

			$('.delete-image').click(function(){
				var parent = $(this).parent().parent();
				var url = $(this).attr('data-default');
				parent.find('.choosen-image').attr('src',url).load().show();
				parent.find('.choosen-image-id').val('');
			});
		}
	};

	var iu = imageUploader; 
	imageUploader.init();
});