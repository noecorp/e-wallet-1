<?php

class MimeTypeHelper{

	public static function getAllMimeTypes(){
		return include(__DIR__.'/mime-types.php');
	}

	public static function getExtensionByMimeType($mime_type){
		$key = array_search($mime_type, self::getAllMimeTypes());
		return $key;
	}

}