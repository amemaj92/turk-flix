<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
    	<!-- +++ Title and meta tags section +++ --> 

        <title>Turkish Series with English Subtitles</title>				
	<meta name="description" content="">
	<meta name="keywords" content="turkish series with english subtitles">
	<meta name="author"   content="turkishseriesandmovies.com"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- +++ Links and Scripts Section +++ -->		

	<!-- +++ Basic small screen style up to 960px +++ -->
	<link rel="stylesheet" type="text/css" href="../uni_styles.css">
	<link rel="stylesheet" type="text/css" href="premium_style.css">
	<!-- +++ Own Scripts +++ -->
        <script type="text/javascript" src="/uni/Core.js"></script>
        <script type="text/javascript" src="index.js"></script>
	
	<!-- +++ Outside Scripts +++ -->

<body>
  <div id="header">
      <div id="header_upper_strip">
        <div id="header_main">
           <img id="logo" src="../images/logo.png" alt="Turkishseriesandmovies logo">
                <div id="main_nav">
                  <a href="../index.php">Home</a>
                  <a href="../series/index_series.php">Series</a>
                  <a href="../movies/index_movies.php">Movies</a>
                  <a href="premium.php" class="current">Premium</a>
               </div>
         </div>
      </div>
    </div>

    <div id="forms">
       <div id="intro_wrapper">
         <div id="login">
	        <h1>Are you registered? Log in here.</h1>
            <?php ?>
            <form action="process_login.php" method="post" name="login_form"> 			
			  <ul>
			  <li><label for="email">Email:</label><input type="text" name="email"></li>
			  <li><label for="password">Password:</label><input type="password" name="password" id="password"></li>
			  </ul>
			<input type="button" value="Log In" onclick="formhash(this.form, this.form.password);"> 
			</form>
		
		    <div id="pass_reset">
             <p>If you have forgotten your password, clik the link below to reset it.
             <br><a href="pass_reset.php">Click here to reset your password.</a></p>
            </div>
		 </div>	
	    </div>

        <div id="signup">
	        <h1>Would you like to sign up? Fill the form below. </h1>
	         <form action="" method="post" name="registration_form">		        
		         <ul>
                    <li><p class="error_alert">The Username can consist only of alphanumeric letters and underscores.</p>
		            	<label for="username">Username: </label><input type='text' name='username' id='username'>
		            </li>

		            <li><p class='error_alert'></p>
		            	<label for="email">E-mail: </label> <input type="text" name="email" id="email">
		            </li>

		            <li><p class='error_alert'></p>
		            	<label for="paypal_email">Paypal e-mail: </label> <input type="text" name="paypal_email" id="paypal_email">
		            </li>

		            <li><p class="form_info">The password must contain at least:</p>
		                <ul id="pass_requirements_info">
		                    <li>One Uppercase character (A..Z)</li>
		                    <li>One lowercase character (a..z)</li>
		                    <li>One number (0..9)</li>
		                </ul>
		                <p class="error_alert">Password must be at least 6 characters long.</p>
		            	<label for="password">Password: </label><input type="password" name="password" id="password">
		            </li>

		            <li>
		            	 <p class="error_alert">Passwords must be identical.</p>
		                 <label for="confirmpwd">Confirm password: </label><input type="password" name="confirmpwd" id="confirmpwd">
		            </li>
		        </ul>

		        <input type="button" value="Sign Up" onclick="return regformhash(this.form, this.form.username, this.form.email,
                     this.form.paypal_email, this.form.password, this.form.confirmpwd);"> 

		     </form>
        </div>
      

        <div id="content">
	      <!--Information text-->
	      <div id="text_divs_wrapper">
          <h2>What does the premium service offer?</h2>
		    <p>The Premium Service is a subscription service and offers you the opportunity to watch everything
            our website has to offer, including all movies and series without ads, on a dedicatedd server, 
            without any missing part or broken links for a cheap price of only $6 (USD) per month. 
            This is the only benefit for the moment, but we aim to use it in a Patreon manner in the future, 
            if there are enough interested users, giving you the possibility for voting for the new content you would like to see on our website. </p>
		    <div id="video_div">
		      <h2>Video Demonstration</h2>
		         <div id="video_container">
		           <video controls oncontextmenu="return false;">
		             <source src="Tutorial_Premium.mp4" type="video/mp4">
	               </video>
		          </div>
        </div>  
	     </div>		
        </div>
    
	</div>	     

</body>
</head>
</html>