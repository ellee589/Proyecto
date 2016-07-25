
function postUrlDiv(URL, params, destDivId){
        $(destDivId).html("<div><div class='load-msg'><img src='img/load.gif' class='gifload'><p>Cargando...</p></div></div>");
	$.ajax({
		url: URL,
		async: false,
		method: 'post',
		data: params,
		success: function(html, status, xhr){
			$(destDivId).html(html);		
		}	
	});
}

function getCheckedInputs(){
    return $("input:checked");
}