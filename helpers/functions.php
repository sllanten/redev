<?php

if (!function_exists('dd')) {
    function dd($data)
    {
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
        "tokenApi" => "951321Dev",
        "tokenAcceso" => "-20223528",
        "tokenLink"=> "javascript:void(0);"
    ];
}

function getYear(){
    $mes = date("m");
    $año = date("Y"); 
    $meses= [
        1=> "Enero",
        2=> "Febrero",
        3=> "Marzo",
        4=> "Abril",
        5=> "Mayo",
        6=> "Junio",
        7=> "Julio",
        8=> "Agosto",
        9=> "Septiembre",
        10=> "Octubre",
        11=> "Noviembre",
        12=> "Diciembre",
    ];
     return $message= $meses[(int)$mes]." - ".(int)$año;
}