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

//Require the validate file
require_once('model/validate.php');

//Start a session
session_start();

//Instantiate the F3 Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET|POST /', function($f3) {
    //echo '<h1>Hello world!</h1>';


    /*
    // test PremiumMember and Member classes
    echo "<pre>";
    $preMember = new PremiumMember('Sarah', 'Smith', 30, 'Female', '222-333-4444');
    echo print_r($preMember);
    $preMember->setEmail('my.email@gmail.com');
    $preMember->setState('WASHINGTON');
    $preMember->setSeeking('Male');
    $preMember->setBio('Lorem ipsum dolor sit amet, consectet...');
    $preMember->setInDoorInterests(['tv', 'cooking', 'playing cards']);
    $preMember->setOutDoorInterests(['hiking', 'swimming', 'climbing']);
    echo "<br>";
    echo print_r($preMember);
    echo "</pre>";
    */


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

    //add gender array to hive
    $f3->set('gender', getGender());

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
            $f3->set("errors['age']", "Age is required and must be a number from 18 to 118.");

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


        //data is valid - create a Member or PremiumMember object to store the data and display the next form
        if(empty($f3->get('errors'))) {

            //instantiate the appropriate class - Member or PremiumMember - based on whether or not the
            // PremiumMember checkbox was selected
            if(isset($_POST['premium'])) {
                $member = new PremiumMember($_POST['firstName'], $_POST['lastName'],
                                            $_POST['age'], $_POST['gender'], $_POST['phone']);
            } else {
                $member = new Member($_POST['firstName'], $_POST['lastName'],
                    $_POST['age'], $_POST['gender'], $_POST['phone']);
            }

            //echo "<pre>";
            //echo print_r($member);
            //echo "</pre>";

            //Store the member object in the session array
            $_SESSION['member'] = $member;

            //var_dump($_SESSION);

            //Redirect to summary page
            $f3->reroute('profile');

        }

    }

    //add previous submissions to the hive for sticky form
    $f3->set('firstGiven', $_POST['firstName']);
    $f3->set('lastGiven', $_POST['lastName']);
    $f3->set('ageGiven', $_POST['age']);
    $f3->set('genderGiven', $_POST['gender']);
    $f3->set('phoneGiven', $_POST['phone']);
    $f3->set('premiumGiven', $_POST['premium']);


    $view = new Template();
    echo $view->render("views/personal_info.html");

});


//Profile route
$f3->route('GET|POST /Profile', function($f3){
    //echo '<h1>Hello out there</h1>';

    //add states array to hive
    $f3->set('states', getStates());

    //add seeking array to hive
    $f3->set('seeking', getSeeking());

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

        //data is valid
        if(empty($f3->get('errors'))) {

            //store data in the member object in the session array
            $_SESSION['member']->setEmail($_POST['email']);
            $_SESSION['member']->setState($_POST['state']);
            $_SESSION['member']->setSeeking($_POST['seeking']);
            $_SESSION['member']->setBio($_POST['bio']);

            //var_dump($_SESSION);


            //Redirect to interests page if this is a PremiumMember, otherwise send to summary page
            if(get_class($_SESSION['member']) == 'PremiumMember') {
                //echo "premium member";

                //Redirect to interests page
                $f3->reroute('interests');

            } else {

                //Redirect to summary page
                $f3->reroute('profileSummary');
            }


        }

    }


    //add previous submissions to the hive for sticky form
    $f3->set('emailGiven', $_POST['email']);
    $f3->set('stateGiven', $_POST['state']);
    $f3->set('seekingGiven', $_POST['seeking']);
    $f3->set('bioGiven', $_POST['bio']);


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

        //validate indoor
        if (!empty($_POST['indoor'])) {     //indoor is optional - only validate if a box is checked

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

        //data is valid
        if(empty($f3->get('errors'))) {

            //store data in session variables
            $_SESSION['member']->setInDoorInterests($_POST['indoor']);
            $_SESSION['member']->setOutDoorInterests($_POST['outdoor']);

            //var_dump($_SESSION);

            //Redirect to summary page
            $f3->reroute('profileSummary');

        }

    }


    //add previous submissions to the hive for sticky form
    $f3->set('indoorGiven', $_POST['indoor']);
    $f3->set('outdoorGiven', $_POST['outdoor']);


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