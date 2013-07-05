<?php
    require_once 'classes/class.conexao.php';
    $acao = strip_tags($_POST['acao']);
    ini_set('allow_url_fopen', 1);
    ini_set('allow_url_include', 1);
    
    if($acao == 'listar') {
    
        $feed = strip_tags($_POST['site']);
        
        $rss = simplexml_load_file($feed);
        $limit = 10;
        $count = 0;
        $retorno = '';
        
        if($rss) {
            foreach ( $rss->channel->item as $item ) {
                $retorno .= '<span id="'.$item->link.'" class="title">'.$item->title.'</span>
                <div class="content">'.$item->children('content', true).'</div>';
                $count++;
                if($count == $limit) break;
            }
            echo $retorno;
        } else {
            echo 'Não foi possível acessar o feed.';
        }
    } else if ($acao == 'incluir') {
        $conexao = new Conexao();
        $site = strip_tags($_POST['site']);
        $rss = simplexml_load_file($site);
        $limit = 1;
        
        if($rss) {
            $title = $rss->channel->title;
        } else {
            echo 'Não foi possível acessar o feed.';
        }        
        $sql = "INSERT INTO subscriptions (site, title) VALUES ('$site', '$title')";
        $conexao->Executar($sql);
    }
?>