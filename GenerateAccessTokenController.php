<?php
    require_once "AccessToken.php";

    $token = new AccessToken(false);
    $token->generateAccessToken();

    wp_mail('your_email@email.com', 'Access Token Updated', $token->getAccessToken());