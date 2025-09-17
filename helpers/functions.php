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

function configApp(){
   return $data= [
        "tokenLink"=> "javascript:void(0);",
        "urlBase" => "http://devsllanten.com/",
        "tokenSup" => "U2FsdGVkX1/NNdXvf9tyOIhZMJnn9lcrm/aqL19f/Ew=",
        "key"=> "12345678901234567890123456789012",
        "iv"=> "12345678901234567890123456789012"
    ];
}

function cifrarAES($texto){
    return base64_encode(openssl_encrypt($texto, "AES-256-CBC",  configApp()['key'], OPENSSL_RAW_DATA, configApp()['iv']));
}

function descifrarAES($texto){
    return openssl_decrypt(base64_decode($texto), "AES-256-CBC", configApp()['key'], OPENSSL_RAW_DATA, configApp()['iv']);
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