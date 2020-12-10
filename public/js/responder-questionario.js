function responder(classe,alternativa) 
{
	$alternativas = document.getElementsByClassName(classe);

	for(var i=0; i<$alternativas.length; i++) {
		
	    $alternativas[i].classList.remove('btn-primary');
	    $alternativas[i].classList.add('btn-light');
	}

	document.getElementById(alternativa).classList.remove('btn-light');
	document.getElementById(alternativa).classList.add('btn-primary');

}



function finalizar() 
{
	var erros = 0;

	jQuery("#questionario input[type='radio']").each(function(){
        var name = $(this).attr("name");

        if(!jQuery("input:radio[name='"+name+"']").is(':checked')){
            erros++;
    }});

    if(erros > 0)
    {
        alert('Todas as perguntas devem ser respondidas!');
        erros =0;
    }

    else 
    {
        $('#questionario').submit();    }
}
       
