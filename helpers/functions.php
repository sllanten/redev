<?php

if (!function_exists('dd')) {
    function dd($data){
        var_dump($data);
        die();
    }
}

function dump($data){
    print_r($data);
}

function mypass($value){
    return password_hash($value, PASSWORD_BCRYPT);
}

function mypass_check($value, $hashed){
    return password_verify($value, $hashed);
}

function configApp(){
   return $data= [
        "tokenLink"=> "javascript:void(0);",
        "urlBase" => "http://devsllanten.com/",
        "tokenSup" => "U2FsdGVkX1/NNdXvf9tyOIhZMJnn9lcrm/aqL19f/Ew="
    ];
}

function getYear(){
    $mes = date("m");
    $año = date("Y");
    $dia = date("d");
    return $año."-".$mes."-".$dia;
}

function getUserSeccion(){
    session_start();
    return (int)$_SESSION['user_id'];
}