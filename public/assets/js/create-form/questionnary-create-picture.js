function addPictureAnswers(tableToFill){
	//currentElt = $(this);
	
	buttonOpts = {};
	buttonOpts['OK'] = $.extend(function() {
		submitForm(tableToFill);
        $(this).dialog("close");
    },{id : 'valid'});
	buttonOpts['Cancel'] = $.extend(function() {
        $(this).dialog("close");
    },{id : 'cancel'});
	
	openDialog('Picture','../../dialog/picture', buttonOpts);
}

function newPictureAnswer(json,tableToFill){
	ret = printf('<tr><td><input type="hidden" name="complementaryTest[%s][pictureTest][%s][pictureName]" value="%s" /><a class="fancybox" rel="group" href="../../../upload/%s"><img src="../../../upload/%s" alt="%s" width="200" title="%s" /></a></td>',
			tableToFill,
			json['img']['name'],
			json['img']['name'],
			json['img']['name'],
			json['img']['name'],
			json['img']['name']
	);
	ret += '<td>';
	jQuery.each(chooseLang, function() {
		ret += printf('<input type="text" class="moyen" name="complementaryTest[%s][pictureTest][%s][commentary][%s]" placeholder="Commentaire %s" /><br />',
				tableToFill,
				json['img']['name'],
				this.common_abbr,
				this.common_abbr
		);
	});
	ret += '</td>';
	ret += printf('<td><input name="complementaryTest[%s][pictureTest][%s][checked]" type="checkbox" /></td><td><button type="button" class="btn btn-danger" onclick="delPictureTest(this)">Supprimer</button></td></tr>',
			tableToFill,
			json['img']['name']
	);
	
	$('#' + tableToFill + ' > tbody').append(ret).hide().show('slow');
}

function delPictureTest(me){
	$(me).parent().parent().remove();
}

function addPictureTest(me){
	idContainer = $(me).parent().parent().parent().attr('id');
	ret = printf('<table id="%s">', idContainer);
	ret += printf('<thead><tr><th>Image</th><th>Commentaire</th><th>Checked</th><th>Action</th></tr></thead>');
	ret += printf('<tfoot><tr><td colspan="4"><button type="button" class="btn btn-success" onclick="addPictureAnswers(\'%s\')">Ajouter une image</button></td></tr></tfoot>', idContainer);
	ret += printf('<tbody>');
	ret += printf('</tbody>');
	
	$(me).parent().parent().before(ret);
	$(me).parent().parent().remove();
	addPictureAnswers(idContainer);
	
}