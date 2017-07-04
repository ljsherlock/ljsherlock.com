<?php

/* Template Name: Insights Tpl */


get_header();
while ( have_posts() ) : the_post();

?>



    <div class="main-content page three-cols">
        <div>
        <nav id="left-col">
            <h1 class="nocontent">Secondary Navigation</h1>
             <?php
                if($post->post_parent) {

                  $children = wp_list_pages('title_li=&depth=0&child_of='.$post->post_parent.'&echo=0');

                } else {
                    $children = wp_list_pages('title_li=&depth=0&child_of='.$post->ID.'&echo=0');
                }

                if ($children) { ?>
              <ul>
                   <?php $parent_title = get_the_title($post->post_parent);?>
              <li class="parent <?php if($post->post_parent > 0 ) : ?> <?php else : ?>active <?php endif; ?>"><a href="<?php echo get_permalink($post->post_parent) ?>"><?php echo $parent_title; ?> overview</a></li>
                <?php echo $children; ?>
                   <?php  if (is_page(5379) || $post->post_parent == '5379' ||  $post->post_parent == '5383') { ?>
                 <li class="page_item"><a href="/our-insights/#latest-insight">LATEST INSIGHTS</a></li>
                <?php } ?>
               <?php dynamic_sidebar( 'Insights' ); ?>
              </ul>
              <?php } ?>

        </nav>
        <section class="content  <?php if(is_page(5383)): ?>blog-list-content<?php endif; ?>">
               <?php if(!is_page(5383)): get_sidebar('links'); endif; ?>
            <h1  <?php if(is_page(5383)): ?>class="nocontent"  <?php endif; ?>><?php the_title(); ?></h1>
            <?php the_content(); ?>

              <?php $s=0;
                if( have_rows('services') ): ?>
              <ul class="list">

                 <?php  while ( have_rows('services') ) : the_row(); ?>

                      <li onclick="location.href='<?php echo the_sub_field('pageLink'); ?>'">
                          <h3><?php echo the_sub_field('what'); ?><span class="view icon-arrow-right"></span></h3>
                          <p><?php echo the_sub_field('description'); ?></p>
                       </li>
                <?php $s++; endwhile;  ?>

             </ul>
            <?php endif; ?>

            <?php if(is_page(5383)): ?>




                <?php

               $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array('post_type' => 'post','posts_per_page' => 10, 'paged' => $paged );

                $the_query = new WP_Query( $args );

                while ( $the_query->have_posts() ) : $the_query->the_post();
                $image_id = get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id,'medium');

                 $content = get_the_content();
                $content = strip_tags($content);



                ?>

                <article class="post blog-post" onclick="location.href='<?php the_permalink(); ?>'">

                           <!-- <span>
                               <img src="<?php // echo $image_url[0]; ?>" />
                           </span> -->
                           <div>
                               <div class="head__wrap">
                                   <h1 class="article-head"><?php the_title(); ?></h1>
                                   <small class="date">| <?php the_date('d M, Y'); ?></small>
                               </div>
                               <div>
                                   <span class="image"><?php the_post_thumbnail('full'); ?></span>
                                   <p>
                                       <?php echo get_the_excerpt(); ?> <span class="icon-arrow-right view"></span>
                                   </p>
                               </div>
                           </div>
                </article>



                <?php
                endwhile;
                ?>



              <nav id="browse-posts">
                <h1 class="nocontent">Browse Articles</h1>

                    <span class="nav-previous"><?php previous_posts_link( '&larr; Newer articles ' ); ?></span>
                    <span class="nav-next"><?php next_posts_link( 'Older articles &rarr;', $the_query->max_num_pages ); ?></span>

                   <span class="blog-archive-link"><a href="/our-insights/blog/blog-archive/">BLOG ARCHIVE &rarr;</a></span>

              </nav>


            <?php wp_reset_query(); endif; ?>



        </section>

        <aside>

            <h2> <?php if( get_field('about_title', 5383) ): ?><?php the_field('about_title', 5383);?> <?php endif; ?></h2>
            <div>  <?php if( get_field('about_the_blog', 5383) ): ?><?php the_field('about_the_blog', 5383);?> <?php endif; ?></div>



                <?php if( get_field('our_clients', 5383) ): ?>
                <h2>Our Clients include:</h2>
                <img style="cursor:pointer;" onclick="location.href='/about-us/our-clients/'" src="<?php the_field('our_clients', 5383);?> " />
                <?php endif; ?>


              <?php dynamic_sidebar( 'Blog sidebar' ); ?>
        </aside>


        </div>
        <hr/>
    </div>

  <?php
    endwhile;
    wp_reset_query();
    ?>

<?php get_footer(); ?>
