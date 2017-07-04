

<footer>
		&copy; Timera Energy <?php echo date('Y'); ?> | Registered in England and Wales No. 6728502 | <a href="/sitemap/">Sitemap</a> | <a href="/disclaimer/">Disclaimer</a> | <a href="/contact-us/">Contact Us</a>
	</footer><!-- #footer -->

 </main>

<div id="overlay"></div>

<?php wp_footer();
?>

  <script  src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/respond.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/modernizr.js"></script>
<script  src="<?php bloginfo('template_url');?>/js/custom.js"></script>
<script>
var ajax_url = '<?= LJS_AJAXURL ?>';

var require = {
    baseUrl: '<?= get_template_directory_uri() ?>/View/Assets/Scripts',
    paths: {
        Polyfills: 'Lib/polyfills',
        Util: 'Utils/util',
        Mustard: 'Lib/mustard',
        Core: 'Core',
        App: 'App',
        Config: 'Lib/appConfig',
    }
};
</script>
<script src="<?php echo get_template_directory_uri(); ?>/View/Assets/Scripts/Lib/require.js" data-main="Main"></script>


</body>
</html>
