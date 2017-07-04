<?php

namespace Redwire;

class RW_Posts
{

    public static function setup()
    {
        content_block::setup();

        news::setup();
        press_release::setup();
        post::setup();

        thoughts::setup();

        members::setup();
        fps_officer::setup();

        documents::setup();

        events::setup();
    }
}
