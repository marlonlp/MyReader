<?php
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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Reader</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="icon" href="img/myreader-logo.png">
    </head>
    <body>
        <header id="caption">
            <h1><a href="./"><span class='preto'>My</span><span class='cinza'>Reader</span></a></h1>
            <?php if(isset($email)): ?>
            <span id='btn-incluir'>Inscrever novo RSS <i class="icon-rss"></i></span>
            <span id='form-incluir'>
                <input type="url" placeholder="Endereço RSS" id='url' autofocus="autofocus">
                <input type="hidden" id='email' autofocus="autofocus" value="<?php print $email ?>">
                <span id='incluir'><i class="icon-ok"></i></span>
                <span id='fechar'><i class='icon-remove'></i></span>
            </span>
            <?php endif ?>
            <?php
                if(isset($authUrl)) {
                    print "<span id='btn-login' data-url='$authUrl'>Login <i class='icon-signin'></i></span>";
                } else {
                    print "<span id='btn-logoff'>Logoff <i class='icon-signout'></i></span>";
                }
            ?>
        </header>
        <?php if(isset($email)): ?>
        <section id='geral'>
            <nav id='lateral'>
                <ul id='menu'>
                    
                </ul>
            </nav>
            <section id='rss'>
                <div id='loading'><i class="icon-spinner icon-spin"></i> Carregando...</div>
                <h2 id='feed-title'></h2>
                <article id='feed-list'></article>
            
            </section>
        </section>
        <?php endif ?>
        <a href="https://github.com/marlonlp/MyReader/"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
        <script src="js/jquery.js"></script>
        <script src="js/script.js"></script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', 'UA-42231172-1', 'myreader.com.br');
          ga('send', 'pageview');
        
        </script>        
    </body>
</html>