<?php
require_once 'includes/Requests.php';

if (isset($_POST['email'])) 
{
     $request = new Requests();
     $result   = $request->check_login($_POST['email'], $_POST['password']);
     echo $result;
}