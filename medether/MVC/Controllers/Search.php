<?php

namespace MVC\Controllers;

class Search extends Page
{
    public $modelName = "Search";
    public $template = "search";

    public $request = '';

    public function __construct()
    {
        parent::__construct();

        if( $_GET )
        {
            $this->model->add('term', $_GET['term']);
        }
    }
}
