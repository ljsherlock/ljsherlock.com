<div class="shareinpost">
    <ul class="socialwrap ">
        <li>
            <div class="hidden">
                <?php do_action( 'addthis_widget', get_permalink(), get_the_title(), array(
                    'type' => 'small-toolbox',
                    'size' => '16', // size of the icons.  Either 16 or 32
                    'services' => 'facebook,twitter,linkedin', // the services you want to always appear
                    'preferred' => '', // the number of auto personalized services
                    'more' => true, // if you want to have a more button at the end
                    ));
                ?>
            </div>
        </li>
        <!-- <li><a href="javascript:window.print();">Print</a></li>
        <li> <a href="mailto:?subject=<?php //the_title();?>&amp;body=Check out this <?php //the_permalink();?>" -->
        <!-- title="Share by Email">Email</a></li> -->
        </ul>
        <ul class="socialwrap reveal-text share-links">
        <li> <a href="https://twitter.com/share"  data-count="none" class="popup">Twitter</a></li>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <li>  <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>" class=" popup">Linkedin</a></li>
    </ul>
</div>
