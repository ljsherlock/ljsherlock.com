<?php

namespace MVC\Controllers;

abstract class Base
{
    /**
    * Controller args
    * @var object
    */
    protected $args = array();

    /**
    * Element attributes
    * @var object
    */
    protected $attrs = array();

    /**
    * Timber worker
    * @var \wptwig\Workers\Twig
    */
    protected $timber = null;

    /**
    * Model object
    * @var object
    */
    protected $model = null;

    /**
    * Name of model to be used in Controller;
    * to be set in classes that extend from Base
    * @var string
    */
    public $modelName = '';

    /**
    * Location of template; to be set in classes
    * that extend from Base
    * @var string
    */
    public $template = '';

    /**
    * Setup model and timber/twig
    * @param object args Controller arguments.
    * @return null
    */
    public function __construct($args = array())
    {
        $this->template = ( isset( $args['template'] ) ) ? $args['template'] : $this->template;

        // initialize the Timber Worker & Pass base template locations
        $this->timber = new \MVC\Workers\Timber( array(
            dirname(__DIR__) . "/Views",
            dirname(__DIR__) . "/Views/_components",
            dirname(__DIR__) . "/Views/_app",
            dirname(__DIR__) . "/Views/_macros",
        ));

        // Create the dynamic model name
        $modelName = "\\MVC\\Models\\{$this->modelName}";

        // Initialize Model
        $this->model = new $modelName( $args );

        // Add the timber object to Model
        $this->model->timber = $this->timber;

        // Add core context data.
        $this->timber->addContext(
            array(
                'ajax' => false,
                'year' => date('Y'),
                'device' => \Utils\Utils::isDevice(),
                'mustard' => (_MUSTARD != null && _MUSTARD == 'true') ? true : '',
            )
        );
    }

    /**
    * Gather model data and render twig template
    * @return null
    */
    public function show()
    {
        // get data
        $data = $this->model->get();

        // render data
        $this->timber->render($this->template, $data);
    }

}
