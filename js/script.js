$(document).ready(function(){
    carregaMenu();
    $("#loading").ajaxStart(function(){
		$(this).show();
	});
	$("#loading").ajaxComplete(function(){
		$(this).hide();
	});
    $('#btn-incluir').click(function(){
        $('#form-incluir').show();
    });
    function carregaMenu(){
        $('#menu').load('./menu.php?email=' + $('#email').val());
    };
    $('#incluir').click(function(){
        var acao = 'incluir';
        var site = $('#url').val();
        var email = $('#email').val();
        $.ajax({
            type: 'POST',
            url: './rss.php',
            data: "acao=" + acao + "&site=" + site + "&email=" + email,
            success: function(txt){
                $('#menu').load('./menu.php?email=' + email + '');
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
        $('#menu li').removeClass('ativo');
		var id = this.id;
        var ativo = this;
        var id_site = $(this).attr('data-site');
        var feed_title = $(this).attr('data-title');
        $(this).addClass('ativo');
        var acao = 'listar';
        $('#feed-title').empty();
        $('#feed-list').empty();
        $.ajax({
            type: 'POST',
            url: './rss.php',
            data: "acao=" + acao + "&site=" + id_site + "&id=" + id,
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
    $('#login-google').click(function(){
        var url = $(this).attr('data-url');
        window.location = url;
    }); 

    $('#login-facebook').click(function(){
        alert('Em breve !');
    });
                               
    $('#login-twitter').click(function(){
        alert('Em breve !');
    });
                                   
    if ($('#feed-list')[0]){
        $('#feed-list').on('click','.title', function(e){
            e.preventDefault();		
            $(this).next().toggle(); 
            $(this).parent('.title').toggleClass('collapse');
        } );
    }
    $('#feed-list').on('each', function($){
        if (!$('.title').hasClass('extended')){
            $(this).next().hide();
            alert(this.id);
            $(this).parent('.title').toggleClass('collapse');
        }
    });    
});