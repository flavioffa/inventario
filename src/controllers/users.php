<?php
session_start();
requireValidSession(true);

$exception = null;
$loggedId = intval($_SESSION['user']->id);

if(isset($_GET['delete']) && $loggedId !== intval($_GET['delete'])) {
    try {
        User::deleteById($_GET['delete']);
        addSuccessMsg('Usuário excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir usuário resgistrado em alguma escala.');
        } else {
            $exception = $e;
        }
    }
}

$users = User::get();

loadTemplateView('users/users', [
    'loggedId' => $loggedId,
    'users' => $users,
    'exception' => $exception
]);