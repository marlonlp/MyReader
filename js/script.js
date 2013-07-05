$(document).ready(function(){
    
    $("#loading").ajaxStart(function(){
		$(this).show();
	});
	$("#loading").ajaxComplete(function(){
		$(this).hide();
	});			    
    $('#btn-incluir').click(function(){
        $('#form-incluir').show();
    });
    $('#rss').on('click', '.title', function(){
        $('.content').hide();
        $(this).next('.content').show();
    });
    $('#incluir').click(function(){
        var acao = 'incluir';
        var site = $('#url').val();
        $.ajax({
            type: 'POST',
            url: './rss.php',
            data: "acao=" + acao + "&site=" + site,
            success: function(txt){
                $('#menu').load('./menu.php');
                $('#url').val('');
            },
            error: function(txt){
                alert('Ocorreu um erro. ' + txt);
            }            
        });
    });
    $('#fechar').click(function(){
        $('#form-incluir').hide();
    });
    $('#menu').on('click', 'li', function() {
        var id_site = $(this).attr('data-site');
        var feed_title = $(this).attr('data-title');
        var acao = 'listar';
        $('#feed-title').empty();
        $('#feed-list').empty();
        $.ajax({
            type: 'POST',
            url: './rss.php',
            data: "acao=" + acao + "&site=" + id_site,
            beforeSend: function(){
                $('#loading').show();
            },            
            success: function(txt){
                $('#loading').hide();
                $('#feed-title').append(feed_title);
                $('#feed-list').append(txt);
            },
            error: function(txt){
                $('#loading').hide();
                alert('Ocorreu um erro. ' + txt);
            }
        });
        return false;
    });

    $('#btn-logoff').click(function(){
        window.location = '?logout';
    }); 
    $('#btn-login').click(function(){
        var url = $(this).attr('data-url');
        window.location = url;
    }); 
});