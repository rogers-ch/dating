<?php


/**
 * Class PremiumMember
 * Stores information associated with a premium member.
 *
 * @author      Corey Rogers <crogers25@mail.greenriver.edu>
 * @version     1.0 (submitted 06/03/2020)
 */
class PremiumMember extends Member
{

    //Declare instance variables
    private $_inDoorInterests;
    private $_outDoorInterests;


    /**
     * PremiumMember constructor.
     * @param $fname
     * @param $lname
     * @param $age
     * @param $gender
     * @param $phone
     */
    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        //call the constructor from the parent class and pass the parameters
        parent::__construct($fname, $lname, $age, $gender, $phone);

        $this->setInDoorInterests(NULL);
        $this->setOutDoorInterests(NULL);

    }

    /**
     * Get the InDoor Interests for the Member
     * @return Object   an Array of indoor interests
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * Set the InDoor Interests for the Member
     * @param Object    $inDoorInterests an Array of indoor interests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * Get the OutDoor Interests for the Member
     * @return Object   An Array of outdoor interests
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * Set the OutDoor Interests for the Member
     * @param Object    $outDoorInterests an Array of outdoor interests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }



}

