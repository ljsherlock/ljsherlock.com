<?php

function video_shortcode($atts = [], $content = null, $tag = '')
{
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $o = Timber::compile('_molecules/interface/video--btn.twig', array('source' => $atts['src'] ));
    return $o;
}
