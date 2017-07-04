<?php

namespace Redwire;

class App
{
    public static function setup()
    {
        Ajax::setup();

        WPSearch::setup();

        FPS_user_taxonomies::setup();
    }
}
