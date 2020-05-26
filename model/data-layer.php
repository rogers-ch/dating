<?php

/*
 * Created by:                Corey Rogers
 * Date submitted (v2.0):     05/26/2020
 * Assignment:                Dating Assignment - Part 2 - Routing
 * File Description:          This file contains a function that returns an array with names for
 *                             all 50 states and D.C. in all caps.
 *
 */

    /* getStates()
     * Returns an array of capitalized names for all 50 states and D.C.
     * @return array
     */
    function getStates()
    {
        return array("ALABAMA",
                    "ALASKA",
                    "ARIZONA",
                    "ARKANSAS",
                    "CALIFORNIA",
                    "COLORADO",
                    "CONNECTICUT",
                    "DELAWARE",
                    "DISTRICT OF COLUMBIA",
                    "FLORIDA",
                    "GEORGIA",
                    "HAWAII",
                    "IDAHO",
                    "ILLINOIS",
                    "INDIANA",
                    "IOWA",
                    "KANSAS",
                    "KENTUCKY",
                    "LOUISIANA",
                    "MAINE",
                    "MARYLAND",
                    "MASSACHUSETTS",
                    "MICHIGAN",
                    "MINNESOTA",
                    "MISSISSIPPI",
                    "MISSOURI",
                    "MONTANA",
                    "NEBRASKA",
                    "NEVADA",
                    "NEW HAMPSHIRE",
                    "NEW JERSEY",
                    "NEW MEXICO",
                    "NEW YORK",
                    "NORTH CAROLINA",
                    "NORTH DAKOTA",
                    "OHIO",
                    "OKLAHOMA",
                    "OREGON",
                    "PENNSYLVANIA",
                    "RHODE ISLAND",
                    "SOUTH CAROLINA",
                    "SOUTH DAKOTA",
                    "TENNESSEE",
                    "TEXAS",
                    "UTAH",
                    "VERMONT",
                    "VIRGINIA",
                    "WASHINGTON",
                    "WEST VIRGINIA",
                    "WISCONSIN",
                    "WYOMING"
        );
    }

    /* getOutdoor1()
     * Returns an array of four outdoor activities options.
     * @return array
     */
    function getOutdoor1()
    {
        return array(
            'hiking',
            'biking',
            'swimming',
            'collecting'
        );
    }

    /* getOutdoor2()
     * Returns an array of two additional outdoor activities options.
     * @return array
     */
    function getOutdoor2()
    {
        return array(
            'walking',
            'climbing'
        );
    }

    /* getIndoor1()
     * Returns an array of four indoor activities options.
     * @return array
     */
    function getIndoor1()
    {
        return array(
            'tv',
            'movies',
            'cooking',
            'board games'
        );
    }

    /* getIndoor2()
     * Returns an array of four additional indoor activities options.
     * @return array
     */
    function getIndoor2()
    {
        return array(
            'puzzles',
            'reading',
            'playing cards',
            'video games'
        );
    }

/* getGender()
 * Returns an array of gender options for an applicant.
 * @return array
 */
function getGender()
{
    return array(
        'male',
        'female',
        'non-binary'
    );
}

/* getSeeking()
 * Returns an array of possible gender types to seek.
 * @return array
 */
function getSeeking()
{
    return array(
        'male',
        'female',
        'either',
        'non-binary',
        'all types'
    );
}