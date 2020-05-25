<?php

/*
 * Created by:                Corey Rogers
 * Date submitted (v2.0):     05/26/2020
 * Assignment:                Dating Assignment - Part 2 - Routing
 * File Description:          This file contains validation functions for my Dating project.
 *
 */

function validName($name)
{
    $name = str_replace(' ', '', $name);
    return !empty($name) && ctype_alpha($name);

}

function validAge($age)
{
    //echo $age . "<br>";
    //echo "age is " . is_numeric($age);
    return !empty($age) && is_numeric($age) && ($age >= 18 && $age <= 118);

}

function validPhone($phone)
{
    //remove dashes and parentheses, check for 10 characters (zip code required),
    // and make sure all characters are numbers
    $phone = str_replace('(', '', $phone);
    $phone = str_replace(')', '', $phone);
    $phone = str_replace('-', '', $phone);
    return !empty($phone && ((strlen($phone) != 10) || is_nan($phone)));

}

function validEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);

}

function validOutdoor($outdoor)
{
    $outdoorSource = getOutdoor();

    foreach ($outdoor as $selection){
        if (!in_array($selection, $outdoorSource)) {
            return false;
        }
    }

}



