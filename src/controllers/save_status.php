<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Status.php'));

$exception = null;
$statusData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $status = Status::getOne(['id' => $_GET['update']]);
    $statusData = $status->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbStatus = new Status($_POST);
        if($dbStatus->id) {
            $dbStatus->update();
            addSuccessMsg('Status alterado com sucesso!');
            header("Location: status.php");
            exit();
        } else {
            $dbStatus->insert();
            addSuccessMsg('Status cadastrado com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'name_status')) {
            addErrorMsg('Não é possível usar status duplicado.');
        } elseif(stripos($e->getMessage(), 'color_status')) {
            addErrorMsg('Não é possível usar cor em uso para outro status.');
        } else {    
            $exception = $e;
        }
    } finally {
        $statusData = $_POST;
    }
}

loadTemplateView('settings/save_status', $statusData + [
    'exception' => $exception
]);