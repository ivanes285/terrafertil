<?php
session_start(); //inicializamos la session
session_destroy();
header('location: ../');
?>