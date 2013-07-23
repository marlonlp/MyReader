<?php
session_start();

require_once 'classes/twitteroauth.php';

$connection = new TwitterOAuth('UUDfh8fGQiVsQl2DgZUJg', 'AvThpAakyRUQb7inv6IWzAkIkioqY98RQoiUsPCo', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

$_SESSION['access_token'] = $access_token;

unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

if (200 == $connection->http_code)
    header('Location: ./');
else
    header('Location: ./');