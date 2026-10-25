<?php
function validateName(&$errors, $field_list, $field_name){
    if (trim($field_list[$field_name]) == ''){
        $errors[$field_name] = "required";
        return;
    }
    
    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = "invalid";
}

function validateEmail(&$errors, $field_list, $field_name){
    if (trim($field_list[$field_name]) == ''){
        $errors[$field_name] = "required";
        return;
    }

    if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL))
        $errors[$field_name] = "invalid";
}

function validateRequired(&$errors, $field_list, $field_name){
    if (!isset($field_list[$field_name]))
        $errors[$field_name] = "required";
}

function validateAddress(&$errors, $field_list, $field_name){
    if (trim($field_list[$field_name]) == '')
        $errors[$field_name] = "required";
}

function validateState(&$errors, $field_list, $field_name){
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == -1)
        $errors[$field_name] = "required";
}