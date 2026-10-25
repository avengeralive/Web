<?php
$data = array();
foreach ($labs as &$lab) {
    $data[] = $lab['Lab'];
}
echo json_encode($data);?>