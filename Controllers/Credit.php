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

        $defaultCredit = 3;

        $credits = $this->getList();

        require(APPPATH . 'Views/credits.php');
    }

    // Retrieves a Dataset of CreditModel objects that can be used for populating the view.
    private function getList()
    {
        $sortBy = 'cost';
        $sortDir = 'ASC';
        $page = 1;
        $itemsPerPage = 5;

        $startRow = ($page - 1) * $itemsPerPage;
        $maxRows = $itemsPerPage;

        $dataSet = \JCC\Models\ModelFactory::make('DataSet');
        $dataSet->get('Credit', $sortBy, $sortDir, $startRow, $maxRows);
        return $dataSet->data;
    }
}