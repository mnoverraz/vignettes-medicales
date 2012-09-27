<?php
class PictureController extends xWebController {

	function defaultAction() {
		return $this->uploadFileAction();
	}
	
	function uploadFileAction(){
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = end(explode(".", (string) $_FILES["images"]["name"]));
		$d = Array();
		$img = $_FILES["images"];
		$d['img_src'] = $img;
		$d['test'] = $img['type'][0];
		if ((($img["type"] == "image/gif")
				|| ($img["type"] == "image/jpeg")
				|| ($img["type"] == "image/png")
				|| ($img["type"] == "image/pjpeg"))
				&& ($img["size"] < 20000)
				&& in_array($extension, $allowedExts))
		{
			if ($img["error"] > 0)
			{
				$d['error'] = "Return Code: " . $img["error"] . "<br />";
			}
			else
			{
				$d['return'] =  "Upload: " . $img["name"] . "<br />";
				$d['return'] .= "Type: " . $img["type"] . "<br />";
				$d['return'] .= "Size: " . ($img["size"] / 1024) . " Kb<br />";
				$d['return'] .= "Temp file: " . $img["tmp_name"] . "<br />";
		
				if (file_exists("/Applications/MAMP/htdocs/vignette/upload/" . $_FILES["file"]["name"]))
				{
					$d['return'] .= $img["name"] . " already exists. ";
				}
				else
				{
					move_uploaded_file($img["tmp_name"],
					"/Applications/MAMP/htdocs/vignette/upload/" . $img["name"]);
					$d['return'] .= "Stored in: " . "/Applications/MAMP/htdocs/vignette/upload//" . $img["name"];
				}
			}
		}
		else
		{
			$d['return'] = "Invalid file";
		}
		return xView::load('create/upload', $d);
	}
	
	function test(){
		$allowedExts = array('jpg', 'jpeg', 'gif', 'png');
		$allowedType = array('image/jpg', 'image/pjpg', 'image/gif', 'image/png');
		
		$img = $_FILES['images'];
		foreach ($img['error'] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$extension = end(explode(".", $img['name'][$key]));
				if(in_array($extension, $allowedExts) && in_array($img['type'][$key], $allowedType)){
					$image['name'] = $img['name'][$key];
					$image['type'] = $img['type'][$key];
					$image['size'] = $img['size'][$key];
					$image['server_location'] = xContext::$basepath.'/upload/pictureTests/'.session_id().'-'.$_FILES['images']['name'][$key];
					
					$image['web_location'] = '../../../upload/pictureTests/'.session_id().'-'.$_FILES['images']['name'][$key];
					
					
					move_uploaded_file( $img["tmp_name"][$key], xContext::$basepath.'/upload/pictureTests/'.session_id().'-'.$_FILES['images']['name'][$key]);
				}
				
			}
		}
		return $image;
	}
}
?>