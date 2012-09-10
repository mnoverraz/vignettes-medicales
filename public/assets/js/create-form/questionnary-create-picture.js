function addPictureAnswers(){
	currentElt = $(this);
	
	
	buttonOpts = {};
	buttonOpts['OK'] = $.extend(function() {
		submitForm();
		//newPictureAnswer(currentImg);
        $(this).dialog("close");
    },{id : 'valid'});
	buttonOpts['Cancel'] = $.extend(function() {
        $(this).dialog("close");
    },{id : 'cancel'});
	
	openDialog('Picture','../../dialog/picture', buttonOpts);
}

function newPictureAnswer(json){
	ret = printf('<td><div class="pictureAnswer"><a class="fancybox" rel="group" href="../../../upload/%s"><img src="../../../upload/%s" alt="%s" width="200" title="%s" /></a><span>%s</span><input type="radio" name="toto" class="eric" style="margin-left: 0px"></div></td></tr>',
			json['img']['name'],
			json['img']['name'],
			json['comment'],
			json['comment'],
			json['comment']
	);
	
	$('#roger1 > tbody > tr:last').append(ret).hide().show('slow');
}