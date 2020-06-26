<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Part.php'));

$unit_initials = $_GET['unit'];
$division_id = $_GET['division'];
$parts = Part::get(['division_id' => $division_id]);
$exception = null;
$partData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $part = Part::getOne(['id' => $_GET['update']]);
    $partData = $part->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbpart = new Part($_POST);
        if($dbpart->id) {
            $dbpart->update();
            addSuccessMsg('Órgão alterado com sucesso!');
            header("Location: parts.php?unit={$unit_initials}&division={$division_id}");
            exit();
        } else {
            $dbpart->insert();
            addSuccessMsg('Órgão cadastrado com sucesso!');
            header("Location: parts.php?unit={$unit_initials}&division={$division_id}");
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $partData = $_POST;
    }
}

loadTemplateView('parts/save_part', $partData + [
    'exception' => $exception,
    'parts'=> $parts,
    'unit_initials' => $unit_initials,
    'division_id' => $division_id
]);