<?php

namespace Redwire;

class Calendar
{
    public static function setup()
    {

    }

    public static function create_calendar($m, $y)
    {
        /*------------------------*\
        *   Set dates to be used by
        *   calendar and query_posts
        \*------------------------*/

        // Now or URL Query date
        if(isset($m, $y)) {
            $date = '01-'.$m.'-'.$y;
            $month_start = date($y.'-'.$m.'-01 00:00:00');
            $month_end = date($y.'-'.$m.'-t 12:59:59');
        } else {
            $date = 'now';
            $month_start = date('Y-m-01 00:00:00',strtotime('this month'));
            $month_end = date('Y-m-t 12:59:59',strtotime('this month'));
        }

        $next_month = new \DateTime($date);
        $prev_month = new \DateTime($date);
        $next_month = $next_month->add( new \DateInterval('P1M') );
        $prev_month = $prev_month->sub( new \DateInterval('P1M') );
        $c['next_month'] = $next_month->format('m/Y');
        $c['prev_month'] = $prev_month->format('m/Y');

        if (!is_user_logged_in())
        {
            $terms = array('fps-meeting', 'industry-event');
        } else {
            $terms = array('fps-meeting', 'industry-event', 'course-intake-deadline');
        }

        /*------------------------*\
        *   Get posts by acf date
        \*------------------------*/
        $args = array(
            'post_type' => 'event',
            "orderby"   => "date",
            "order"     => "DSC",
            'meta_query' => array(
        		array(
        	        'key'			=> 'start_date',
        	        'compare'		=> 'BETWEEN',
        	        'value'			=> array( $month_start, $month_end ),
        	        'type'			=> 'DATETIME'
        	    )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' =>  'event-type',
                    'field' => 'slug',
                    'terms'    => $terms,
                ),
            ),
        );
        $posts = \Timber::get_posts($args);
        $c['posts'] = $posts;


        $post_group_terms = [];

        foreach ($posts as $key => $post) {
            $terms = wp_get_post_terms($post->ID, 'event-type');
            foreach($terms as $key => $term){
                if (!in_array($term, $post_group_terms)) {
                    $post_group_terms[] = $term;
                }
            }
        }

        if(empty($post_group_terms)) {
            $post_group_terms = get_terms('event-type');
        }


        /*------------------------*\
        * Pagination
        * What about date params?
        \*------------------------*/
        query_posts($args);
        $c['pagination'] = \Timber::get_pagination();

        /*------------------------*\
        *   Create calendar
        \*------------------------*/
        // Creates a calendar, using today as a starting point.
        if(!isset($m, $y)) {
            $calendar = new \Solution10\Calendar\Calendar(new \DateTime('now'));
        } else {
            $calendar = new \Solution10\Calendar\Calendar(new \DateTime('01-'.$m.'-'.$y));
        }

        // We now need to give the calendar a "resolution". This tells the
        // Calendar whether we're showing a month view, or a Week, or maybe
        // even a whole year. Let's start with a Month:
        $calendar->setResolution( new \Solution10\Calendar\Resolution\MonthResolution(1, 1, true) );

        // That's it! Let's grab the view data and render:
        $viewData = $calendar->viewData();

        return array('calendar' => $calendar, 'viewData' => $viewData, 'posts' => $posts, 'terms' => $post_group_terms);
    }
}
