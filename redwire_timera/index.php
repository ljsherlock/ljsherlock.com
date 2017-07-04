<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<?php /* <div id="home-banner">
<p>Timera Energy offers senior consulting expertise on value and risk in the global LNG and European energy markets.<br />
We are experts in the analysis of energy assets, contracts and portfolios and the markets in which they operate.</p>
</div> */ ?>
	<div id="content" class="clearfix">

		<div class="col-2">
			<h2>About Timera Energy</h2>
			<ul class="xoxo">
			<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div>

		<div class="col-1 home">
			<h1 class="home">Recent Timera Energy Blog posts</h1>
			
			<?php
			/* Run the loop to output the posts.
		 	* If you want to overload this in a child theme then include a file
		 	* called loop-index.php and that will be used instead.
		 	*/
		 	get_template_part( 'loop', 'index' );
			?>
		</div>
			
	</div><!-- #container -->

<?php get_footer(); ?>
