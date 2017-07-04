<?php

function button_shortcode($atts = [], $content = null, $tag = '')
{
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    $c['mustard'] = (_MUSTARD == 'true') ? true : '';

    $c['anchor_text'] = $atts['title'];
    $c['anchor_link'] = $atts['href'];

    $context = $c;

    $o = Timber::compile('project_fps/_atoms/interface/btn--primary.twig', $context);

   // return output
   return $o;
}
