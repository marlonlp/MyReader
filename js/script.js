$(document).ready(function(){
    carregaMenu();
    $("#loading").ajaxStart(function(){
		$(this).show();
	});
	$("#loading").ajaxComplete(function(){
		$(this).hide();
	});
    function carregaMenu(){
        $('#menu').load('./menu.php?email=' + $('#email').val());
    }
    $('#incluir').click(function(){
        var acao = 'incluir';
        var site = $('#url').val();
        var email = $('#email').val();
        if(/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(site)){
            $.ajax({
                type: "GET",
                url: site,
                dataType: "xml",
                success: function(xml) {
                    if($(xml).find("title")) {
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
                    }
                },
                error: function(){
                    alert('O endereço informado não é um feed RSS válido !');
                }
            });
        } else {
            alert("Feed Inválido! Verifique o endereço informado.");
        }        
    });
    $('#menu').on('click', 'li', function() {
        $('#menu li').removeClass('ativo');
		var id = this.id;
        var subs = $(this).attr('data-subscription');
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
                $('#feed-title').append(feed_title + " <i id='" + subs + "' class='icon-remove cancela-feed'></i>");
                $('#feed-list').append(txt);
            },
            error: function(txt){
                $('#loading').hide();
                alert('Ocorreu um erro. ' + txt);
            }
        });
        return false;
    });
    $('#feed-title').on('click', '.cancela-feed', function(){
        var confirma = confirm('Deseja cancelar a inscrição deste feed ?');
        if(confirma) {
            var id = $(this).attr('id');
            var acao = 'excluir';
            var email = $('#email').val();
            $.ajax({
                type: 'POST',
                url: './rss.php',
                data: "acao=" + acao + "&id=" + id,
                success: function(txt){
                    $('#feed-title').empty();
                    $('#feed-list').empty();
                    carregaMenu();
                },
                error: function(txt){
                    alert('Ocorreu um erro. ' + txt);
                }            
            });
        }
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
    function formataData(data){
        function pad(n){return n<10 ? '0'+n : n}
        return data.getUTCFullYear()+'-'+ pad(data.getUTCMonth()+1)+'-'+ pad(data.getUTCDate())
    }
});