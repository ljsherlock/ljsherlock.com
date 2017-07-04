<?php 

/* Template Name: Credentials Tpl */


get_header(); 
while ( have_posts() ) : the_post(); 

?>


    
    <div class="main-content page">
        <div>
        <nav id="left-col">
            <h1 class="nocontent">Secondary Navigation</h1>
             <?php
                if($post->post_parent) {
                    $children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0');
                } else {
                    $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
                }
               
                if ($children) { ?>
              <ul>
               <?php $parent_title = get_the_title($post->post_parent);?>
              <li class="parent"><a href="<?php echo get_permalink($post->post_parent) ?>"><?php echo $parent_title; ?> overview</a></li>
                <?php echo $children; ?>
              </ul>
              <?php } ?>
            
        </nav>
        <section class="content">
              <?php get_sidebar('links'); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        
            
          
         
            
      
            
				<div class="table-case all-cases">
                        
                   <div class="heading"> 
                         <span class="empty">   </span>
                         <span>Gas &amp; LNG</span>
                         <span> Power</span>
                    </div>
                    <div>
                          <h3>Valuation, Investment &amp; Contracting </h3>
                        
                        <?php $firsts = get_field('first', 5295);
	 
	       					if( $firsts ): ?>
                        
                         <h4>Gas &amp; LNG</h4>
                          
                          <ul>
                             
                            
                             <?php foreach( $firsts as $first):
                        $ID = get_post( $first ) -> ID;
				    	$title = get_post( $first )->post_title;
                        $term_list = wp_get_object_terms( $ID,  'area' );   
                        foreach( $term_list as $term ) {
                            $termSlug =  $term->slug;
                        }
                              
 
                        $custom_fields = get_post_custom($ID);

                        $types = $custom_fields['type'];
                         foreach ( $types as $key => $value ) {
                            $type = $value;
                        } 
                       
                        
                        if ($type == 'Gas&LNG') : ?>
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="/consulting-services/<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
                          <?php  endif; endforeach; ?>
                            </ul>
                        
                         <h4>Power</h4>

                         <ul>
                                     
                             <?php foreach( $firsts as $first):
                        $ID = get_post( $first ) -> ID;
				    	$title = get_post( $first )->post_title;
                        $term_list = wp_get_object_terms( $ID,  'area' );   
                        foreach( $term_list as $term ) {
                            $termSlug =  $term->slug;
                        }
                              
 
                        $custom_fields = get_post_custom($ID);

                        $types = $custom_fields['type'];
                         foreach ( $types as $key => $value ) {
                            $type = $value;
                        } 
                       
                        
                        if ($type == 'Power') : ?>
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="/consulting-services/<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
                          <?php  endif; endforeach; ?>
                          </ul>
                        
                             <?php endif; ?>

                        
                    </div>
                    
                    <div>
                          <h3>Value Monetisation &amp; Risk Management</h3>
                        
                            <?php $seconds = get_field('second', 5295);
	 
	       					if( $seconds ): ?>
                        
                         <h4>Gas &amp; LNG</h4>
                          
                          <ul>
                            
                             <?php foreach( $seconds as $second):
                        $ID = get_post( $second ) -> ID;
				    	$title = get_post( $second )->post_title;
                        $term_list = wp_get_object_terms( $ID,  'area' );   
                        foreach( $term_list as $term ) {
                            $termSlug =  $term->slug;
                        }
                              
 
                        $custom_fields = get_post_custom($ID);

                        $types = $custom_fields['type'];
                         foreach ( $types as $key => $value ) {
                            $type = $value;
                        } 
                       
                        
                        if ($type == 'Gas&LNG') : ?>
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="/consulting-services/<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
                          <?php  endif; endforeach; ?>
                            </ul>
                   
                             <h4>Power</h4>
                         <ul>
                                     
                             <?php foreach( $seconds as $second):
                        $ID = get_post( $second ) -> ID;
				    	$title = get_post( $second )->post_title;
                        $term_list = wp_get_object_terms( $ID,  'area' );   
                        foreach( $term_list as $term ) {
                            $termSlug =  $term->slug;
                        }
                              
 
                        $custom_fields = get_post_custom($ID);

                        $types = $custom_fields['type'];
                         foreach ( $types as $key => $value ) {
                            $type = $value;
                        } 
                       
                        
                        if ($type == 'Power') : ?>
                             
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="/consulting-services/<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
                          <?php  endif; endforeach; ?>
                          </ul>
                        
                             <?php endif; ?>
                        
                    </div>
                        
		       </div>
            
            <p></p>
           
           <p> Please <a title="Contact Us" href="/contact-us/">contact us</a> if you have any questions and we would be happy to provide further details subject to client confidentiality constraints.

</p>
            
        </section>
        
      
        </div>
        <hr/>
    </div>

  <?php
    endwhile; 
    wp_reset_query(); 
    ?>
 
<?php get_footer(); ?>



