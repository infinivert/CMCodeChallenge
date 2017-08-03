<?php

namespace JCC\Controllers;

class Credit
{
    // Receives a request from the Route controller and shows the appropriate view.
    public function showList()
    {
        require(APPPATH . 'Views/credits.php');
    }

}