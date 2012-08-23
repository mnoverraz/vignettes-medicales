function send(url, data, method) {
	$.ajax({
		type : method,
		url : url,
		dataType: 'json',
		data : data,
		success : function(msg){
			
			if (msg['success'])
				alert('ok');
			else
				alert('erreur');
		}
	});
	
}

$(document).ready(function() {
	
	$('.btnAdd').click(function() {
		//rules to searche name or number
		var regNumber = new RegExp("[0-9]{1,}$","g"); //regex
        var regName = new RegExp("^[a-zA-Z]{0,}","g");	//regex
		//----------------
		
        //DIV
		prevContainer = $(this).parent().prev();
		prevContainerCompleteName = $(this).parent().prev().attr('id');
		prevContainerPrefixName = regName.exec(prevContainerCompleteName);
		prevContainerNumber = parseInt(regNumber.exec(prevContainerCompleteName));
		prevContainerNextNumber = prevContainerNumber + 1;
		maxElt = parseInt($(prevContainer).attr('maxElt'));
		var newElem = prevContainer.clone().attr('id', prevContainerPrefixName + '-' + prevContainerNextNumber);
		
		//renomme l'intérieur
		nbrInputChildren = $(newElem).children(':input').length;
		
		current = $(newElem).children(':first-child');
		for(var i=0; i<nbrInputChildren; i++){
			//LABEL
				//bug to fix (need to be here)
				var regNumber = new RegExp("[0-9]{1,}$","g"); //regex
		        var regName = new RegExp("^[a-zA-Z]{0,}","g");	//regex
				
				inputCompleteName = $(current).next(':input').attr('name');
				inputPrefixName = regName.exec(inputCompleteName);
				inputNumber = parseInt(regNumber.exec(inputCompleteName));
				inputNextNumber = inputNumber+1;
				
				$(current).attr('for', inputPrefixName + '-' + inputNextNumber);
			
			//INPUT
				current = $(current).next(':input');
				$(current).attr('id', inputPrefixName + '-' + inputNextNumber).attr('name', inputPrefixName + '-' + inputNextNumber);
			
			current = $(current).next(':label');
		}
		
		$(prevContainer).after(newElem);
		
		$(this).next().removeAttr('disabled');
    });
	
    $('.btnDel').click(function() {
		var regNumber = new RegExp("[0-9]{1,}$","g"); //regex
        var regName = new RegExp("^[a-zA-Z]{0,}","g");	//regex
        
    	elt2del = $(this).parent().prev();
    	num = regNumber.exec($(elt2del).attr('id'));
    	
    	if(num > 1)
    		$(elt2del).remove();
    		console.log('ok del: num=' + num);

    	if(num > 2){
    		$(this).removeAttr('disabled');
    	}else{
    		$(this).attr('disabled','disabled');
    	}
    });

    
    
});