<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); while ( have_posts() ) : the_post();  ?>

    
    <div class="main-content page three-cols">
        <div>
     
            
        <section class="content">
             <?php get_sidebar('links'); ?>
          
            <h1><?php the_title(); ?></h1>
            <small class="date" style=" margin-bottom: 20px;
  display: block;"><?php the_date('d M, Y'); ?></small>
            
            
            <?php the_content(); ?>
            
             
           
             
  <?php
    endwhile; 
    wp_reset_query(); 
    ?>
 
				
                        
            
        
            
            
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




<?php get_footer(); ?>

