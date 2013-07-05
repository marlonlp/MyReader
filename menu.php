<?php
    header("Content-Type:text/html; charset=utf-8",true);
    require_once 'classes/class.conexao.php';
    $email = strip_tags($_GET['email']);
    $conexao = new Conexao();
    $sql = "SELECT subscriptions.id, subscriptions.site, subscriptions.title ";
    $sql .= "FROM subscriptions, users, user_subscription ";
    $sql .= "WHERE user_subscription.id_user = users.id ";
    $sql .= "AND subscriptions.id = user_subscription.id_subscription AND email = '$email' ORDER BY title ASC";
    $conexao->Executar($sql);
    if($conexao) {
        while ($rs = $conexao->MostrarResultados()) {
            $id = $rs[0];
            $site = $rs[1];
            $title = $rs[2];
        echo "<li id='$id' data-site='$site' data-title='$title'><i class='icon-rss-sign'></i> $title</li>";
        }
    }