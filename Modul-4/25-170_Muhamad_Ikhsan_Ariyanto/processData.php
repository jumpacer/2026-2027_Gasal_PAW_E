<?php
    require 'validate.inc'; 
    $errors = array();
    validateName($errors, $_POST, 'surename'); 
    validateEmail($errors, $_POST, 'email');
    validateRequired($errors, $_POST, 'passwd');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateRequired($errors, $_POST, 'sex');
    
    if ($errors)
    {
        echo 'Errors:<br/>';
        foreach ($errors as $field => $error)
        echo "$field $error</br>";
    } else
        echo 'Data OK!';
?>