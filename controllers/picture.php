<?php
class PictureController extends xWebController {

	function defaultAction() {
		return $this->uploadFileAction();
	}
	
	/*function uploadFileAction(){
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
	}*/
	
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