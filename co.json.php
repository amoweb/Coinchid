<?php

function getJsonElementById($list, $id) {
    foreach($list as $e) {
        if(intval($e->id) == intval($id)) {
            return $e;
        }
    }

    return NULL;
}

function readJson($fileName) {
    $jsontxt = file_get_contents($fileName);
    return json_decode($jsontxt);
}

function writeJson($fileName, $json) {
    $jsontxt = json_encode($json);
    file_put_contents ( $fileName, $jsontxt );
}

?>
