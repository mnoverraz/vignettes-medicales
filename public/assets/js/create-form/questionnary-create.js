//function send(url, data, method) {
// $.ajax({
// type : method,
// url : url,
// dataType: 'json',
// data : data,
// success : function(msg){
// alert(msg);
// }
// });
//
//}

function send(url, data, method) {
	$.ajax({
		type : method,
		url : url,
		async : false,
		dataType : 'json',
		data : data,
		success : function(msg) {
			console.log('toto' + msg);
			toto = msg;
		}
	});
}

$(document).ready(function() {


	$('.btnAdd').click(function() {
		// rules to searche name or number
		var regNumber = new RegExp("[0-9]{1,}$", "g"); // regex
		var regName = new RegExp("^[a-zA-Z]{0,}", "g"); // regex
		// ----------------
	
		// DIV
		prevContainer = $(this).parent().parent().prev();
		prevContainerCompleteName = $(prevContainer).attr('id');
		prevContainerPrefixName = regName.exec(prevContainerCompleteName);
		prevContainerNumber = parseInt(regNumber.exec(prevContainerCompleteName));
		prevContainerNextNumber = prevContainerNumber + 1;
		maxElt = parseInt($(prevContainer).attr('maxElt'));
		if(prevContainerNumber < maxElt){
			maxElt = parseInt($(prevContainer).attr('maxElt'));
			var newElem = prevContainer.clone().attr('id',prevContainerPrefixName + '-' + prevContainerNextNumber);
		
			// renomme l'intérieur
			inputTable = $(newElem).children().children(':input');
			nbrInputChildren = $(inputTable).length;
			current = $(newElem).children().children(':first-child');
			
			
			console.log('current');
			console.log(current);
			for ( var i = 0; i < nbrInputChildren; i++) {
				// LABEL
				// bug to fix (need to be here)
				var regNumber = new RegExp("[0-9]{1,}$", "g"); // regex
				var regName = new RegExp("^[a-zA-Z]{0,}", "g"); // regex
		
				inputCompleteName = $(current).attr('name');
				inputPrefixName = regName.exec(inputCompleteName);
				inputNumber = parseInt(regNumber.exec(inputCompleteName));
				inputNextNumber = inputNumber + 1;
				inputName = inputPrefixName + '-' + inputNextNumber;
		
				//$(current).attr('for',inputPrefixName + '-'	+ inputNextNumber);
		
				// INPUT
				//current = $(current).next(':input');
				//$(current).attr('id',inputPrefixName + '-' + inputNextNumber).attr('name',inputPrefixName + '-'	+ inputNextNumber);
				$(current).attr('name',inputName);
				$(current).attr('id',inputName);
				//current = $(current).next(':label');
			}
		
			$(prevContainer).after(newElem);
			
			
			if(prevContainerNumber == 1){
				$(this).next().removeAttr('disabled');
			}
			if(prevContainerNumber == maxElt-1){
				$(this).attr('disabled', 'disabled');
			}
		}

	});

	$('.btnDel').click(function() {
		var regNumber = new RegExp("[0-9]{1,}$", "g"); // regex
		var regName = new RegExp("^[a-zA-Z]{0,}", "g"); // regex

		elt2del = $(this).parent().parent().prev();
		num = regNumber.exec($(elt2del).attr('id'));

		if (num > 1)
			$(elt2del).remove();

		if (num > 2){
			$(this).removeAttr('disabled');
		} else {
			$(this).attr('disabled', 'disabled');
		}
		$(this).prev().removeAttr('disabled');
	});

	/*$('.addAnswerTemplate').click(function() {
		ret = '';

		switch ($(this).parent().parent().prev().prev().children().children(':input').val()) {
		case '1':
			ret += printf('<fieldset id="reponse-1"><legend>Réponses</legend>');
			ret += printf('<table id="roger1" class="paramedicalTest">');
			ret += printf('<thead><tr><th class="test">Test</th><th class="valTest">Valeur du test</th><th class="normalVal">Valeur normale</th><th class="effectuated">Effectué</th></tr></thead>');
			ret += printf('<tfoot><tr><td colspan="4"><button type="button" class="btn btn-success" onclick="addParamedicalTestAnswers()">Ajouter/Supprimer des tests</button></td></tr></tfoot>');
			ret += printf('<tbody>');
			ret += printf('<tr><td colspan="4"></td></tr>');
			ret += printf('</tbody>');

			$(this).siblings('.type').attr('disabled', 'disabled');
			addParamedicalTestAnswers();
			break;
		case '2':
			ret += printf('<fieldset id="reponse-1"><legend>Réponses</legend>');
			ret += printf('<div class="control-group">');
			ret += printf('<label for="title" class="control-label">Titre</label>');
			ret += printf('<div class="controls">');
			ret += printf('<input type="text" />');
			ret += printf('</div>');
			ret += printf('</div>');
			ret += printf('<table id="roger1">');
			ret += printf('<tfoot><tr><td colspan="6"><button type="button" class="btn btn-success" onclick="addPictureAnswers()">Ajouter une image</button></td></tr></tfoot>');
			ret += printf('<tbody>');
			ret += printf('<tr></tr>');
			ret += printf('</tbody>');

			$(this).siblings('.type').attr('disabled', 'disabled');
			addPictureAnswers();
			break;
		case '3':
			$(this).prev().after('Text');
			break;
		}
		$(this).parent().parent().before(ret);
		//$(this).prev().after(ret);
		//$(this).remove();
		$(this).parent().parent().remove();

	});*/

});

