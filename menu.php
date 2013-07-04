<?php
    header("Content-Type:text/html; charset=utf-8",true);
    require_once 'classes/class.conexao.php';
    $conexao = new Conexao();
        $sql = "SELECT * FROM subscriptions ORDER BY title ASC";
        $conexao->Executar($sql);
        if($conexao) {
            while ($rs = $conexao->MostrarResultados()) {
                $id = $rs[0];
                $site = $rs[1];
                $title = $rs[2];
            echo "<li id='$id' data-site='$site' data-title='$title'>$title</li>";
            }
        }