<?php
/**
 * Classe de controle conexão com o banco de dados;
 *
 * @author Marlon Pacheco
 */

class Conexao {

    //Dados de conexão com o banco.
    var $host = "localhost"; // Nome do Servidor
    var $user = "root"; // Usuário do Servidor MySQL
    var $pass = ""; // Senha do Usuário MySQL
    var $dbase = "my_reader"; // Nome do Banco de Dados

    //Variáveis utilizadas na classe;
    var $sql;
    var $link;
    var $result;
    
    //Tabelas utilizadas pelo sistema;
    var $tbSubscriptions = 'subscriptions';
    var $tbItems = 'items';

    //Função para conexão ao Banco MySQL.
    function Conexao(){
        $this->link = mysql_connect($this->host,$this->user,$this->pass);
    //Conecta ao Banco de Dados
        if(!$this->link){
      //Caso ocorra um erro, exibe uma mensagem com o erro
            print "Ocorreu um Erro na conexão MySQL:";
            print "<b>".mysql_error()."</b>";
            die();
        }elseif(!mysql_select_db($this->dbase,$this->link)){
      //Seleciona o banco após a conexão
      //Caso ocorra um erro, exibe uma mensagem com o erro
            print "Ocorreu um Erro em selecionar o Banco:";
            print "<b>".mysql_error()."</b>";
            die();
        }
    }

    //Função para executar as "querys" no Banco de Dados
    function Executar($sql){
        $this->Conexao();
        mysql_query("SET NAMES 'utf8'");
        $this->sql = $sql;
        
    //Conecta e executa a query no MySQL
        if($this->result = mysql_query($this->sql)){
            $this->Liberar();
            return $this->result;
        }else{
            // Caso ocorra um erro, exibe uma mensagem com o Erro
            print "Ocorreu um erro ao executar a Query MySQL: <b>$sql</b>";
            print "<br><br>";
            print "Erro no MySQL: <b>".mysql_error()."</b>";
            die();
            $this->Liberar();
        }        
    }
    
    //Função para verificar a quantidade de linhas retornadas pela consulta;
    function ContarLinhas() {
        $lines = mysql_num_rows($this->result);
        return $lines;
    }
    
    //Função para exibir os resultados da consulta;
    function MostrarResultados() {
        $lines = mysql_fetch_array($this->result);
        return $lines;
    }

    //Função para Desconectar do Banco MySQL;
    function Liberar(){
        return mysql_close($this->link);
    }
    
    //Função de escape de string para tratamento antes da inserção no banco;
    function escape($str) {
        $str = get_magic_quotes_gpc()?stripslashes($str):$str;
        $str = mysql_real_escape_string($str, $this->link);
        return $str;
    }
}
?>
