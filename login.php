<?php
if (isset($_REQUEST['google']) {
    require_once 'classes/Google_Client.php';
    require_once 'classes/contrib/Google_Oauth2Service.php';
    
    session_start();
    
    $client = new Google_Client();
    $client->setApplicationName("My Reader");
    $client->setClientId('266746408635.apps.googleusercontent.com');
    $client->setClientSecret('f2N0jotdMp4hzZGGxtcEh4I8');
    $client->setRedirectUri('http://myreader.com.br/');
    $oauth2 = new Google_Oauth2Service($client);
    
    if (isset($_REQUEST['logout'])) {
        unset($_SESSION['access_token']);
    }
    
    if (isset($_GET['code'])) {
      $client->authenticate($_GET['code']);
      $_SESSION['token'] = $client->getAccessToken();
      $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
      header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
      return;
    }
    
    if (isset($_SESSION['token'])) {
     $client->setAccessToken($_SESSION['token']);
    }
    
    if (isset($_REQUEST['logout'])) {
      unset($_SESSION['token']);
      $client->revokeToken();
    }
    
    if ($client->getAccessToken()) {
      $user = $oauth2->userinfo->get();
    
      $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
      $name = filter_var($user['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        require_once 'classes/class.conexao.php';
        
        $conexao = new Conexao();
        
        $sql = "SELECT email FROM users WHERE email = '$email'";
        $conexao->Executar($sql);
        if($conexao->ContarLinhas() == 0) {
            $sql = "INSERT INTO users (nome, email) VALUES ('$name', '$email')";
            $conexao->Executar($sql);
        };
    
      $_SESSION['token'] = $client->getAccessToken();
    } else {
      $authUrl = $client->createAuthUrl();
    }
}
?>