<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="<?php echo BURL.'assets/img/basic/favicon.png'; ?>" />
	<script type="text/javascript" src="<?php echo BURL.'assets/js/alert.js'; ?>"></script>
	<title>SEA BREEZE HOTEL</title>

</head>
<body>

<?php	if(isset($errors) && !empty($errors)) { ?>
        <button style="display:none;" id="error-state"
            onclick="customAlert.alert('Enter Data is invalid')">
        </button>
    <?php } else { ?>
    <?php	if(isset($msg2)) {?>
        <button style="display:none;" id="error-state"
            onclick="customAlert.alert('Plaese login then Reserve Room')">
        </button>
    <?php }if(isset($roomAvailable['availability']) && $roomAvailable['availability'] == 0) { ?>
        <button style="display:none;" id="error-state"
            onclick="customAlert.alert('Hall is Not Available')">
        </button>
    <?php }} ?>

	<?php include(VIEWS.'inc/header_navbar.php'); ?>

	<?php 

			switch ($id) {
				case '1':
	?>
		<div class="slidecontainer">
			<img class="image" src="<?php echo BURL.'assets/img/banquet/post1.jpg' ?>" alt="beach side city view">
		 	<div class="bottom-left">
		 		<h1>WHITE HORSE BANQUET HALL</h1>
		 	</div>
		</div>
		<div class="headImg">
			<div class="first">
			
			<p class="">Our halls provide lavish event space that can be set up to host a variety of private events from weddings to corporate events. Our furnished, air-conditioned halls with smooth lighting can host between 100 and 350 people depending on the setting you require. Seating could be set up for banquets, conferences, corporate events and more. In-house catering, staff and a whole host of other services and facilities ensure that your special event is memorable.</p>
			
			<div class="package">

				<img src="<?php echo BURL.'assets/img/banquet/sub1.jpg' ?>" alt="" class="packImg">
				<div class="price">
					<dl class="inline">
					<p class="head">Beautiful Banquet hall with an opulent setting, beautiful decorations, Experienced Catering service , ample parking, photo locations make the perfect venue for wedding ceremonies, Birthday parties, Get-togethers and more…</p>
						<dt>PACKAGE INCLUDES:</dt>
						<dd>Luxery Hall</dd>
						<dt>DAILY TIMES:</dt>
						<dd>Function start 9am daily</dd>
						<dt>SHEDULE:</dt>
						<dd>6 hrs long</dd>
						<dt>PRICES:</dt>
						<dd>25000  LKR</dd>
					</dl>
					<!-- <a class="btn" href="">BOOK NOW <i class="fa fa-chevron-right" aria-hidden="true"></i></a> -->
				</div>
				
			</div>
			
				  
				    <div class="reviewQuote group">
				        <img src="<?php echo BURL.'assets/img/banquet/prof1.jpg' ?>">
				        <div class="quote-container">
				            <blockquote>
				                <p>Had my first ever banquet lesson here and it was incredible! We were recommended Freedom as the best banquet school in Weligama by our hostel and I see why- I got a one-to-one lesson for 2000 LKR and my teacher was patient, encouraging and gave me feedback on how to improve each time I didn't manage to stand up! ”</p>
				            </blockquote>  
				            <cite><span>Olivia Williams</span><br>
				                USA
				            </cite>
				        </div>
      
   					</div>
   				
   			
			</div>

			<div class="second">
				<?php include(VIEWS.'inc/banquet-catogery.php'); ?>

			</div>
			
		</div>

	<?php
					break;
				case '2':
	?>
	<div class="slidecontainer">
			<img class="image" src="<?php echo BURL.'assets/img/banquet/post2.jpg' ?>" alt="beach side city view">
		 	<div class="bottom-left">
		 		<h1>WHITE ELEPHANT BANQUET HALL</h1>
		 	</div>
		</div>
		<div class="headImg">
			<div class="first">
			
			<p class="">Our halls provide lavish event space that can be set up to host a variety of private events from weddings to corporate events. Our furnished, air-conditioned halls with smooth lighting can host between 100 and 350 people depending on the setting you require. Seating could be set up for banquets, conferences, corporate events and more. In-house catering, staff and a whole host of other services and facilities ensure that your special event is memorable.</p>
			
			<div class="package">
				<img src="<?php echo BURL.'assets/img/banquet/sub2.jpg' ?>" alt="" class="packImg">
				<div class="price">
					<dl class="inline">
					<p class="head">Beautiful Banquet hall with an opulent setting, beautiful decorations, Experienced Catering service , ample parking, photo locations make the perfect venue for wedding ceremonies, Birthday parties, Get-togethers and more…</p>
						<dt>PACKAGE INCLUDES:</dt>
						<dd>Luxery Hall</dd>
						<dt>DAILY TIMES:</dt>
						<dd>Function start 9am daily</dd>
						<dt>SHEDULE:</dt>
						<dd>6 hrs long</dd>
						<dt>PRICES:</dt>
						<dd>25000  LKR</dd>
					</dl>
					<!-- <a class="btn" href="">BOOK NOW <i class="fa fa-chevron-right" aria-hidden="true"></i></a> -->
				</div>
				
			</div>

			<div id="kudo-wrap"> 
				  <div class="adj-layer">
				    <!-- <h1>Kudos</h1> -->
				    <div class="reviewQuote group">
				        <img src="<?php echo BURL.'assets/img/banquet/prof2.jpg' ?>">
				        <div class="quote-container">
				            <blockquote>
				                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit justo augue, vitae lobortis sapien interdum ut. Phasellus condimentum leo ut sem pulvinar, in sodales erat feugiat. Pellentesque ac cursus odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ”</p>
				            </blockquote>  
				            <cite><span>Jan Baby</span><br>
				                RMT<br>
				                TLC Medical Massage
				            </cite>
				        </div>
      
   					</div>
   				</div>
   			</div>

			</div>
			<div class="second">
				<?php include(VIEWS.'inc/banquet-catogery.php'); ?>
			</div>
			
		</div>
	<?php
					break;
				case '3':
	?>
	<div class="slidecontainer">
			<img class="image" src="<?php echo BURL.'assets/img/banquet/post3.jpg' ?>" alt="beach side city view">
		 	<div class="bottom-left">
		 		<h1>WHITE LION BANQUET HALL</h1>
		 	</div>
		</div>
		<div class="headImg">
			<div class="first">
			
			<p class="">Our halls provide lavish event space that can be set up to host a variety of private events from weddings to corporate events. Our furnished, air-conditioned halls with smooth lighting can host between 100 and 350 people depending on the setting you require. Seating could be set up for banquets, conferences, corporate events and more. In-house catering, staff and a whole host of other services and facilities ensure that your special event is memorable.</p>
			
			<div class="package">

				<img src="<?php echo BURL.'assets/img/banquet/sub3.jpg' ?>" alt="" class="packImg">
				<div class="price">
					<dl class="inline">
					<p class="head">Beautiful Banquet hall with an opulent setting, beautiful decorations, Experienced Catering service , ample parking, photo locations make the perfect venue for wedding ceremonies, Birthday parties, Get-togethers and more…</p>
						<dt>PACKAGE INCLUDES:</dt>
						<dd>Luxery Hall</dd>
						<dt>DAILY TIMES:</dt>
						<dd>Function start 9am daily</dd>
						<dt>SHEDULE:</dt>
						<dd>6 hrs long</dd>
						<dt>PRICES:</dt>
						<dd>25000  LKR</dd>
					</dl>
					
				</div>
				
			</div>

			<div id="kudo-wrap"> 
				  <div class="adj-layer">
				    <!-- <h1>Kudos</h1> -->
				    <div class="reviewQuote group">
				        <img src="<?php echo BURL.'assets/img/banquet/prof3.jpg' ?>">
				        <div class="quote-container">
				            <blockquote>
				                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit justo augue, vitae lobortis sapien interdum ut. Phasellus condimentum leo ut sem pulvinar, in sodales erat feugiat. Pellentesque ac cursus odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ”</p>
				            </blockquote>  
				            <cite><span>Jan Baby</span><br>
				                RMT<br>
				                TLC Medical Massage
				            </cite>
				        </div>
      
   					</div>
   				</div>
   			</div>

			</div>
			<div class="second">
				<?php include(VIEWS.'inc/banquet-catogery.php'); ?>
			</div>
			
		</div>
	<?php
	
					break;
				default:
					# code...
					break;
			}
	
	?>
	<?php include(VIEWS.'inc/footer.php'); ?>

	
	<script type="text/javascript">
	window.onload = function () {
		const navbar= document.querySelector(".nav");
		// console.log(navbar);
		navbar.classList.toggle("sticky");
	};
	</script>

<script>
    if (document.getElementById('error-state')) {
        console.log("shhshdhsdh");
        document.getElementById('error-state').click();
    }
    </script>
</body>
</html>