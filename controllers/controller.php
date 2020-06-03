<?php

/**
 * Class Controller
 *
 * @author Corey Rogers <crogers25@mail.greenriver.edu>
 * @version 1.0 (submitted 06/03/2020)
 */
class Controller
{
    private $_f3;
    private $_validator;

    /**
     * Controller constructor.
     * @param $f3
     * @param $validator
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    /**
     * Display the default route
     */
    public function home()
    {
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
            $this->_f3->reroute('personalInformation');

        }

        $view = new Template();
        echo $view->render('views/home.html');

    }


    /**
     * Display the PersonalInformation route
     */
    public function personalInformation()
    {
        //echo '<h1>Hello out there</h1>';

        //add gender array to hive
        $this->_f3->set('gender', getGender());

        //If the form has been submitted
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            //var_dump($_POST);

            //validate data

            //validate first name
            if (!$this->_validator->validName($_POST['firstName'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set("errors['firstName']", "First name is required and can only contain letters.");

            }

            //validate last name
            if (!$this->_validator->validName($_POST['lastName'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set("errors['lastName']", "Last name is required and can only contain letters.");

            }

            //validate age
            if (!$this->_validator->validAge($_POST['age'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set("errors['age']", "Age is required and must be a number from 18 to 118.");

            }

            //validate phone
            if (!$this->_validator->validPhone($_POST['phone'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set("errors['phone']", "Phone number is required and must include ten digits (area code required).");

            }

            //validate gender
            if (!empty($_POST['gender'])) {     //gender is optional - only validate if a box is checked

                if (!$this->_validator->validGender($_POST['gender'])) {

                    //Set an error variable in the F3 hive
                    $this->_f3->set("errors['gender']", "Invalid gender selected.");

                }
            }


            //data is valid - create a Member or PremiumMember object to store the data and display the next form
            if(empty($this->_f3->get('errors'))) {

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
                $this->_f3->reroute('profile');

            }

        }

        //add previous submissions to the hive for sticky form
        $this->_f3->set('firstGiven', $_POST['firstName']);
        $this->_f3->set('lastGiven', $_POST['lastName']);
        $this->_f3->set('ageGiven', $_POST['age']);
        $this->_f3->set('genderGiven', $_POST['gender']);
        $this->_f3->set('phoneGiven', $_POST['phone']);
        $this->_f3->set('premiumGiven', $_POST['premium']);


        $view = new Template();
        echo $view->render("views/personal_info.html");

    }


    /**
     * Display the Profile route
     */
    public function profile()
    {
        //echo '<h1>Hello out there</h1>';

        //add states array to hive
        $this->_f3->set('states', getStates());

        //add seeking array to hive
        $this->_f3->set('seeking', getSeeking());

        //If the form has been submitted
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            //var_dump($_POST);

            //validate data

            //validate email
            if (!$this->_validator->validEmail($_POST['email'])) {

                //Set an error variable in the F3 hive
                $this->_f3->set("errors['email']", "A valid email address is required.");

            }

            //validate state
            if (!empty($_POST['state'])) {     //state is optional - only validate if a box is checked

                if (!$this->_validator->validState($_POST['state'])) {

                    //Set an error variable in the F3 hive
                    $this->_f3->set("errors['state']", "Invalid selection for 'state'.");

                }
            }

            //validate seeking
            if (!empty($_POST['seeking'])) {     //seeking is optional - only validate if a box is checked

                if (!$this->_validator->validSeeking($_POST['seeking'])) {

                    //Set an error variable in the F3 hive
                    $this->_f3->set("errors['seeking']", "Invalid selection for 'seeking'.");

                }
            }

            //data is valid
            if(empty($this->_f3->get('errors'))) {

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
                    $this->_f3->reroute('interests');

                } else {

                    //Redirect to summary page
                    $this->_f3->reroute('profileSummary');
                }


            }

        }


        //add previous submissions to the hive for sticky form
        $this->_f3->set('emailGiven', $_POST['email']);
        $this->_f3->set('stateGiven', $_POST['state']);
        $this->_f3->set('seekingGiven', $_POST['seeking']);
        $this->_f3->set('bioGiven', $_POST['bio']);


        $view = new Template();
        echo $view->render("views/profile.html");

    }


    /**
     * Display the Interests route
     */
    public function interests()
    {
        //echo '<h1>Hello out there</h1>';

        //add interests arrays to hive
        $this->_f3->set('indoor1', getIndoor1());
        $this->_f3->set('indoor2', getIndoor2());
        $this->_f3->set('outdoor1', getOutdoor1());
        $this->_f3->set('outdoor2', getOutdoor2());


        //If the form has been submitted
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            //var_dump($_POST);

            //validate data

            //validate indoor
            if (!empty($_POST['indoor'])) {     //indoor is optional - only validate if a box is checked

                if (!$this->_validator->validIndoor($_POST['indoor'])) {

                    //Set an error variable in the F3 hive
                    $this->_f3->set("errors['indoor']", "Invalid selection for 'In-door Interests'.");

                }
            }

            //validate outdoor
            if (!empty($_POST['outdoor'])) {     //outdoor is optional - only validate if a box is checked

                if (!$this->_validator->validOutdoor($_POST['outdoor'])) {

                    //Set an error variable in the F3 hive
                    $this->_f3->set("errors['outdoor']", "Invalid selection for 'Out-door Interests'.");

                }
            }

            //data is valid
            if(empty($this->_f3->get('errors'))) {

                //store data in session variables
                $_SESSION['member']->setInDoorInterests($_POST['indoor']);
                $_SESSION['member']->setOutDoorInterests($_POST['outdoor']);

                //var_dump($_SESSION);

                //Redirect to summary page
                $this->_f3->reroute('profileSummary');

            }

        }


        //add previous submissions to the hive for sticky form
        $this->_f3->set('indoorGiven', $_POST['indoor']);
        $this->_f3->set('outdoorGiven', $_POST['outdoor']);


        $view = new Template();
        echo $view->render("views/interests.html");
    }


    /**
     * Display the ProfileSummary route
     */
    public function profileSummary()
    {
        //echo '<h1>Hello out there</h1>';

        $view = new Template();
        echo $view->render("views/profile_summary.html");

        session_destroy();

    }

}