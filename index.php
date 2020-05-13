<?php

/*
 * Created by:                Corey Rogers
 * Date submitted (v2.0):     05/13/2020
 * Assignment:                Dating Assignment - Part 2 - Routing
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

//Require data-layer file
require_once('model/data-layer.php');

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
$f3->route('GET|POST /PersonalInformation', function($f3){
    //echo '<h1>Hello out there</h1>';


    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        //var_dump($_POST);

        //validate data - ADD LATER

        //data is valid
        //Store the data in the session array
        $_SESSION['firstName'] = $_POST['firstName'];
        $_SESSION['lastName'] = $_POST['lastName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];

        var_dump($_SESSION);

        //Redirect to summary page
        $f3->reroute('profile');

    }


    $view = new Template();
    echo $view->render("views/personal_info.html");

});


//Profile route
$f3->route('GET|POST /Profile', function($f3){
    //echo '<h1>Hello out there</h1>';

    //add states array to hive
    $f3->set('states', getStates());

    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        //var_dump($_POST);

        //validate data - ADD LATER

        //data is valid
        //Store the data in the session array
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];

        //var_dump($_SESSION);

        //Redirect to summary page
        $f3->reroute('interests');

    }


    $view = new Template();
    echo $view->render("views/profile.html");

});

//Interests route
$f3->route('GET|POST /Interests', function($f3){
    //echo '<h1>Hello out there</h1>';


    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        //var_dump($_POST);

        //validate data - ADD LATER

        //data is valid
        //Store the data in the session array
        $_SESSION['indoor'] = $_POST['indoor'];
        $_SESSION['outdoor'] = $_POST['outdoor'];

        //var_dump($_SESSION);

        //Redirect to summary page
        $f3->reroute('profileSummary');

    }


    $view = new Template();
    echo $view->render("views/interests.html");

});


//Profile Summary route
$f3->route('GET|POST /ProfileSummary', function($f3){
    //echo '<h1>Hello out there</h1>';

    $view = new Template();
    echo $view->render("views/profile_summary.html");

    session_destroy();

});


//Run fat free
$f3->run();