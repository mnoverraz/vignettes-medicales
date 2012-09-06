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
async: false,
dataType: 'json',
data : data,
success : function(msg){
console.log('toto' + msg);
toto = msg;
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
    
    $('.addAnswerTemplate').click(function() {
     ret='';
    
     switch($(this).siblings('.type').val()){
case '1':
ret += printf('<fieldset id="reponse-1"><legend>Réponses</legend>');
ret += printf('<table id="roger1">');
ret += printf('<thead><tr><th>Test</th><th>Valeur du test</th><th>Valeur normale</th><th>Effectué</th></tr></thead>');
ret += printf('<tfoot><tr><td colspan="4"><button type="button" onclick="addParamedicalTestAnswers()">Ajouter/Supprimer des tests</button></td></tr></tfoot>');
ret += printf('<tbody>');
ret += printf('<tr><td colspan="4"></td></tr>');
ret += printf('</tbody>');

$(this).siblings('.type').attr('disabled','disabled');
addParamedicalTestAnswers();
break;
case '2':
ret += printf('<fieldset id="reponse-1"><legend>Réponses</legend>');
ret += printf('<table id="roger1">');
ret += printf('<thead><tr><th>Test</th><th>Valeur du test</th><th>Valeur normale</th><th>Effectué</th></tr></thead>');
ret += printf('<tfoot><tr><td colspan="4"><button type="button" onclick="addParamedicalTestAnswers()">Ajouter/Supprimer des tests</button></td></tr></tfoot>');
ret += printf('<tbody>');
ret += printf('<tr><td colspan="4"></td></tr>');
ret += printf('</tbody>');

$(this).siblings('.type').attr('disabled','disabled');
break;
case '3':
$(this).prev().after('Text');
break;
     }
    
     $(this).prev().after(ret);
     $(this).remove();
    
    });
    
});



function openDialog(dialogTitle, url, buttonOpts){
$( "#dialog" ).load(url).dialog({
title: dialogTitle,
modal: true,
show: { effect: 'shake', times: 2, duration: 70 },
position: 'center',
width: 900,
buttons: buttonOpts
});
}