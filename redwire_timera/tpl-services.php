<?php 

/* Template Name: Services Tpl */


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
              <li class="parent <?php if($post->post_parent > 0 ) : ?> <?php else : ?>active <?php endif; ?>"><a href="<?php echo get_permalink($post->post_parent) ?>"><?php echo $parent_title; ?> overview</a></li>
                <?php echo $children; ?>
              </ul>
              <?php } ?>
            
        </nav>
        <section class="content">
               <?php get_sidebar('links'); ?>
            <h1>Consulting services</h1>
            <?php the_content(); ?>
            
            <h2>What we do</h2>
            
              <ul class="list">

                  <?php $s=0;
                if( have_rows('services') ):  while ( have_rows('services') ) : the_row(); ?>
                    
                      <li onclick="location.href='<?php echo the_sub_field('pageLink'); ?>'">
                          <h3><?php echo the_sub_field('what'); ?><span class="view icon-arrow-right"></span></h3>
                          <p><?php echo the_sub_field('description'); ?></p>
                       </li>
                <?php $s++; endwhile; endif; ?>
                  
             </ul>
            
             <h2>Credentials matrix</h2>
            <p>Follow the links to gain	a practical	understanding of what we do	via	client case	studies:</p>
            
      
            
		<div class="table-case all-cases">
                        
                   <div class="heading"> 
                         <span class="empty">   </span>
                         <span>Gas &amp; LNG</span>
                         <span> Power</span>
                    </div>
                    <div>
                          <h3>Valuation, Investment &amp; Contracting </h3>
                        
                        <?php $firsts = get_field('first');
	 
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
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
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
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
                          <?php  endif; endforeach; ?>
                          </ul>
                        
                             <?php endif; ?>

                        
                    </div>
                    
                    <div>
                          <h3>Value Monetisation &amp; Risk Management</h3>
                        
                            <?php $seconds = get_field('second');
	 
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
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
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
                              
                              
                            <li class="<?php echo $type; ?>" ><a href="<?php echo $termSlug;?>/#<?php echo $ID ?>"><?php echo $title; ?></a></li>
                            
                          <?php  endif; endforeach; ?>
                          </ul>
                        
                             <?php endif; ?>
                        
                    </div>
                        
		       </div>
        </section>
        
      
        </div>
        <hr/>
    </div>

  <?php
    endwhile; 
    wp_reset_query(); 
    ?>
 
<?php get_footer(); ?>



