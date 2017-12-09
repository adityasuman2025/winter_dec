<?php
//header of the site pages
// A MNgo Creation by: Aditya Suman (http://www.mngo.in/aditya.php)
//including the file to connect to the database
	include('php/connect_db.php');
?>

<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="fbapp/fb.js"></script>

</head>

<!----------header-----bar-------->
<div class="header_bar">
	<div class="header_logo_bar">
		<img class="menu_img" src="img/menu_mob.png"/>
		<a href="index.php"><img class="header_logo_img" src="img/logo.jpg"></a>
	</div>



<!----user login and register area-->
	<div class="user_area">
	<!-----search--bar---->
		<div class="search_bar_div">
			<form action = "search.php" method="get">
				<input class="search_input" name="search_input" type="text">
				<input type="submit" value="search" class="search_button"/>
			</form>
		</div>

		<span class="logged_user_name">
			<?php
				if(isset($_COOKIE['logged_user_cookie']))
				{
					echo $_COOKIE['logged_user_cookie'];	
				}
			?>
		</span>

		<img class="user_area_img" src="img/user_icon.png"/>
	</div>

</div>

<!----serach bar for mobile---->
	<div class="search_bar_div_mob">
		<form action = "search.php" method="get">
			<input class="search_input_mob" name="search_input" type="text">
			<input type="submit" value="search" class="search_button_mob"/>
		</form>
	</div>


<!--------header bar 2 (mini)---->
<div class="header_mini_bar">
	<div class="pc_menu">
		<ul>
			<li><a href="deal.php">Deals</a></li>
			<form action="deal.php" method="get" class="catog_menu">
				<?php
					$sub_menu_query= "SELECT sub_menu FROM catog_menu";

					if($sub_menu_assoc_run = mysqli_query($connect_link , $sub_menu_query))
					{
						//getting sub menu
						while($submenu_array = mysqli_fetch_assoc($sub_menu_assoc_run))
						{
							$sub_menu_result = $submenu_array['sub_menu'];
							echo "<input type=\"submit\"  value= \"" .$sub_menu_result."\" name=\"deal_catog\" class=\"catog_menu_a\"><br>";
						}
					}
				?>
			</form>
			<li><a href="coupon.php">Coupons</a></li>
			<li><a>Travel Deal</a></li>
			<li><a>Local Service</a></li>
			
		</ul>
	</div>
</div>




<!---------loader div-------->
<div class="loader_bckgrnd">
</div>

<div class="div_loader">
	
	<button class="close_loader">X</button>
	
	<div class="log_reg_button">
		<button class="login_button">Login</button>
		<button class="register_button">Register</button>
	</div>

	<!--------login-div-------->
	<div class="login_div">
		<?php
			if(!isset($_COOKIE['logged_user_cookie']))
			{
				include('php/login_form.php');
			}
			else
			{
				$logged_user_id =  $_COOKIE['logged_user_cookie'];
				$logged_user_name_query = "SELECT name FROM users WHERE id = '$logged_user_id'";

				$logged_user_name_query_run = mysqli_query($connect_link, $logged_user_name_query);
				$logged_user_name_assoc = mysqli_fetch_assoc($logged_user_name_query_run);
				$logged_user_name = $logged_user_name_assoc['name'];

				echo "<div class=\"already_logged\">
						Welcome " .$logged_user_name. "!
						</div>";

				include('php/logout_form.php');
			}
		?>

	</div>

	<!--------register div-------->
		<div class="register_div">
			<input type="text" id="name_reg" placeholder="username" maxlength="15">
			<br>
			<span id="name_feed"></span>
			<br>
			<input type="email" id="email_reg" placeholder="email address">
			<br>
			<span id="email_feed"></span>
			<br>
			<input type="number" id="mob_reg" placeholder="mobile number">
			<br>
			<span id="mob_feed"></span>
			<br>
			<input type="password" id="pass_reg" placeholder="password">
			<br><br>
			<input id="re_pass_reg" type="password" placeholder="re-enter password">
			<br>
			<span id="pass_feed"></span>
			<br>
			<span id="random_no">
				<?php
					echo $random_no = rand(1,999);
				?>
			</span>
			<input type="text" placeholder="enter the text" id="random_no_input"/>
			<br><br>
			<button class="register_submit">Register</button>
		</div>
		<div id="reg_feed"></div>
		
	</div>



<!------scripts---->
<script type="text/javascript">

/*------search icon-------*/
	// $('.search_icon img').click(function()
	// {
	// 	//alert('0');

	// 	if($('.search_bar_div').hasClass('appear'))
	// 	{
	// 		$('.search_bar_div').animate({"right":"-310px"}, 600).removeClass('appear');
	// 	}
	// 	else
	// 	{
	// 		$('.search_bar_div').animate({"right":"5px"}, 600).addClass('appear');
	// 	}


	// });

/*-----category name changer-------*/
	win_width = $(window).width();
	if(win_width<800)
	{
		$('.pc_menu li:first-child').next().html('<a>CATEGORIES ></a>');
	}

/*-----mob menu toogle-------*/
	$('.menu_img').click(function()
	{
		var pc_menu = $('.pc_menu');

		if(pc_menu.hasClass('appear'))
		{
			$('.pc_menu').animate({"left":"-225px"}, 900).removeClass('appear');
		}
		else
		{
			$('.pc_menu').animate({"left":"00px"}, 900).addClass('appear');
		}

	});

