function ligaBotao(nome){
	$(nome).removeClass('grey darken-4');
	$(nome).addClass('teal darken-1');
	$(nome).html('<i id="save" class="material-icons">highlight</i>');
}

function desligaBotao(nome){
	$(nome).removeClass('teal darken-1');
    $(nome).addClass('grey darken-4');
    $(nome).html('<i id="save" class="material-icons">highlight_off</i>');
}