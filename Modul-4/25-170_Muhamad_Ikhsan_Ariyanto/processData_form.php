<?php
$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    require 'validate.inc';
    validateName($errors, $_POST, 'surename');
    validateEmail($errors, $_POST, 'email');
    validateRequired($errors, $_POST, 'passwd');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateRequired($errors, $_POST, 'sex');

    if ($errors)
    {
        echo '<fieldset><h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error)
            echo "$field $error</br>";
        echo "</fieldset></br>";

        include 'form.inc';

    }
    else {
        echo 'Form submitted successfully with no errors';
    }
} else
    include 'form.inc';
?>