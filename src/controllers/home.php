<?php
session_start();
requireValidSession();
require_once(realpath(MODEL_PATH . '/Material.php'));

$materialsByDivisions = Material::countTotalMaterialsByDivisions();
$materialsByStatus = Material::countTotalMaterialsByStatus();
$inUse = Material::getCount(['condition_id' => 1]);
$inStock = Material::getCount(['condition_id' => 2]);
$broke = Material::getCount(['condition_id' => 3]);


loadTemplateView('home',[
    'inUse' => $inUse,
    'inStock' => $inStock,
    'broke' => $broke,
    'materialsByDivisions' => $materialsByDivisions,
    'materialsByStatus' => $materialsByStatus
]);