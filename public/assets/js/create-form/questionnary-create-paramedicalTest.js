function addParamedicalTestAnswers(){
	currentElt = $(this);
	
	
	buttonOpts = {};
	buttonOpts['OK'] = $.extend(function() {
		newParamedicalTestAnswer(getIDs());
        $(this).dialog("close");
    },{id : 'valid'});
	buttonOpts['Cancel'] = $.extend(function() {
        $(this).dialog("close");
    },{id : 'cancel'});
	
	openDialog('Titre moi','../../dialog/paramedicalTest', buttonOpts);
}


function newParamedicalTestAnswer(val) {

	filter = {
				'id':eval(val),
				'paramedical-test-traduct_language_id':1
	};
	json = getParamedicalTests(filter);
	console.log(json);
	
	$.each(toto, function(i, item) {
		
				alreadyInList = false;
				tr = $('tr[testid]:first');
				for(var h=0; h<$('tr[testid]').size(); h++){
					if($(tr).attr('testid') == item['id']){
						alreadyInList = true;
					}

					tr = $(tr).next('tr[testid]');
				}
				
				if(!alreadyInList){
					ret = printf('<tr testid="%d">',item['id']);
					ret += printf('<td>%s</td><td><input name="paramedicalTest[paramedicalTests][%s][testValue]" type="text" class="petit" /></td><td>%s</td><td><input type="checkbox" name="paramedicalTest[paramedicalTests][%s][effectuated]" class="petit" /></td>',
							item['paramedical-test-traduct_name'],
							item['id'],
							item['normal_values'],
							item['id']
					);
				    ret += '</tr>';
				    $('#question-paramedical-table > tbody > tr:last').after(ret).hide().show('slow');
				}	
	});
	updateParamedicalTest();
}
/*
 * supprime les test qui ne doivent plus être affichés
 */
function updateParamedicalTest(){
	$.each($('tr[testid]'), function(j, tr){
		var alreadyInList = false;
		$.each(toto, function(i, item){
			if($(tr).attr('testid') == item['id']){
				alreadyInList = true;
			}
		});
		if(!alreadyInList){
			$(tr).hide("drop", function(){ jQuery(this).remove(); });;
		}
			
			
	});
}

function getParamedicalTests(filter){
	return send('../../rest/paramedical-test', filter, 'get');
}


function addParamedicalTest(me){
	ret = printf('<table id="question-paramedical-table" class="paramedicalTest">');
	ret += printf('<thead><tr><th class="test">Test</th><th class="valTest">Valeur du test</th><th class="normalVal">Valeur normale</th><th class="effectuated">Effectué</th></tr></thead>');
	ret += printf('<tfoot><tr><td colspan="4"><button type="button" class="btn btn-success" onclick="addParamedicalTestAnswers()">Ajouter/Supprimer des tests</button></td></tr></tfoot>');
	ret += printf('<tbody>');
	ret += printf('<tr><td colspan="4"></td></tr>');
	ret += printf('</tbody>');
	
	$(me).parent().parent().before(ret);
	$(me).parent().parent().remove();
	addParamedicalTestAnswers();
}