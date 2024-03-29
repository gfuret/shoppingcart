
<?php 
$pageTitle = "Shirts4Mike Store";
$section = 'index';
include_once('inc/header.php');
?>

	<div class="section banner">

		<div class="wrapper">

			<img class="hero" src="img/mike-the-frog.png" alt="Mike the Frog says:">
			<div class="button">
				<a href="shirts.php">
					<h2>Hey, I&rsquo;m Mike!</h2>
					<p>Check Out My Shirts</p>
				</a>
			</div>
		</div>

	</div>

	<div class="section shirts latest">

		<div class="wrapper">

			<h2>Mike&rsquo;s Latest Shirts</h2>
			<?php include('inc/products.php'); 
			$totalProducts = count($products);	
			$position = 0;	?>
			<ul class="products">
				<?php foreach ($products as $product_id => $product) { 
						$position++;
						if($position <= $totalProducts-4){ continue;}
						echo get_list_view_html($product_id, $product);
				}	?> 						
			</ul>

		</div>
	</div>

<?php include_once('inc/footer.php');?>