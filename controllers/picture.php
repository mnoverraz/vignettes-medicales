<?php
class PictureController extends xWebController {

	function defaultAction() {
		return $this->uploadFileAction();
	}
	
	/**
	 * Recieve the image post and process it to save in the final placement
	 * @return array $image The array info image.
	 */
	function test(){
		$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
		$allowedType = array('image/jpg', 'image/pjpg', 'image/gif', 'image/png', 'image/jpeg');
		
		$img = $_FILES['images'];
		$basePath = xContext::$basepath;
		$afterpath = 'assets/upload/pictureTests/';
		foreach ($img['error'] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$extension = end(explode(".", $img['name'][$key]));
				if(in_array($extension, $allowedExts) && in_array($img['type'][$key], $allowedType)){
					$image['name'] = md5(session_id().time()).'.'.$extension;
					$image['type'] = $img['type'][$key];
					$image['size'] = $img['size'][$key];
					$image['server_location'] = $basePath.'/public/'.$afterpath.$image['name'];
					$image['web_location'] = xUtil::url($afterpath.$image['name']);
					
					
					move_uploaded_file( $img["tmp_name"][$key], $basePath.'/public/assets/upload/pictureTests/'.$image['name']);
				}
				
			}
		}
		return $image;
	}
}
?>