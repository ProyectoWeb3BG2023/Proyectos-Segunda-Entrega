<?php

function conectar()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd   = "prometeobnd3";

    $con  = mysqli_connect($host, $user, $pass, $bd);
    
    return $con;
}