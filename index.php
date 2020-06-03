<?php

/*
 * Created by:                Corey Rogers
 * Date submitted (v4.0):     06/03/2020
 * Assignment:                Dating Assignment - Part 2 - Routing
 * File Description:          This is controller for my dating website
 *
 */


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Require data-layer file
require_once('model/data-layer.php');

//Start a session
session_start();

//Instantiate the F3 Base class
$f3 = Base::instance();

//Instantiate a Validate object
$validator = new Validate;

//Instantiate a Controller object
$controller = new Controller($f3, $validator);


//Define a default route
$f3->route('GET|POST /', function() {

    $GLOBALS['controller']->home();

});


//Personal Information route
$f3->route('GET|POST /PersonalInformation', function(){

    $GLOBALS['controller']->personalInformation();

});


//Profile route
$f3->route('GET|POST /Profile', function(){

    $GLOBALS['controller']->profile();

});

//Interests route
$f3->route('GET|POST /Interests', function(){

    $GLOBALS['controller']->interests();

});


//Profile Summary route
$f3->route('GET|POST /ProfileSummary', function(){

    $GLOBALS['controller']->profileSummary();

});


//Run fat free
$f3->run();