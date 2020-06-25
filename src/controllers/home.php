<?php
session_start();
requireValidSession();

// Dados do usuário logado
$user = $_SESSION['user'];

loadTemplateView('home', [
    $user
]);
