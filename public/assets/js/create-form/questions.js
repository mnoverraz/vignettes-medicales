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
					ret += printf('<td>%s</td><td><input type="text" class="petit" /></td><td>%s</td><td><input type="checkbox" class="petit" /></td>',
							item['paramedical-test-traduct_name'],
							//item['id'],
							item['normal_values']
					);
				    ret += '</tr>';
				    $('#roger1 > tbody > tr:last').after(ret).hide().show('slow');
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