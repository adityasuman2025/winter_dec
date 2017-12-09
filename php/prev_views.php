<?php

	include('php/connect_db.php');

	$logged_user_id = $_COOKIE['logged_user_cookie'];

	$get_users_views_query = "SELECT * FROM users WHERE id = '$logged_user_id'";

	if($get_users_views_query_run = mysqli_query($connect_link, $get_users_views_query))
	{
		//echo 'works';
		$get_users_views_assoc = mysqli_fetch_assoc($get_users_views_query_run);

	//getting deal_id of views of user 
		$view_1_deal_id = $get_users_views_assoc['view1'];
		$view_2_deal_id = $get_users_views_assoc['view2'];
		$view_3_deal_id = $get_users_views_assoc['view3'];
		$view_4_deal_id = $get_users_views_assoc['view4'];
		$view_5_deal_id = $get_users_views_assoc['view5'];

	//query for showing previous viewed deals
		$query_to_send = "SELECT * FROM content_deal WHERE id IN (" . $view_1_deal_id . "," . $view_2_deal_id ."," . $view_3_deal_id ."," . $view_4_deal_id . "," . $view_5_deal_id . ") ORDER BY id DESC";
		
		$content_query_run = @mysqli_query($connect_link, $query_to_send);
	
		while($content_query_data = @mysqli_fetch_assoc($content_query_run))
		{
			$content_id = $content_query_data['id'];
			
			$content_image = $content_query_data['image'];
			$content_provider = $content_query_data['provider'];
			$content_name = $content_query_data['name'];
			$content_org_price = $content_query_data['org_price'];
			$content_off = $content_query_data['off'];
			$content_price = $content_query_data['price'];
			$content_deal = $content_query_data['deal'];

			$content_time = $content_query_data['time'];

		//for getting time passed since post
			
			$content_timestamps = strtotime($content_time);
			$current_time = time();
			$time_spent = $current_time - $content_timestamps;

			$time_in_mins = round($time_spent/60) . " mins";

			$time_in_hrs= "";
			$time_in_days= "";
			$time_in_mnths = "";

			if($time_in_mins>=60)
			{
				$time_in_hrs = round($time_in_mins/60) . " hrs";
				$time_in_mins = $time_in_mins % 60 . " mins";

				if($time_in_hrs >= 24)
				{
					$time_in_days = round($time_in_hrs/24) . " days";
					$time_in_hrs =  $time_in_hrs % 24 . " hrs";
					$time_in_mins = $time_in_mins % 60 . " mins";

					if($time_in_days>=30)
					{
						$time_in_mnths =  round($time_in_days/30) . " months";
						$time_in_days = $time_in_days % 30 . " days";
						$time_in_hrs =  $time_in_hrs % 24 . " hrs";
						$time_in_mins = $time_in_mins % 60 . " mins";

					}
				}
			}

			echo "<div class=\"content_div\">
					<div class=\"content_info\">
						<div class=\"content_image\">
							<img src=\"img/deal/$content_image \"/>
						</div>

						<div class=\"content_data\">
							<span id=\"content_provider\">
								$content_provider
							</span>
							<br>
							<span id=\"content_name\">
								$content_name
							</span>
						</div>
					</div>
					
					<div class=\"content_price_div\">
						<span id=\"content_price\">
							&#8377 $content_price
						</span>
						<br>
						<span id=\"content_off\">
							$content_off%
						</span>

						<span id=\"content_org_price\">
							&#8377 $content_org_price
						</span>

						<form method=\"post\" action=\"desc_viewer.php\">
							<input type=\"text\" name=\"content_deal_id\" id=\"content_deal_id\" value=\"$content_id\"/>
							<span id=\"time_spent\">$time_in_mnths $time_in_days $time_in_hrs $time_in_mins ago</span>

							<input type=\"submit\" name =\"content_deal\" id=\"content_deal\" value=\"Get Deal\">
						</form>
					</div>
					
				  </div>";
		}

	}
	else
	{
		echo 'something went wrong';
	}

?>

<script type="text/javascript">
	
</script>