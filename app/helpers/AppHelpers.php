<?php

class AppHelpers{
	public static function uploadImage($file){

		if($file && $file->isValid()){
    		$data = [
    			'extension' => MimeTypeHelper::getExtensionByMimeType( $file->getMimeType() ),
    			'new_name' => date('YmdHis'),
    			'original_name' => $file->getClientOriginalName(),
    		];
    		$filename = $data['new_name'].'.'.$data['extension'];
    		$model = new FileModel($data);
    		
    		if(Auth::check()){
    			$model->user_id = Auth::user()->id;
    		}

    		if(!$model->save()){

    			throw new Exception("Uploading Image Fiald");
    		}

    		$data['id'] = $model->id;
    		
			$file->move(public_path('uploads'),$filename);
			$img = Image::make( public_path( 'uploads/'.$filename ) )->resize(125, 125)->save( public_path( 'uploads/'.$data['new_name'].'-125-125.'.$data['extension'] ) );

			return $data;
    	}

    	return false;
	}


	public static function getImageUrl($image,$width = null , $height = null){
		if(!$image){
            return url('public/img/default_avatar_male.jpg');
        }

        if(!is_null($width) && !is_null($height)){
            $filename = $image->new_name.'-'.$width.'-'.$height.'.'.$image->extension;
            if( !file_exists( public_path( 'uploads/'.$filename ) ) ){
                $img = Image::make( public_path( 'uploads/'.$image->new_name.'.'.$image->extension ) );
                $img->resize($width, $height);
                $img->save( public_path( 'uploads/'.$filename ) );
            }
            return url('public/uploads/'.$filename);
        }
        return url('public/uploads/'.$image->new_name.'.'.$image->extension);
	}

	public static function errorSummary($messages){
		$html = 'Please Fix Following Errors';
		$html .='<ul>';
		foreach ($messages->all() as $message)
		{
		    $html .='<li>'.$message.'</li>';
		}
		$html .='</ul>';

		return $html;
	}


	public static function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}


	public static function imageUploadInput($name,$value = '',$image=null){
		if(is_null($image)){
			$image = url('public/img/default_avatar_male.jpg');
		}

		$html = '
			<div class="image-thumbnail-container">
            	<input type="hidden" name="'.$name.'" class="choosen-image-id" value="'.$value.'">
            	<img src="'.$image.'" class="choosen-image" width="125" height="125" alt="">
            </div>
            <div class="btn-group image-btns">
            	<button class="btn btn-danger delete-image" data-default="'.url('public/img/default_avatar_male.jpg').'" type="button"><i class="fa fa-times"></i></button>
            	<button class="btn btn-primary upload-image" type="button" data-toggle="modal" data-target="#image-upload-modal"><i class="fa fa-folder"></i></button>
            </div>
		';
		return $html;
	}

	public static function joinPaths() {
	    $args = func_get_args();
	    $paths = array();
	    foreach ($args as $arg) {
	        $paths = array_merge($paths, (array)$arg);
	    }

	    $paths = array_map(create_function('$p', 'return trim($p, "/");'), $paths);
	    $paths = array_filter($paths);
	    return join('/', $paths);
	}

	public static function generateUserProfileLink($id){
		$path = Route::getCurrentRoute()->getPath();
		$baseUrl = url('/');
		if( is_numeric(strpos($path,'user/{id}')) ){
			$baseUrl = url('/user/'.$id);
		}

		return $baseUrl;
	}

}