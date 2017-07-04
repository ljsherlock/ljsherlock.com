<?php
/**
* Generates the sidebar which contains contact info. The content of this is taken directly from the 'Contact Us' page.
* The border class is added to the first <p> using jquery, and the <h2>'s are replaced with <h3>'s
*
*/

/**
* Declare sidebar and heading links for each page
*/
$arr = array();
$arr['About Us'] = array('About_Timera_Energy','director_profiles','Senior_Advisor_profiles');
$arr['Our Approach'] = array('our_approach','our_analytical_principles','working_with_clients');
$arr['Consulting'] = array('value_management','risk_management','market_analysis','analytical_capability');
//$arr['Our Clients'] = array('our_clients');
//$arr['Training'] = array('timera_training','training_course_scope');


$title = the_title('','',false);

?>

<div id="primary" class="contact-info-side">
	<ul class="xoxo">
<?php
if (array_key_exists($title,$arr))
{
?>
		<li>
			<h3><?php the_title(); ?></h3>
			<p class="border no-padding-bottom">
<?php
	for ($i=0;$i<sizeof($arr[$title]);$i++)
	{
		echo '<a class="index-links" href="#'.$arr[$title][$i].'">'.str_replace('_',' ',ucfirst($arr[$title][$i])).'</a>';
	}
	if(is_page('our-services')) echo '<a class="index-links" href="'.get_bloginfo('url').'/our-approach/">Our approach</a>';
	if(is_page('about-us')){
		 echo '<a class="index-links" href="'.get_bloginfo('url').'/our-clients/">Our Clients</a>';
		 echo '<a class="index-links" href="'.get_bloginfo('url').'/our-approach/">Our Approach</a>';
	}
?>
			</p>		
		</li>
<?php
}
	
	if ( is_active_sidebar( 'third-widget-area' ) && is_page('our-clients')) dynamic_sidebar( 'third-widget-area' );

?>
		<li>
			<h3>General Enquiries</h3>
			<p class="border contact no-padding-bottom">


		Timera Energy <br />
		26 York Street <br />
		London <br />
W1U 6PZ<br />
United Kingdom<br /><br />


			Tel: +44 (0) 207 096 0040<br /><a href="mailto:info@timera-energy.com"> info@timera-energy.com</a><br /></p>
		</li>
		<li>
			<h3>Contacts</h3>
			<p class="border contact no-padding-bottom">
				<a href="about-us/#olly_spinks"><strong>Olly Spinks</strong></a><br /> 
				Director<br /> 
				Tel: +44 (0) 7525 724461<br />
				<a href="mailto:olly.spinks@timera-energy.com"> olly.spinks@timera-energy.com</a><br/><br/>
				<a href="about-us/#david_stokes"><strong>David Stokes</strong></a><br /> 
				Director<br /> 
				Tel: +44 (0) 7957 656337<br />
				<a href="mailto:david.stokes@timera-energy.com"> david.stokes@timera-energy.com</a>
			</p>
		</li>
	</ul>

	
</div>
