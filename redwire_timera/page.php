<?php get_header();
while ( have_posts() ) : the_post();

?>



    <div class="main-content">

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
                <?php  if (is_page(5379) || $post->post_parent == '5379' ||  $post->post_parent == '5383') { ?>
                 <li class="page_item"><a href="/our-insights/#latest-insight">LATEST INSIGHTS</a></li>
                <?php } ?>

              </ul>
              <?php } ?>

        </nav>
        <section class="content">
               <?php get_sidebar('links'); ?>
              <h1>  <?php if(is_page(2)): ?>About Timera Energy <?php else: ?><?php the_title(); ?>  <?php endif; ?></h1>
            <?php the_content(); ?>

            <?php  if( have_rows('services') ): ?>
             <ul class="list">

                <?php $s=0;
                while ( have_rows('services') ) : the_row(); ?>

                      <li onclick="location.href='<?php echo the_sub_field('pageLink'); ?>'">
                          <h3><?php echo the_sub_field('what'); ?><span class="view icon-arrow-right"></span></h3>
                          <p><?php echo the_sub_field('description'); ?></p>
                       </li>
                <?php $s++; endwhile; ?>

                  </ul>

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


              <?php if( have_rows('list_pub') ): ?>

                            <ul class="publications">

                    <li class="heading">
                        <span>Date</span>
                         <span>Publication</span>
                         <span>Title</span>
                    </li>

            <?php while ( have_rows('list_pub') ) : the_row(); ?>

                    <li>
                        <span><?php the_sub_field('date');?></span>
                        <h1><?php the_sub_field('publication');?></h1>
                        <div>
                            <?php the_sub_field('title');?>
                            <?php if( get_sub_field('link') ): ?> <a target="_blank" href="<?php the_sub_field('link');?>">View Publication <span class="icon-arrow-right"></span> </a> <?php endif; ?>
                        </div>
                    </li>

                                <?php endwhile; ?>
                          </ul>
             <?php endif; ?>

            <?php if( get_field('content_latest_insight') ): ?>
            <div class="latest-insight__wrap">

                <div id="latest-insight">
                    <?php the_field('content_latest_insight');?>
                </div>

                <?php endif; ?>

                 <?php if( have_rows('pdf') ): ?>


                                    <?php $pdfs = get_field('pdf');


                                    foreach($pdfs as $index => $pdf)
                                    {
                                        if($index == 0) {
                                            ?>
                                            <ul class="publications insights-pdf insight__first">
                                                <li>
                                                    <div>
                                                        <a target="_blank" href="<?= $pdf['document'];?>"><?= $pdf['title'];?></a>
                                                    </div>
                                                    <span><img onclick="location.href='<?= $pdf['document'];?>'" src="<?= $pdf['image'];?>" /></span>
                                                </li>
                                            </ul>
                                            </div>
                                            <ul class="publications">
                                                <li class="heading">
                                                    <span>Date</span>
                                                     <span>Title</span>
                                                </li>
                                            <?php

                                        } else {
                                            ?>
                                            <li>

                                                <span>
                                                <?php if($pdf['date']) {
                                                    echo $pdf['date'];
                                                } ?>
                                                </span>
                                                <div>
                                                    <h2><strong><?= $pdf['title'];?></strong></h2>
                                                    <?php if( $pdf['document'] ): ?> <a target="_blank" href="<?= $pdf['document'];?>">View Insight <span class="icon-arrow-right"></span> </a> <?php endif; ?>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </ul>


                    </div>
                <?php endif; ?>
        </section>
             </div>
        <hr/>
    </div>




<?php get_footer(); ?>
