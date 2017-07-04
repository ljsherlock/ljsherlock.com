<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); 


?>


    
    <div class="main-content page three-cols">
        <div>
      <nav id="left-col">
            <h1 class="nocontent">Secondary Navigation</h1>
           
             <?php

               
                    
             $children = wp_list_pages("title_li=&child_of=5379&depth=0&echo=0");
             
               ?>
              
              <ul>
                  <li><a href="/our-insights/">OUR INSIGHT OVERVIEW</a></li>
                  <?php echo $children; ?>
                  <?php dynamic_sidebar( 'Insights' ); ?>
              </ul>
            
               

        </nav>
            
            
        <section class="content">
         
               <h1 ><?php single_cat_title(); ?></h1>
            
               <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();
                 $image_id = get_post_thumbnail_id();
                 $image_url = wp_get_attachment_image_src($image_id,'large');

                     $content = get_the_content();
                $content = strip_tags($content);
            ?>
            
                 <article class="post blog-post" onclick="location.href='<?php the_permalink(); ?>'">
                       
                           <span><figure style="background-image: url(<?php echo $image_url[0]; ?>);"> </figure></span>
                           <div>
                               <h1 class="article-head"><?php the_title(); ?> <small class="date">| <?php the_date('d M, Y'); ?></small></h1>
                               <div><p><?php  echo substr($content, 0, 150); ?> ... <span class="icon-arrow-right view"></span></p> </div>
                            </div>
                          
                      
                </article>

                <?php endwhile;  endif; ?>

          <nav id="browse-posts">
                <h1 class="nocontent">Browse Articles</h1>
          
                    <span class="nav-previous"><?php previous_posts_link( '&larr; Newer articles ' ); ?></span>
                    <span class="nav-next"><?php next_posts_link( 'Older articles &rarr;', $the_query->max_num_pages ); ?></span>
            
          </nav>
          
           

        </section>
            
        <aside>
            <?php if( get_field('about_the_blog', 5383) ): ?>
            <h2>About us</h2>
            <div><p>  <?php the_field('about_the_blog', 5383);?></p></div>
          
            <?php endif; ?>
         
                <?php if( get_field('our_clients', 5383) ): ?>
                <h2>Our Clients include:</h2>
                <img style="cursor:pointer;" onclick="location.href='/about-us/our-clients/'" src="<?php the_field('our_clients', 5383);?> " />
                <?php endif; ?>
            
           
              <?php dynamic_sidebar( 'Blog sidebar' ); ?>
        </aside>
        
      
        </div>
        <hr/>
    </div>




<?php get_footer(); ?>
