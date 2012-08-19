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
    $('#btnAdd').click(function() {
        var num     = $('.clonedElt').length;
        var newNum  = new Number(num + 1);

        var newElem = $('#elt-' + num).clone().attr('id', 'elt-' + newNum);
        
        
        //cherche le nom de l'élément
        eltName = $('.clonedElt:last > label').attr('for');
        eltNumber = eltName;
        
        regNumber = new RegExp("[0-9]{1,}$","g"); //regex
        regName = new RegExp("^[a-z]{0,}","g");	//regex
        eltName = regName.exec(eltName); // nom
        eltNumber = parseInt(regNumber.exec(eltNumber)); //numéro
        console.log(eltName+'-'+eltNumber);
        //-----------------------------
        
        newElem.children(':first').attr('id', eltName +'-'+(eltNumber+1)).attr('name', eltName +'-'+(eltNumber+1));
        $('#elt-' + num).after(newElem);
        $('#btnDel').attr('disabled','');

        if (newNum == 5)
            $('#btnAdd').attr('disabled','disabled');
    });

    $('#btnDel').click(function() {
        var num = $('.clonedElt').length;

        $('#elt-' + num).remove();
        $('#btnAdd').attr('disabled','');

        if (num-1 == 1)
            $('#btnDel').attr('disabled','disabled');
    });

    $('#btnDel').attr('disabled','disabled');
});