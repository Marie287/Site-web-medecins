<?php
  require 'lib/Medoo.php';
  use Medoo\Medoo;
    
  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'projet',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
  ]);
    
?>
