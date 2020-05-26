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

//Require the validate file
require_once('model/validate.php');

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

        //validate data

        //validate first name
        if (!validName($_POST['firstName'])) {

            //Set an error variable in the F3 hive
            $f3->set("errors['firstName']", "First name is required and can only contain letters.");

        }

        //validate last name
        if (!validName($_POST['lastName'])) {

            //Set an error variable in the F3 hive
            $f3->set("errors['lastName']", "Last name is required and can only contain letters.");

        }

        //validate age
        if (!validAge($_POST['age'])) {

            //Set an error variable in the F3 hive
            $f3->set("errors['age']", "Age is required and must be a number between 18 and 118.");

        }

        //validate phone
        if (!validPhone($_POST['phone'])) {

            //Set an error variable in the F3 hive
            $f3->set("errors['phone']", "Phone number is required and must include ten digits (area code required).");

        }

        //validate gender
        if (!empty($_POST['gender'])) {     //gender is optional - only validate if a box is checked

            if (!validGender($_POST['gender'])) {

                //Set an error variable in the F3 hive
                $f3->set("errors['gender']", "Invalid gender selected.");

            }
        }


        //data is valid - store data in session variables and display the next form
        if(empty($f3->get('errors'))) {
            //Store the data in the session array
            $_SESSION['firstName'] = $_POST['firstName'];
            $_SESSION['lastName'] = $_POST['lastName'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['phone'] = $_POST['phone'];

            //var_dump($_SESSION);

            //Redirect to summary page
            $f3->reroute('profile');

        }

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

        //validate data

        //validate email
        if (!validEmail($_POST['email'])) {

            //Set an error variable in the F3 hive
            $f3->set("errors['email']", "A valid email address is required.");

        }

        //validate state
        if (!empty($_POST['state'])) {     //state is optional - only validate if a box is checked

            if (!validState($_POST['state'])) {

                //Set an error variable in the F3 hive
                $f3->set("errors['state']", "Invalid selection for 'state'.");

            }
        }

        //validate seeking
        if (!empty($_POST['seeking'])) {     //seeking is optional - only validate if a box is checked

            if (!validSeeking($_POST['seeking'])) {

                //Set an error variable in the F3 hive
                $f3->set("errors['seeking']", "Invalid selection for 'seeking'.");

            }
        }

        //data is valid - store data in session variables and display the next form
        if(empty($f3->get('errors'))) {

            $_SESSION['email'] = $_POST['email'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['bio'] = $_POST['bio'];

            //var_dump($_SESSION);

            //Redirect to summary page
            $f3->reroute('interests');

        }

    }


    $view = new Template();
    echo $view->render("views/profile.html");

});

//Interests route
$f3->route('GET|POST /Interests', function($f3){
    //echo '<h1>Hello out there</h1>';

    //add interests arrays to hive
    $f3->set('indoor1', getIndoor1());
    $f3->set('indoor2', getIndoor2());
    $f3->set('outdoor1', getOutdoor1());
    $f3->set('outdoor2', getOutdoor2());


    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        //var_dump($_POST);

        //validate data

        //validate outdoor
        if (!empty($_POST['indoor'])) {     //outdoor is optional - only validate if a box is checked

            if (!validIndoor($_POST['indoor'])) {

                //Set an error variable in the F3 hive
                $f3->set("errors['indoor']", "Invalid selection for 'In-door Interests'.");

            }
        }

        //validate outdoor
        if (!empty($_POST['outdoor'])) {     //outdoor is optional - only validate if a box is checked

            if (!validOutdoor($_POST['outdoor'])) {

                //Set an error variable in the F3 hive
                $f3->set("errors['outdoor']", "Invalid selection for 'Out-door Interests'.");

            }
        }

        //data is valid - store data in session variables and display the summary page
        if(empty($f3->get('errors'))) {

            $_SESSION['indoor'] = $_POST['indoor'];
            $_SESSION['outdoor'] = $_POST['outdoor'];

            //var_dump($_SESSION);

            //Redirect to summary page
            $f3->reroute('profileSummary');

        }

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