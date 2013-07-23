<!DOCTYPE html>
<html>
    <head>
        <title>My Reader</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="icon" href="img/16.png">
    </head>
    <body>
        <?php
        if(isset($authUrl)) {
        ?>
            <section id='login-container'>
                <img src='img/128.png' alt='MR' class='header'>
                <h1 class="header-login header"><a href="./"><span class='preto'>My</span><br><span class='cinza'>Reader</span></a></h1>
                <div id='social-login' class='header'>
                    <?php echo "<span id='login-google' class='btn-login' data-url='$authUrl'><i class='icon-google-plus-sign'></i> Login Google Account</span>"; ?>
                    <span id='login-facebook' class='btn-login'><i class='icon-facebook-sign'></i> Login Facebook Account</span>
                    <span id='login-twitter' class='btn-login'><i class='icon-twitter-sign'></i> Login Twitter Account</span>
                </div>
            </section>
        <?php
        } else {
        ?>
        <header id="header">
            <img src='img/64.png' alt='MR' class='logo header'>
            <h1 class="header"><a href="./"><span class='preto'>My</span><br><span class='cinza'>Reader</span></a></h1>
            <span id='btn-logoff'>Logoff <i class='icon-signout'></i></span>
        </header>
        <?php if(isset($email)) { ?>
        <section id='geral'>
            <nav id='lateral'>
                <span id='form-incluir'>
                    <input type="url" placeholder="Cadastrar novo feed" id='url' autofocus="autofocus" size='30'>
                    <input type="hidden" id='email' value="<?php print $email ?>">
                    <span id='incluir'><i class="icon-plus"></i></span>
                    <span id='fechar'><i class='icon-remove'></i></span>
                </span>
                <span class='feed-header'>Feeds</span>
                <section id="feeds">
                    <ul id='menu'>
                    
                    </ul>
                </section>
            </nav>
            <section id='rss'>
                <div id='loading'><i class="icon-spinner icon-spin"></i> Carregando...</div>
                <h2 id='feed-title'></h2>
                <article id='feed-list'></article>
            
            </section>
        </section>
        <?php } ?>
        <a href="https://github.com/marlonlp/MyReader/" class='github'>Fork me on GitHub</a>
        <?php } ?>        
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