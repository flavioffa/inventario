<?php
require_once(realpath(MODEL_PATH . '/Part.php'));

$filter = filter_input(INPUT_POST, 'filter');
$action = filter_input(INPUT_POST, 'action');
$parts = empty($filter) ? Part::get() : Part::get(['division_id' => $filter]);
$result = [];
foreach($parts as $value) {
    array_push($result, ['id' => $value->id, 'name_part' => $value->name_part, 'division_id' => $value->division_id]);
}

echo(json_encode($result));