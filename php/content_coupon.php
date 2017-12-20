<h4 class="content_deal_h4">Coupons</h4>
<br>	
	
<?php
//content of the coupon content
	include('connect_db.php');

	$content_coupon_query = $_POST['content_query'];
	$content_coupon_query_run = mysqli_query($connect_link, $content_coupon_query);
	while($content_coupon_data = mysqli_fetch_assoc($content_coupon_query_run))
	{
		$content_coupon_id= $content_coupon_data['id'];

		$content_coupon_name= $content_coupon_data['name'];
		$content_coupon_image= $content_coupon_data['image'];
		$content_coupon_desc= $content_coupon_data['desc'];
		$content_coupon_code= $content_coupon_data['code'];
		$content_coupon_expiry= $content_coupon_data['expiry'];
		$content_coupon_provider= $content_coupon_data['provider'];
		$content_coupon_link= $content_coupon_data['link'];

		echo "<div class=\"content_coupon_div\">
				 <div class=\"content_coupon_image\">
				 	<img src=\"img/coupon/$content_coupon_image\" onerror=\"this.onerror=null;this.src='img/logo.jpg';\"/> 
				 </div>

				 <div class=\"content_coupon_info\">
					<h3>$content_coupon_name</h3>
					<h4>$content_coupon_provider</h4>
					<span id=\"expiry\">$content_coupon_expiry</span>
				 </div>

				<button coupon_id=\"$content_coupon_id\" class=\"coupon_code_button\"><a target=\"_blank\" href=\"$content_coupon_link\">Catch Coupon</a></button>
			  </div>";
	}
?>

<!---------loader div-------->
<div class="coupon_loader_bckgrnd">
	
</div>

<div class="coupon_loading_div">
	<button class="close_loader_coupon">X</button>
	<div class="div_coupon_loader">
			
	</div>
</div>


<!--------scripts-------->
<script type="text/javascript">

/*----coupon viewer entry and exit--------*/
	$('.coupon_code_button').click(function()
	{
		$('.coupon_loader_bckgrnd').fadeIn(400);
		$('.coupon_loading_div').fadeIn(400);
	});

	$('.close_loader_coupon').click(function()
	{
		$('.coupon_loader_bckgrnd').fadeOut(400);
		$('.coupon_loading_div').fadeOut(400);
	});

	$('.coupon_loader_bckgrnd').click(function()
	{
		$('.coupon_loader_bckgrnd').fadeOut(400);
		$('.coupon_loading_div').fadeOut(400);
	});

/*--------on clicking get coupon button---*/
	$('.coupon_code_button').click(function()
	{
		coupon_id = $(this).attr('coupon_id');
		$.post('php/coupon_desc_viewer.php', {coupon_id:coupon_id}, function(e)
		{
			$('.div_coupon_loader').html(e);
		});

	});

</script>
