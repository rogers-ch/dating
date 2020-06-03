<?php


/**
 * Class Member
 * Stores information associated with a member.
 *
 * @author      Corey Rogers <crogers25@mail.greenriver.edu>
 * @version     1.0 (submitted 06/03/2020)
 *
 */
class Member
{

    //Declare instance variables
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;


    /**
     * Member constructor.
     * @param $fname
     * @param $lname
     * @param $age
     * @param $gender
     * @param $phone
     */
    public function __construct($fname, $lname, $age, $gender, $phone)
    {

        $this->setFname($fname);
        $this->setlname($lname);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setPhone($phone);
        $this->setEmail("");
        $this->setState("");
        $this->setSeeking("");
        $this->setBio("");

    }

    /**
     * Get the Member's first name
     * @return String
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Set the Member's first name
     * @param String $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Get the Member's last name
     * @return String
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Set the Member's last name
     * @param String $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Get the Member's age
     * @return int
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Set the Member's age
     * @param int $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Get the Member's gender
     * @return String
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Set the Member's gender
     * @param String $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * Get the Member's phone number
     * @return String
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Set the Member's phone number
     * @param String $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Get the Member's email address
     * @return String
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set the Member's email address
     * @param String $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Get the Member's state
     * @return String
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Set the Member's state
     * @param String $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Get the Member's seeking selection
     * @return String
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Set the Member's seeking selection
     * @param String $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * Get the Member's bio
     * @return String
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Set the Member's bio
     * @param String $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }



}

