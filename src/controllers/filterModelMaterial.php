<?php
require_once(realpath(MODEL_PATH . '/ModelMaterial.php'));

$filter = filter_input(INPUT_GET, 'filter');
$modelMaterial = empty($filter) ? ModelMaterial::get(['raw' => "1 = 1 ORDER BY name_model ASC"]) : ModelMaterial::get(['type_id' => $filter, 'raw' => "1 = 1 ORDER BY name_model ASC"]);
$result = [];
foreach($modelMaterial as $value) {
    array_push($result, ['id' => $value->id, 'name_model' => $value->name_model, 'type_id' => $value->type_id]);
}

echo(json_encode($result));