<?php

function dd($value){
    echo "<pre>";
    print_r(json_encode($value));
    echo "</pre>";
    exit;
}