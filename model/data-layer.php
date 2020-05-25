<?php

/*
 * Created by:                Corey Rogers
 * Date submitted (v1.0):     05/13/2020
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

    /* getOutdoor()
     * Returns an array of outdoor activities options.
     * @return array
     */
    function getOutdoor()
    {
        return array(
            'hiking',
            'biking',
            'swimming',
            'collecting',
            'walking',
            'climbing',
        );
    }

    /* getIndoor()
     * Returns an array of indoor activities options.
     * @return array
     */
    function getIndoor()
    {
        return array(
            'tv',
            'movies',
            'cooking',
            'board games',
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
        'Male',
        'Female',
        'Non-binary'
    );
}

/* getSeeking()
 * Returns an array of possible gender types to seek.
 * @return array
 */
function getSeeking()
{
    return array(
        'Male',
        'Female',
        'Either',
        'Non-binary',
        'All types'
    );
}