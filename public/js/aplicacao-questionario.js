$( document ).ready(function() {
    $('.turmas').click(function(){
        if($(this).hasClass('btn-primary')){
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-light');
        }
        else{
            $(this).addClass('btn-primary');
            $(this).removeClass('btn-light');
        }
    });

    $('#btnLimpar').on('click',function(){
    	$('#dataInic').val('');
    	$('#dataFim').val('');
    	$('#questionario').val('');
    	$('li').removeClass('active');
    });

});