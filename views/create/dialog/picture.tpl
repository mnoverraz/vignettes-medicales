<script>
var currentImg = '';

function submitForm(tableToFill){

	json = {'img':currentImg};
	newPictureAnswer(json, tableToFill);
}

(function () {
	var input = document.getElementById("images"), 
		formdata = false;

	function showUploadedItem (source) {
  		var list = document.getElementById("image-list"),
	  		li   = document.createElement("li"),
	  		img  = document.createElement("img");
  		img.src = source;
  		li.appendChild(img);
		list.appendChild(li);
	}


	if (window.FormData) {
  		formdata = new FormData();
	}
	
 	input.addEventListener("change", function (evt) {
 		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("images[]", file);
				}
			}	
		}
		
		if (formdata) {
			$.ajax({
				//url: '<?php echo xUtil::url('picture/test')?>',
				url: '<?php echo xUtil::url('api/picture/test')?>',
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					currentImg = res;
				}
			});
		}
	}, false);
}());


</script>
<form id="questionnary" name="questionnary" method="post" class="form-horizontal" enctype="multipart/form-data">
	<legend><?php echo _('Chargez une image')?></legend>
	<div class="control-group">
		<label for="images" class="control-label"><?php echo _('Image')?></label>
		<div class="controls">
			<input type="file" name="images" id="images" />
		</div>
	</div>
</form>