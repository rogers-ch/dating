<?php

/*
 * Created by:                Corey Rogers
 * Date submitted (v1.0):     04/29/2020
 * Assignment:                Dating Assignment - Part 1 - Setup
 * File Description:          This is controller for my dating website
 *
 */


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Instantiate the F3 Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET|POST /', function($f3) {
    //echo '<h1>Hello world!</h1>';


    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {

        //Redirect to summary page
        $f3->reroute('personalInformation');

    }

    $view = new Template();
    echo $view->render('views/home.html');

});


//Personal Information route
$f3->route('GET /personalInformation', function(){
    echo '<h1>Hello out there</h1>';

    /*
    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        //var_dump($_POST);

        //validate data - NOT DONE YET

        //data is valid
        //Store the data in the session array
        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];

        var_dump($_SESSION);

        //Redirect to summary page
        //$f3->reroute('orderTwo');

    }
    */


    //$view = new Template();
    //echo $view->render("views/personal_info.html");

});


//Run fat free
$f3->run();