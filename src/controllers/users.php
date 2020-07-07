<?php
session_start();
requireValidSession(true);

$exception = null;
$loggedId = intval($_SESSION['user']->id);
$search = filter_input(INPUT_GET, 'searchTerm');

if(isset($_GET['delete']) && $loggedId !== intval($_GET['delete'])) {
    try {
        User::deleteById($_GET['delete']);
        $search = null;
        addSuccessMsg('Usuário excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir usuário resgistrado em alguma escala.');
        } else {
            $exception = $e;
        }
    }
}

if(empty($search)) {
    $users = User::get(['raw' => "name != '' ORDER BY rank DESC"]);
} else {
    $users = User::get(['raw' => "name LIKE '%{$search}%' ORDER BY rank DESC"]);
}

loadTemplateView('users/users', [
    'loggedId' => $loggedId,
    'users' => $users,
    'exception' => $exception,
    'search' => $search
]);