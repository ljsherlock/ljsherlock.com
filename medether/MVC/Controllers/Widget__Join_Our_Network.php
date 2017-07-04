<?php

namespace MVC\Controllers;

class Widget__Join_Our_Network extends Widget
{
    public $modelName = 'Widget__Join_Our_Network';

    public function get_widget()
    {
        $this->model->get_widget();
    }

    public function get_form()
    {
        $this->model->get_form();
    }
}
