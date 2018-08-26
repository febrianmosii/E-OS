<?php
session_start();

if ($_SESSION['id_auth_user']) 
{
	session_destroy();
    echo TRUE;
}