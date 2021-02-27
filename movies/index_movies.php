<!DOCTYPE HTML>
<?php 

 /*----PHP Scripts And Variables----*/
    	error_reporting(E_ALL);
    	ini_set('display_errors', 1);
 
    session_start();
	include_once("../uni/db_connect.php"); 
	
    //Declaring Varibales
    $OS_Platform=GetOS();
    $IsMobile=IsMobile();
    $Prefix_Index=0; 
           
    //
    if (!isset ($_GET['page']) ) {$page = 1;} 
    else {$page = $_GET['page'];}     

  ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
    	<!-- +++ Title and meta tags section +++ --> 

        <title>Turkish Movies with English Subtitles</title>				
	  <meta name="description" content="">
	  <meta name="keywords" content="turkish series with english subtitles">
	  <meta name="author" content="turkishseriesandmovies.com"> 
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	
	   <!-- +++ Links and Scripts Section +++ -->		

	   <!-- +++ Basic small screen style up to 960px +++ -->
	  <link rel="stylesheet" type="text/css" href="../uni_styles.css">
	  <link rel="stylesheet" type="text/css" href="movies_styles.css">
	  <!-- +++ Own Scripts +++ -->
        <script type="text/javascript" src="/uni/Core.js"></script>
        <script type="text/javascript" src="index.js"></script>
	
	  <!-- +++ Outside Scripts +++ -->
	</head>


	<body>	    
	<div id="header">
      <div id="header_upper_strip">
        <div id="header_main">
           <img id="logo" src="../images/logo.png" alt="Turkishseriesandmovies logo">
                <div id="main_nav">
                  <a href="../index.php">Home</a>
                  <a href="../series/index_series.php">Series</a>
                  <a href="index_movies.php" class="current">Movies</a>
                  <a href="../contact_us.php">Contact us</a>
               </div>
         </div>
      </div>
    </div>


	<div id="content">
	<div id="wrapper">
		   <h1>Turkish Movies with English Subtitles</h1>

		     <!-- The sort and search section-->
		<?php include("sort.php"); ?>
			<div id="sort_form">
			<h2>Choose a Sorting Option:</h2>
			<form method="POST">
				<select name = "Sort">
				  <option value="def" <?php if($sort_key=="def") echo 'selected="selected"'; ?>>Default</option>
				  <option value="a_z" <?php if($sort_key=="a_z") echo 'selected="selected"'; ?>>Alphabetic(A-Z)</option>
				  <option value="z_a" <?php if($sort_key=="z_a") echo 'selected="selected"'; ?>>Alphabetic Inv (Z-A)</option>
				  <option value="n_o" <?php if($sort_key=="n_o") echo 'selected="selected"'; ?>>Date(Newer Titles First)</option>
				  <option value="o_n" <?php if($sort_key=="o_n") echo 'selected="selected"'; ?>>Date Inv(Older Titles First)</option>
				</select>
				<input type="submit" value="Sort">
			</form>
			
		</div>


		<div id="simple_search_form">
			<h2>Search for something general:</h2>
			<form  action="" method="POST">
				<input type="hidden" name="simple_search" value="true">
				<input type="text" name="search_string" placeholder="Title, actor, director">
				<input type="submit" value="Search">
			</form>

			<form action="" method="POST"> 
				<input type="hidden" name="reset_search_string" value="true">
				<input type="submit" value="Clear">
			</form>
		</div>		
		
		
	<div id="movies_list">
           
		<?php include("search.php");?>
	</div>
	
	<?php include("bottom_nav.php"); ?>
	
	</div>
</div>
</div>
</body>	
</html>
           

		
        
    