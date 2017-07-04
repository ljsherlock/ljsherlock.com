<?php

$c = Timber::get_context();

$c['success'] = false;

if(isset($_POST['contact_submit']))
{
    $valid = new ValidFluent($_POST);

    $valid->name('contact_name')->required('Provide your name')->alfa()->minSize(4);
    $valid->name('contact_email')->required('Provide an Email Address')->email();
    $valid->name('contact_subject')->required()->alfa()->minSize(5);
    $valid->name('contact_message')->required()->minSize(35);

    if(!$valid->isGroupValid())
        $c['valid'] = $valid;

    if($valid->isGroupValid())
    {
        $message = "<h2>Name:</h2> <p>" . $valid->getValue('contact_name') . '</p>';
        $message .= "<h2>Email:</h2> <p>" . $valid->getValue('contact_email') . '</p>';
        $message .= "<h2>Message:</h2> <p>" . nl2br($valid->getValue('contact_message')) . '</p><br/><br/>';

        $headers = array('Content-Type: text/html; charset=UTF-8','From: '. $valid->getValue('contact_name') .' (via Federal Piling Specialists) <fps@fps.org.uk');

        wp_mail( 'lewis@redwiredesign.com', $valid->getValue('contact_subject'), $message, $headers);

        $c['success'] = true;
    }
}

$post = new TimberPost();

$c['post'] = $post;

Timber::render( array('project_fps/_pages/page-contact-us.twig'), $c );