function openDialog(dialogTitle, url, buttonOpts) {
	$("#dialog").load(url).dialog({
		title : dialogTitle,
		modal : true,
		show : {
			effect : 'shake',
			times : 2,
			duration : 70
		},
		position : 'top',
		width : 900,
		buttons : buttonOpts
	});
}

/*function addQuestion(trigger){
	$(trigger).prev().before(newQuestionTemplate());
}
function delQuestion(trigger){
	$(trigger).parent().remove();
}*/



/*function newQuestionTemplate(){
	
	
	
	
	ret = printf('<div id="question" class="questionContainer numerate">');
	ret += printf('<legend>Question</legend>');
	
	ret += printf('<div class="control-group">');
	ret += printf('<label for="question_%s" class="control-label numerate">Question</label>', languages[0]['iso_code']);
	ret += printf('<div class="controls">');
	for(i = 0; i<languages.length; i++){
		ret += printf('<input id="question_%s" name="question_%s" type="text" placeholder="%s" class="numerate" />',
				languages[i]['iso_code'],
				languages[i]['iso_code'],
				languages[i]['iso_code']
		);
	}
	ret += printf('</div>');
	ret += printf('</div>');
	
	ret += printf('<div class="control-group">');
	ret += printf('<label for="remark_%s" class="control-label numerate">Remarque</label>', languages[0]['iso_code']);
	ret += printf('<div class="controls">');
	for(i = 0; i<languages.length; i++){
		ret += printf('<input id="remark_%s" name="remark_%s" type="text" placeholder="remarque %s" class="numerate" />',
				languages[i]['iso_code'],
				languages[i]['iso_code'],
				languages[i]['iso_code']
		);
	}
	ret += printf('</div>');
	ret += printf('</div>');
	
	ret += printf('<div class="control-group">');
	ret += printf('<label for="type-1" class="control-label">Type</label>');
	ret += printf('<div class="controls">');
	ret += printf('<select id="type-1" name="type-1" class="type">');
	ret += printf('<option value="1">Test paramédical</option>');
	ret += printf('<option value="2">Image</option>');
	ret += printf('</select>');
	ret += printf('</div>');
	ret += printf('</div>');
	
	ret += printf('<div class="control-group">');
	ret += printf('<label for="mode-1" class="control-label">Mode</label>');
	ret += printf('<div class="controls">');
	ret += printf('<select id="mode-1" name="mode-1" class="type">');
	ret += printf('<option value="1">QCM</option>');
	ret += printf('<option value="2">Single</option>');
	ret += printf('</select>');
	ret += printf('</div>');
	ret += printf('</div>');
	
	ret += printf('<div class="control-group">');
	ret += printf('<div class="controls">');
	ret += printf('	<button class="addAnswerTemplate btn btn-success" type="button">addAnswer</button>');
	ret += printf('</div>');
	ret += printf('</div>');
	ret += printf('<button class="btn btn-danger" type="button" onclick="delQuestion(this)">delete question 1</button>');
	ret += printf('</div>');
			
	return ret;
}*/
