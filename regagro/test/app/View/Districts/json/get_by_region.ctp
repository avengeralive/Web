<?php
$data = array();
foreach ($districts as &$district) {
    $data[] = $district['District'];
}
echo json_encode($data);?>