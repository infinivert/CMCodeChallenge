<?php

namespace JCC\Controllers;

class Credit
{
    // Receives a request from the Route controller and shows the appropriate view.
    public function showList()
    {
        // Would normally pull this in from a database table, but hard-coding for time
        $pageTitle = 'Buy Credits ~ Creative Market';
        $pageHeading = 'Stock up on Credits';
        $pageSubHeading = 'Save money and get free bonus credits when you buy in bulk';

        require(APPPATH . 'Views/credits.php');
    }

}