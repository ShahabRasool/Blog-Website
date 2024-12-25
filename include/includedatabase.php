<?php 
try{
    // first we make connection from data base;
$host ='localhost';
$username='root';
$password='';
$charset ='utf8';
// $port='3306';
$dbName='blog';
// here we decleared a veriable 
$dsn= "mysql:host=$host;dbname=$dbName;charset=$charset";
// this is going to be class in object oriented programing
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $se){
    print_r($se->errorInfo);
}