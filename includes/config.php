<?php
try
{
    $db = new PDO('mysql:host=localhost;dbname=admin_st', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
