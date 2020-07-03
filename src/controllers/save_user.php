<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Unit.php'));

$exception = null;
$userData = [];
$ranks = [
    'Ten. Brig.', 'Maj. Brig.', 'Brig.',
    'Cel', 'Ten Cel', 'Maj',
    'Cap',
    '1º Ten', '2º Ten', 'Asp',
    'SO', '1S', '2S', '3S',
    'CB', 'TM', 'S1', 'T1', 'S2', 'T2'        
];
$units = Unit::get();

if(count($_POST) === 0 && isset($_GET['update'])) {
    $user = User::getOne(['id' => $_GET['update']]);
    $userData = $user->getValues();
    $userData['password'] = null;
} elseif(count($_POST) > 0) {
    if(empty($_POST['id'])) {
        $_POST['password'] = $_POST['email'];
        $_POST['confirm_password'] = $_POST['password'];
    }
    try {
        $dbUser = new User($_POST);
        if($dbUser->id) {
            $dbUser->update();
            addSuccessMsg('Usuário alterado com sucesso!');
            header('Location: users.php');
            exit();
        } else {
            $dbUser->insert();
            addSuccessMsg('Usuário cadastrado com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $userData = $_POST;
    }
}

loadTemplateView('users/save_user', $userData + [
    'exception' => $exception,
    'ranks' => $ranks,
    'units' => $units
]);