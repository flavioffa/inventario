<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Manufacturer.php'));

$exception = null;
$manufacturerData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $manufacturer = Manufacturer::getOne(['id' => $_GET['update']]);
    $manufacturerData = $manufacturer->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbManufacturer = new Manufacturer($_POST);
        if($dbManufacturer->id) {
            $dbManufacturer->update();
            addSuccessMsg('Fabricante alterado com sucesso!');
            header("Location: manufacturers.php");
            exit();
        } else {
            $dbManufacturer->insert();
            addSuccessMsg('Fabricante cadastrado com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $manufacturerData = $_POST;
    }
}

loadTemplateView('settings/save_manufacturer', $manufacturerData + [
    'exception' => $exception
]);