<?php

class ImageController extends \BaseController {

	public function getImages(){
    	$files = FileModel::paginate(15);
    	return $files;
    }
    
    public function newImage(){
    	try {
    		$data = AppHelpers::uploadImage(Input::file('uploadedFile'));
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    	
    	return json_encode($data);
    }

}
