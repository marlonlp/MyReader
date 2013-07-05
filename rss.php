<?php
    require_once 'classes/class.conexao.php';
    $acao = strip_tags($_POST['acao']);
    ini_set('allow_url_fopen', 1);
    ini_set('allow_url_include', 1);
    
    if($acao == 'listar') {
    
        $feed = strip_tags($_POST['site']);
        $id = strip_tags($_POST['id']);
        
        $rss = simplexml_load_file($feed);
        //$limit = 10;
        $count = 0;
        $retorno = '';
        
        if($rss) {
            foreach ( $rss->channel->item as $item ) {
            	$conexao = new Conexao();
            	$sql = "SELECT link FROM feeds WHERE link = '".$item->link."'";
		        $conexao->Executar($sql);
		        if($conexao->ContarLinhas() == 0) {
		        	$sql = "INSERT INTO feeds (id_subscription, link) VALUES ($id, '".$item->link."')";
		        	$conexao->Executar($sql);
		        };
                $retorno .= '<span id="'.$item->link.'" class="title ">'.$item->title.'</span>
                <div class="content">'.$item->children('content', true).'</div>';
                $count++;
                //if($count == $limit) break;
            }
            echo $retorno;
        } else {
            echo 'Não foi possível acessar o feed.';
        }
    } else if ($acao == 'incluir') {
        $conexao = new Conexao();
        $site = strip_tags($_POST['site']);
        $email = strip_tags($_POST['email']);
        $rss = simplexml_load_file($site);
        $limit = 1;
        
        if($rss) {
            $title = $rss->channel->title;
        } else {
            echo 'Não foi possível acessar o feed.';
        }
        
        $sql = "SELECT site FROM subscriptions WHERE site = '$site'";
        $conexao->Executar($sql);
        if($conexao->ContarLinhas() == 0) {
        	$sql = "INSERT INTO subscriptions (site, title) VALUES ('$site', '$title')";
        	$conexao->Executar($sql);
        };
        
        $get_subscription = "SELECT id FROM subscriptions WHERE site = '$site'";
        $conexao->Executar($get_subscription);
        if ($conexao) {
        	while ($rs = $conexao->MostrarResultados()) {
        		$id_subscription = $rs[0];
        	} 
        }
        
        $get_id = "SELECT id FROM users WHERE email = '$email'";
        $conexao->Executar($get_id);
        if($conexao) {
        	while ($rs = $conexao->MostrarResultados()) {
        		$id_user = $rs[0];
        	}
        }
        $sql = "SELECT * FROM user_subscription WHERE id_user = '$id_user' AND id_subscription = '$id_subscription'";
        $conexao->Executar($sql);
        if($conexao->ContarLinhas() == 0) {
        	$user_subscription = "INSERT INTO user_subscription (id_user, id_subscription) VALUES ('$id_user', '$id_subscription')";
        	$conexao->Executar($user_subscription);
        };
    }
?>