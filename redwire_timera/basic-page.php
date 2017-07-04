<?php
/*
Template Name: Basic Page
 */

get_header(); 
while ( have_posts() ) : the_post(); 

?>

   
    
    <div class="main-content">
        
        <div>
        
        <section class="content basic">
               <?php get_sidebar('links'); ?>
            <h1><?php the_title(); ?></h1>
              
               <?php if(is_page(7)): ?>
                     <div class="col">
                <?php $content = get_the_content('',FALSE,''); // arguments remove 'more' text
                echo my_multi_col_v2($content); ?>
                    </div>
            
             <?php else: ?>
                <?php the_content(); ?>
             <?php endif; ?>
             
  <?php
    endwhile; 
    wp_reset_query(); 
    ?>
 
				<?php $insights = get_field('cases');
	 
	       					if( $insights ): ?>
            
				    <ul class="table-case">
                        
                        
				    <?php foreach( $insights as $insight):
                        $ID = get_post( $insight ) -> ID;
				    	$title = get_post( $insight )->post_title;
                        $content = get_post( $insight )->post_content;
                        $custom_fields = get_post_custom($ID);
                        $my_custom_field = $custom_fields['client'];
                        foreach ( $my_custom_field as $key => $value ) {
                            $client = $value;
                        } ?>
				      
				        <li id="<?php echo $ID; ?>" class="case">
                            <div> 
                                <span>Project</span>
                                 <span>Client</span>
                                 <span> Brief overview</span>
                            </div>
                            <article>
                                 <h3><?php echo $title; ?></h3>
                                  <span> <strong>Client:</strong> <?php echo $client; ?></span>
                                   <p><?php echo $content; ?></p>
                            </article>
				          
                          
				        </li>
				    <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        
            
        
            
            
        </section>
             </div>
        <hr/>
            
           
    </div>




<?php get_footer(); ?>



