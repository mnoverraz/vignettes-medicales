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
    /*$('.btnAdd').click(function() {
        var num     = $('.clonedElt').length;
        var newNum  = new Number(num + 1);

        //var newElem = $('#elt-' + num).clone().attr('id', 'elt-' + newNum);
        var newElem = $(this).parent().prev().clone().attr('id', 'elt-' + newNum);
        
        
        //cherche le nom de l'élément
        eltName = $('.clonedElt:last > :input').attr('name');
        eltNumber = eltName;
        
        regNumber = new RegExp("[0-9]{1,}$","g"); //regex
        regName = new RegExp("^[a-z]{0,}","g");	//regex
        eltName = regName.exec(eltName); // nom
        eltNumber = parseInt(regNumber.exec(eltNumber)); //numéro
        console.log(eltName+'-'+eltNumber);
        //-----------------------------
        
        newElem.children(':input').attr('id', eltName +'-'+(eltNumber+1)).attr('name', eltName +'-'+(eltNumber+1));
        newElem.children('label').attr('for', eltName +'-'+(eltNumber+1));
        $('#elt-' + num).after(newElem);
        $('#btnDel').attr('disabled','');

        if (newNum == 5)
            $('#btnAdd').attr('disabled','disabled');
    });*/
	
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
		
		
		
		
		/*
		console.log('div: ' + prevContainer);
		console.log('divName: ' +  prevContainerCompleteName);
		console.log('divPrefixName: ' +  prevContainerPrefixName);
		console.log('divNumber: ' +  prevContainerNumber);
		console.log('divNextNumber: ' +  prevContainerNextNumber);
		console.log();
		console.log('newElem: ' +  newElem);
		console.log('nbrChildren: ' +  nbrInputChildren);
		*/
		
		/*
        var num     = $('.clonedElt').length;
        var newNum  = new Number(num + 1);

        //var newElem = $('#elt-' + num).clone().attr('id', 'elt-' + newNum);
        var newElem = $(this).parent().prev().clone().attr('id', 'elt-' + newNum);
        
        
        //cherche le nom de l'élément
        eltName = $('.clonedElt:last > :input').attr('name');
        eltNumber = eltName;
        
        regNumber = new RegExp("[0-9]{1,}$","g"); //regex
        regName = new RegExp("^[a-z]{0,}","g");	//regex
        eltName = regName.exec(eltName); // nom
        eltNumber = parseInt(regNumber.exec(eltNumber)); //numéro
        console.log('id: ' + eltName+'-'+eltNumber);
        //-----------------------------
        
        newElem.children(':input').attr('id', eltName +'-'+(eltNumber+1)).attr('name', eltName +'-'+(eltNumber+1));
        newElem.children('label').attr('for', eltName +'-'+(eltNumber+1));
        $('#elt-' + num).after(newElem);
        $('#btnDel').attr('disabled','');

        if (newNum == 5)
            $('#btnAdd').attr('disabled','disabled');
          */
    });
	
    $('.btnDel').click(function() {
        $(this).parent().prev().remove();
    });

    $('#btnDel').attr('disabled','disabled');
    
});