<?php 

/* Template Name: Insights Child Tpl */


get_header(); 
while ( have_posts() ) : the_post(); 

?>


    
    <div class="main-content page three-cols">
        <div>
      <nav id="left-col">
            <h1 class="nocontent">Secondary Navigation</h1>
           
             <?php

                $parent = get_post($post->post_parent);

                if ($parent->post_parent) {
                    
                     $children = wp_list_pages("title_li=&child_of=".$parent->post_parent."&depth=0&echo=0");
                }
    
                 else {
                    $children = wp_list_pages('title_li=&depth=0&child_of='.$post->ID.'&echo=0');
                }
               
                if ($children) { ?>
              <ul>
               <?php $parent_title = get_the_title($parent->post_parent);?>
              <li class="parent <?php if($post->post_parent > 0 ) : ?> <?php else : ?>active <?php endif; ?>"><a href="<?php echo get_permalink($parent->post_parent) ?>"><?php echo $parent_title; ?> overview</a></li>
                <?php echo $children; ?>
                  
                   <?php  if (is_page(5379) || $post->post_parent == '5379' ||  $post->post_parent == '5383') { ?>
                 <li class="page_item"><a href="/our-insights/#latest-insight">LATEST INSIGHTS</a></li>
                <?php } ?>
                  
               
                  <?php dynamic_sidebar( 'Insights' ); ?>
              </ul>
              <?php } ?>
               

        </nav>
            
            
        <section class="content">
            <?php get_sidebar('links'); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
            
               <?php if(is_page(5395)): ?>
            <div class="foll">
              <?php dynamic_sidebar( 'Blog sidebar' ); ?>
                </div>
             <?php endif; ?>
        
           
         
            
        </section>
            
        <aside>
   <h2> <?php if( get_field('about_title', 5383) ): ?><?php the_field('about_title', 5383);?> <?php endif; ?></h2>
            <div>  <?php if( get_field('about_the_blog', 5383) ): ?><?php the_field('about_the_blog', 5383);?> <?php endif; ?></div>
          
         
         
                <?php if( get_field('our_clients', 5383) ): ?>
                <h2>Our Clients include:</h2>
                <img style="cursor:pointer;" onclick="location.href='/about-us/our-clients/'" src="<?php the_field('our_clients', 5383);?> " />
                <?php endif; ?>
            
             <?php if(!is_page(5395)): ?>
              <?php dynamic_sidebar( 'Blog sidebar' ); ?>
             <?php endif; ?>
        </aside>
        
      
        </div>
        <hr/>
    </div>

  <?php
    endwhile; 
    wp_reset_query(); 
    ?>
 
<?php get_footer(); ?>



