<?php
/*
Template Name: Contact Us
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
                <div id="map"></div>
                    <!-- Replace the value of the key parameter with your own API key. -->


                    <?php add_action( 'wp_footer' , function() {
                        ?>
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMhpBMrnA8vGvYFCe5BID6kDMVrzg_w20"></script>
                        <script type="text/javascript">

                            function initialize() {
                                var center = { lat: 51.516220, lng: -0.080955 };
                                var map_properties = {
                                    center: center,
                                    zoom: 16,
                                   //  mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    disableDefaultUI: false,
                                    zoomControl: true,
                                    scrollwheel: false,
                                    // styles: styles,
                                    disableDoubleClickZoom: true,
                                    backgroundColor: "#F7F2F9",
                                };
                                var map     = new google.maps.Map(document.getElementById( "map" ), map_properties ),
                                    marker  = new google.maps.Marker( {
                                        position: { lat: 51.516220, lng: -0.080955 },
                                        map: map,
                                        title: 'Timera Energy',
                                    }),
                                    center  = map.getCenter();

                                google.maps.event.addDomListener(window, 'resize', function () {
                                    map.setCenter(center);
                                });
                                $('#map').css('height', '360px');
                            }

                            google.maps.event.addDomListener(window, 'load', initialize);

                        </script>
                    <?php }, 100); ?>

                 <?php else: ?>
                    <?php the_content(); ?>
                 <?php endif;
            endwhile;
            wp_reset_query(); ?>

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
