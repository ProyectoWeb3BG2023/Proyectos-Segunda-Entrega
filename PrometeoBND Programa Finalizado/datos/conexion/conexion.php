<?php

function conectar()
{
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd   = "prometeobnd20";
    $con  = mysqli_connect($host, $user, $pass, $bd);
    return $con;
}

function conectgar()
{
    $host = "192.168.2.209";
    $user = "prometeobnd";
    $pass = "2023bndp";
    $bd   = "prometeobnd";
    $con  = mysqli_connect($host, $user, $pass, $bd);
    return $con;
}

function conectarInformatico()
{
    $host = "localhost";
    $user = "Informatico";
    $pass = "";
    $bd   = "prometeobnd20";
    $con  = mysqli_connect($host, $user, $pass, $bd);
    return $con;
}

function conectarGerente()
{
    $host = "localhost";
    $user = "Gerente";
    $pass = "";
    $bd   = "prometeobnd20";
    $con  = mysqli_connect($host, $user, $pass, $bd);
    return $con;
}

function conectarJefeCocina()
{
    $host = "localhost";
    $user = "JefeCocina";
    $pass = "";
    $bd   = "prometeobnd20";
    $con  = mysqli_connect($host, $user, $pass, $bd);
    return $con;
}

function conectarAdministrativo()
{
    $host = "localhost";
    $user = "Administrativo";
    $pass = "";
    $bd   = "prometeobnd20";
    $con  = mysqli_connect($host, $user, $pass, $bd);
    return $con;
}

function conectarAtencionCliente()
{
    $host = "localhost";
    $user = "AtencionCliente";
    $pass = "";
    $bd   = "prometeobnd20";
    $con  = mysqli_connect($host, $user, $pass, $bd);
    return $con;
}