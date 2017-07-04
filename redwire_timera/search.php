<?php

/* Template Name: Search Tpl */

get_header(); ?>

 <div class="main-content">
        
        <div>
        
        <section class="content search-results-page">
            <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <?php if ( have_posts() ) : ?>
                    <ul>
            <?php while ( have_posts() ) : the_post(); ?>
                        
                        <li>
                            <h2><?php the_title(); ?></h2>
                             <?php the_excerpt(); ?>
                           
                                  <a href="<?php the_permalink(); ?>">Read more</a>
                      
                        </li>
            
                        <?php endwhile; ?>
                        </ul>
            	<?php else : ?>
            
            <strong>Nothing Found</strong>
             <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
             <?php get_search_form(); ?>
            
            <?php endif; ?>
            
        </section>
             </div>
        <hr/>
            
           
    </div>




<?php get_footer(); ?>


