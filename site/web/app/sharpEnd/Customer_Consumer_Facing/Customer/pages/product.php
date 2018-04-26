<?php

	$product_data = $database_decoded['categories'][$style]['products'][$product];

?>

<div id="style" class="container">
	<img src="assets/bb/products/<?php echo $product; ?>.png" />
	<p class="blurb store">Selfridges</p>
	<h2 class="product"><?php echo $product_data['title']; ?></h2>
	<p class="price"><?php echo $product_data['price']; ?></p>
	
	<div class="left-align container description">
		<?php if($product_data['bio']['description']): ?>
			<p class="blurb flow-text"><?php echo $product_data['bio']['description']; ?></p>
		<?php endif; ?>	
		<?php if($product_data['bio']['what']): ?>
			<p><strong>What: </strong><?php echo $product_data['bio']['what']; ?></p>
		<?php endif; ?>
		<?php if($product_data['bio']['who']): ?>
			<p><strong>Who: </strong><?php echo $product_data['bio']['who']; ?></p>
		<?php endif; ?>
		<?php if($product_data['bio']['when']): ?>
			<p><strong>When: </strong><?php echo $product_data['bio']['when']; ?></p>
		<?php endif; ?>
		<?php if($product_data['bio']['how']): ?>
			<p><strong>How: </strong><?php echo $product_data['bio']['how']; ?></p>
		<?php endif; ?>
	</div>
</div>

<?php if($product_data['styles']): ?>
	<h2>styles with this product</h2>
	<div>
	<?php foreach(($product_data['styles']) as $style_image): ?>
		<img class="responsive-img" src="<?php echo 'assets/bb/styles/'.$style_image.'.jpg'; ?>" />
	<?php endforeach; ?>
	</div>
<?php endif; ?>