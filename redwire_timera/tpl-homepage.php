<?php

/* Template Name: Homepage Tpl */


get_header();

?>

     <ul id="home-slider" class="bxslider">


         <?php if( have_rows('slider') ):
                $counter = 0;
                while ( have_rows('slider') ) : the_row();
          ?>

            <li id="slide-<?php echo $counter; ?>" class="slide" >
                <div>
                    <?php echo the_sub_field('content');?>

                    <?php
                     $logos = get_sub_field('images');
                    if ($logos) {?>
                        <div class="content-image">
                            <?php
                            foreach($logos as $key => $logo)
                            {
                                $active = '';
                                if($key == 0 )
                                {
                                    $active = 'content-image--active';
                                }
                                echo '<img src="' .$logo['image']['sizes']['large']. '" alt="' .$logo['image']['title']. '" class="'. $active .'"/>';
                            }
                            ?>
                        </div>
                    <?php }?>

                </div>
                <a class="link-page" href="<?php echo the_sub_field('link'); ?>">READ MORE <span class="icon-arrow-right"></span></a>

            </li>


        <?php $counter ++; endwhile; endif; ?>



      </ul>

    <div class="main-content">

        <nav id="sliderNav">
            <h1 class="nocontent">Browse Slides</h1>
              <ul class="sliderPager">

                  <?php $s=0;
                if( have_rows('slider') ):  while ( have_rows('slider') ) : the_row(); ?>

                      <li>
                      <a data-slide-index="<?php echo $s; ?>" href=""><span></span></a>
                       </li>


                <?php $s++; endwhile; endif; ?>

             </ul>
            <span class="prevSlide icon-arrow-left"></span>
             <span class="nextSlide icon-arrow-right"></span>
        </nav>

           <section class="latest-blog">
                <span class="prevPostSlide icon-arrow-left"></span>
               <span class="nextPostSlide icon-arrow-right"></span>
                <h1 class="nocontent">Latest News</h1>
               <div>
                  <?php
            $args = array('post_type' => 'post','posts_per_page' => 6 );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) : $the_query->the_post();

                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id,'large');  ?>

                <article class="post" onclick="location.href='<?php the_permalink(); ?>'">
                    <figure style="background-image: url(<?php echo $image_url[0]; ?>);"></figure>
                    <span class="image"> <?php the_post_thumbnail('full'); ?> </span>
                    <h1><?php the_title(); ?>   <span class="view icon-arrow-right"></span></h1>
                    <?php echo '<p>' . substr($post->post_excerpt, 0, 160) . '</p>' ;?>


                </article> <?php
            endwhile;

            wp_reset_query();?>
            </div>
            </section>
           <section class="intro">
            <?php the_content(); ?>
          </section>


        <hr/>
    </div>


<?php get_footer(); ?>
