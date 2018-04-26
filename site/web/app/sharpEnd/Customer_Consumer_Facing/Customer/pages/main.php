	<?php
		$array_number = count($database_decoded['categories']);
		$iteration = 0;
		foreach($database_decoded['categories'] as $category_key => $category):
		$iteration++;
	?>

		<section class="product-archive" id="<?php echo $category_key; ?>">
			<h2><?php echo $category['title']; ?></h2>
			<ul>
				<?php 
					foreach($category['products'] as $key => $item):
				?>
					
					<li>
					<?php 
					// If first product of category
					if(($key == 'prep-primer')||($key == 'save-the-day')||($key == 'hairdressers-invisible-oil-shampoo')||($key == 'thickening-shampoo')||($key == 'tres-invisible-dry-shampoo')||($key == 'curl-shampoo')||($key == 'surf-spray')): ?>
						
						<a href="?language=<?php echo $language; ?>&style=<?php echo $category_key; ?>&product=<?php echo $key; ?>" class="selectable_product" id="<?php echo $key; ?>">
					
					<?php 
					// If any other product in category
					else: ?>
					
						<a class="modal-trigger" href="#wrong_product" id="<?php echo $key; ?>">
							<span style="display:none;" id="category_span"><?php echo $category['title']; ?></span>
							<span style="display:none;" id="categoryid_span"><?php echo $category_key; ?></span>
							<span style="display:none;" id="product_span"><?php // all part of logic to stop users seeing all the products - just 1st ones of each category
									if($category_key == 'styling'){
										echo "Prep Primer";
									} else if($category_key == 'shampoo-conditioner'){
										echo "Save&nbsp;the&nbsp;Day";
									} else if($category_key == 'hio'){
										echo "Shampoo";
									} else if($category_key == 'thickening'){
										echo "Shampoo";
									} else if($category_key == 'newness'){
										echo "Dry Shampoo";
									} else if($category_key == 'curl'){
										echo "Shampoo";
									} else if($category_key == 'surf'){
										echo "Surf Spray";
									}
							?></span>
							<span style="display:none;" id="productid_span"><?php
									if($category_key == 'styling'){
										echo "prep-primer";
									} else if($category_key == 'shampoo-conditioner'){
										echo "save-the-day";
									} else if($category_key == 'hio'){
										echo "hairdressers-invisible-oil-shampoo";
									} else if($category_key == 'thickening'){
										echo "thickening-shampoo";
									} else if($category_key == 'newness'){
										echo "tres-invisible-dry-shampoo";
									} else if($category_key == 'curl'){
										echo "curl-shampoo";
									} else if($category_key == 'surf'){
										echo "surf-spray";
									}
							?></span>
					<?php endif; ?>
					
							<img src="assets/bb/products/<?php echo $key; ?>.png" />
							<h3><?php echo $item['title']; ?></h3>
							<p><?php echo $item['price']; ?></p>
					
						</a>
					</li>

				<?php 
					endforeach;
				?>
			</ul>
		</section>
		<?php if ($iteration < $array_number): ?>
		<div class="section_breaker">
			&nbsp;
		</div>
	<?php endif; ?>
	<?php 
		endforeach;
	?>
	<!-- Modal Structure -->
	<div id="wrong_product" class="modal">
		<div class="modal-content">
			<p class="blurb">This is where you would find out about <span id="product_name">&nbsp;</span>. To see a <span class="category_name">&nbsp;</span> product page, select <span class="selectable_product_name">&nbsp;</span>.</p>
		</div>
		<div class="modal-footer row">
			<a id="cancel" class="col s4 modal-action modal-close btn-flat">Cancel</a>
			<a id="share_button" href="?language=<?php echo $language; ?>&style=styling&product=prep-primer" class="col s6 push-s2 modal-action btn-flat"><span class="selectable_product_name">&nbsp;</span></a>
	    </div>
	</div>