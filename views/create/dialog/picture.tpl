<script>
var currentImg = '';

function submitForm(){

	json = {'img':currentImg, 'comment': $('#comment').val()};
	newPictureAnswer(json);
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


<form name="form1" method="post" enctype="multipart/form-data"  action="<?php echo 'toto'//xUtil::url('picture/test')?>">
	<div id="stylized" class="myform">
		<label for="title">Image<span class="small">test</span></label><input type="file" name="images" id="images" multiple />
		<label for="comment">Commentaire<span class="small">test</span></label><input id="comment" type="text" />
		
		
		<div style="clear:both"></div>
	</div>

</form>