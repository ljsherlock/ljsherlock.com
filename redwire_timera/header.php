<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="alexaVerifyID" content="VTwZQRYnaK7-4xbSb_fJVMBkZ7I" />
        <meta name="google-site-verification" content="fYx-xfrmBpC5ry1P70j1wMX2OJthdVvVGrpzilOlBJY" />
        <meta name="google-site-verification" content="xNmZkaYqPfzdqXLiJL-N268kB1SPNx0jVFt8NOi6nxU" />
        <title><?php if (is_front_page()) : ?>Timera Energy
            <?php else: ?> <?php wp_title(); ?> | <?php bloginfo('name'); ?>
            <?php endif; ?>
        </title>
        <meta name="description" content="<?php bloginfo('description'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" />
        <meta name="author" content="Redwire">


        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="//fast.fonts.net/jsapi/b5988fd8-dcb2-4feb-8cc2-475e8e046360.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,400italic' rel='stylesheet' type='text/css'>

        <?php wp_head(); ?>

        <?php
        /* We add some JavaScript to pages with the comment form
         * to support sites with threaded comments (when in use).
         */
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');
        ?>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-23714916-1']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();

        </script>



    </head>

    <body <?php body_class(); ?>>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-61209388-1', 'auto');
            ga('send', 'pageview');

        </script>


        <?php if (have_rows('slider')): ?>

            <div id="bgImage">
                <div class="bxslider">

                    <?php
                    $counter = 0;
                    while (have_rows('slider')) : the_row();
                        ?>



                        <figure style="background-image: url(<?php echo the_sub_field('bg'); ?>)"> </figure>



                        <?php $counter ++;
                    endwhile; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (is_category() || is_tag() || is_single()) { ?>

            <figure id="bgImage" class="pattern" style="background-image: url(/content/uploads/2015/03/blog-pattern.jpg)"> </figure>


        <?php
        } else if (is_search()) {
            $page_id = "5295";
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'full');
            $image_URI = $image[0];
            ?>

            <figure id="bgImage" style="background-image: url(<?php echo $image[0]; ?>);"> </figure>

        <?php } else if (is_home() || is_front_page()) {
            ?>


        <?php
        } else {

            while (have_posts()) : the_post();
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id, 'large');
                ?>

                <figure id="bgImage" <?php if (is_page(5379) || 5379 == $post->post_parent || $post->ancestors && in_array('5379', $post->ancestors)): ?>class="pattern"<?php endif; ?>style="background-image: url(<?php echo $image_url[0]; ?>);"> </figure>

                <?php
            endwhile;
            wp_reset_query();
        }
        ?>



        <main>
            <header class="main">
                <div>
                    <button id="toggleMenu">

                        <span>  </span>
                        <span>  </span>
                        <span>  </span>
                    </button>
                    <h1>
                        <spa class="nocontent">Timera Energy</spa>
                        <a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/images/timera-energy-logo.png" alt="" /></a>
                    </h1>

                    <nav id="main-nav">
                        <h1 class="nocontent">Main Navigation</h1>
                        <ul>
                            <?php
                            $defaults = array(
                                'theme_location' => '',
                                'menu' => 'main-menu',
                                'container' => '',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => '',
                                'menu_id' => '',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'items_wrap' => '%3$s',
                                'depth' => 0,
                                'walker' => ''
                            );



                            wp_nav_menu($defaults);
                            ?>
                        </ul>
                        <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                            <div>
                                <input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search site" />
                                <span class="icon-search"><input type="submit" class="search-submit" value="" /></span>
                            </div>

                        </form>

                    </nav>
                </div>
            </header>
