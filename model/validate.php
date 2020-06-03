<?php

/**
 * Class Validate
 * Contains validation functions for my Dating project.
 *
 * @author      Corey Rogers
 * @version     3.0 (submitted 06/03/2020)
 */
class Validate
{



    /**
     *  Return a value indicating if name parameter is valid.
     *  Valid names are not empty and contain only letters
     *  @param String $name
     *  @return boolean
     */
    function validName($name)
    {
        $name = str_replace(' ', '', $name);
        return !empty($name) && ctype_alpha($name);

    }

    /**
     *  Return a value indicating if age parameter is valid.
     *  A valid age is not empty and is a number from 18 to 118
     *  @param String $age
     *  @return boolean
     */
    function validAge($age)
    {
        //echo $age . "<br>";
        //echo "age is " . is_numeric($age);
        return !empty($age) && is_numeric($age) && ($age >= 18 && $age <= 118);

    }

    /**
     *  Return a value indicating if phone parameter is valid.
     *  A valid phone number is not empty and contains ten numbers (note: method
     *  checks for parentheses, spaces, and dashes)
     *
     *  @param String $phone
     *  @return boolean
     */
    function validPhone($phone)
    {
        //remove dashes and parentheses, check for 10 characters (zip code required),
        // and make sure all characters are numbers
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace(' ', '', $phone);

        return !empty($phone) && (strlen($phone) == 10) && is_numeric($phone);

    }

    /**
     *  Return a value indicating if gender parameter is valid.
     *  A valid gender is one that is found in the array returned when
     *  the getGender() method from the data-layer.php file is called.
     *  @param String $gender
     *  @return boolean
     */
    function validGender($gender)
    {
        $genderSource = getGender();

        return in_array($gender, $genderSource);


    }

    /**
     *  Return a value indicating if email parameter is valid.
     *  A valid email is not empty and is considered a valid email address
     *  when using the filter_var() method with the FILTER_VALIDATE_EMAIL filter.
     *  @param String $email
     *  @return boolean
     */
    function validEmail($email)
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);

    }

    /**
     *  Return a value indicating if state parameter is valid.
     *  A valid state is one that is found in the array returned when
     *  the getStates() method from the data-layer.php file is called.
     *  @param String $state
     *  @return boolean
     */
    function validState($state)
    {
        $stateSource = getStates();

        return in_array($state, $stateSource);


    }

    /**
     *  Return a value indicating if the seeking parameter is valid.
     *  A valid seeking value is one that is found in the array returned when
     *  the getSeeking() method from the data-layer.php file is called.
     *  @param String $seeking
     *  @return boolean
     */
    function validSeeking($seeking)
    {
        $seekingSource = getSeeking();

        return in_array($seeking, $seekingSource);


    }

    /**
     *  Return a value indicating if the indoor parameter is valid.
     *  Each value in the indoor array is checked. A valid indoor array value
     *  is one that is found in the array created by merging the arrays returned when
     *  the getIndoor1() and getIndoor2() methods from the data-layer.php file are called.
     *  @param Array $indoor
     *  @return boolean
     */
    function validIndoor($indoor)
    {
        $indoorSource = array_merge(getIndoor1(), getIndoor2());

        foreach ($indoor as $selection) {
            if (!in_array($selection, $indoorSource)) {
                return false;
            }
        }

        return true;

    }

    /**
     *  Return a value indicating if the outdoor parameter is valid.
     *  Each value in the outdoor array is checked. A valid indoor array value
     *  is one that is found in the array created by merging the arrays returned when
     *  the getOutdoor1() and getOutdoor2() methods from the data-layer.php file are called.
     *  @param Array $outdoor
     *  @return boolean
     */
    function validOutdoor($outdoor)
    {
        $outdoorSource = array_merge(getOutdoor1(), getOutdoor2());

        foreach ($outdoor as $selection) {
            if (!in_array($selection, $outdoorSource)) {
                return false;
            }
        }

        return true;

    }

}