/*----user area entry and exit--------*/
	$('.user_area_img').click(function()
	{
		$('.loader_bckgrnd').fadeIn(400);
		$('.div_loader').fadeIn(400);
	});

	$('.close_loader').click(function()
	{
		$('.loader_bckgrnd').fadeOut(400);
		$('.div_loader').fadeOut(400);
	});

	$('.loader_bckgrnd').click(function()
	{
		$('.loader_bckgrnd').fadeOut(400);
		$('.div_loader').fadeOut(400);
	});

/*----user area login and register switching--------*/
	$('.register_button').click(function()
	{
		$('.register_div').fadeIn(200);
		$('.login_div').fadeOut(0);
		$('#reg_feed').fadeIn(200);
		
	});

	$('.login_button').click(function()
	{
		$('.login_div').fadeIn(200);
		$('.register_div').fadeOut(0);
		$('#reg_feed').fadeOut(0);
	});

//varyfying variables for registration
	name_reg = $('#name_reg').val();
	pass_reg = $('#pass_reg').val();
	re_pass_reg = $('#re_pass_reg').val();
	email_reg = $('#email_reg').val();
	mob_reg = $('#mob_reg').val();

	pass_val = 0;
	email_val = 0;
	name_val = 0;
	random_val = 0;
	mob_val = 0;

/*----name varification-----*/
	$('#name_reg').keyup(function()
	{
		name_reg = $('#name_reg').val();
	
		if(name_reg !='')
		{
			$('#name_feed').text('Welcome ' + name_reg);
			name_val = 1;
		}
		else
		{
			$('#name_feed').text('');
			name_val = 0;
		}
		
	});

/*----password varification-----*/
	
	$('#re_pass_reg').keyup(function()
	{
		pass_reg = $('#pass_reg').val();
		re_pass_reg = $('#re_pass_reg').val();
	
		if(pass_reg !='' && re_pass_reg !='')
		{
			if(pass_reg != re_pass_reg && re_pass_reg != pass_reg)
			{
				$('#pass_feed').text('Password do no match').css('color','red');
				pass_val = 0;
			}
			else
			{
				$('#pass_feed').text('Password match').css('color','green');
				pass_val = 1;
			}
		}
		else
		{
			$('#pass_feed').text('');
			pass_val = 0;
		}
	});

	$('#pass_reg').keyup(function()
	{
		pass_reg = $('#pass_reg').val();
		re_pass_reg = $('#re_pass_reg').val();
	
		if(pass_reg !='' && re_pass_reg !='')
		{
			if(pass_reg != re_pass_reg && re_pass_reg != pass_reg)
			{
				$('#pass_feed').text('Password do no match').css('color','red');
				pass_val = 0;
			}
			else
			{
				$('#pass_feed').text('Password match').css('color','green');
				pass_val = 1;
			}
		}
		else
		{
			$('#pass_feed').text('');
			pass_val = 0;
		}
	});

/*----email varification-----*/
	$('#email_reg').keyup(function()
	{
		email= $.trim($('#email_reg').val());
		if(email!='')
		{
			$.post('php/email.php',{email: email},function(e)
			{	
				if(e=="1")
				{
					//$('#email_feed').text('Valid email address');
					//email_val = 1;

					//varyfing if that email already exists
					$.post('php/email_existing_varification.php', {email: email}, function(e)
					{
						$('#email_feed').text(e);
						if(e==1)
						{
							email_val = 1;
							$('#email_feed').text('Valid email address').css('color','green');
						}
						else
						{
							email_val = 0;
							$('#email_feed').text('Email already exists').css('color','red');
						}
						
					});			
			
				}
				else
				{
					$('#email_feed').text('Invalid email address').css('color','red');
					email_val = 0;
				}
				
			});


		}
		else
		{
			$('#email_feed').text('');
			email_val = 0;
		}
	});

/*---random text varification--------*/
	$('#random_no_input').keyup(function()
	{
		random_no_input = $('#random_no_input').val();
		random_no = $.trim($('#random_no').html());
		 
		if(random_no_input == random_no)
		{
			random_val = 1;
			//alert('gud');
		}
		else
		{
			random_val = 0;
		}

	});

/*--mobile no varification--*/
	$('#mob_reg').keyup(function()
	{
		mob_reg_length = $('#mob_reg').val().length;
		if(mob_reg_length>10)
		{
			$('#mob_feed').text('Mobile no. cannot be greater than 10 digits').css('color','red');
			mob_val = 0;
		}
		else if (mob_reg_length == 10)
		{
			mob_val = 1;
			$('#mob_feed').text('').css('color','green');
		}
		else
		{
			$('#mob_feed').text('Mobile no. cannot be less than 10 digits').css('color','red');
			mob_val = 0;
		}

	});

/*----on clicking login button-----*/
	$('.register_submit').click(function()
	{
		name_reg = $('#name_reg').val();
		pass_reg = $('#pass_reg').val();
		re_pass_reg = $('#re_pass_reg').val();
		email_reg = $('#email_reg').val();
		mob_reg = $('#mob_reg').val();

		if(pass_val == 1 && email_val==1 && name_val==1 && random_val == 1 && mob_val ==1)
		{
			$.post('php/register.php', {name_reg : name_reg, pass_reg : pass_reg, email_reg : email_reg, mob_reg : mob_reg}, function(e)
			{
				$('#reg_feed').css('padding','5px').text(e).delay(3000).fadeOut(500);
				$('.register_div').fadeOut(0);
				$('.register_button').fadeOut(0);
				$('.login_div').fadeIn(200);
			});

		}
		else
		{
			$('#reg_feed').css('margin-top', 'auto').text('Fill all the required fields correctly');
		}

	});
</script>
