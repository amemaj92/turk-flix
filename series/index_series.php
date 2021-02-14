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
           

    /*---if(!isset($_POST["Sort"]) && !isset($_GET["page"])) {unset($_SESSION['post']);}---*/

		   //Variabli Sort per radhitjen e rezultatit
		   if(isset($_POST["Sort"])) {$Sort=$_POST["Sort"]; $_SESSION["Sort"]=$Sort;}
		   elseif(isset($_SESSION["Sort"]))  {$Sort = $_SESSION["Sort"];}
		   else {$Sort="default";}

    //Dritarja per kuantizimin e listes se serialeve
    if(isset($_GET["page"])) {$Window=intval($_GET["page"]);}
    else $page=1; 

    /*---//Updating the $_SESSION['post'] superglobal for the next or previous nav clicks (specific post variables should be deleted with functions)
    if(isset($_POST) && count($_POST)) {$_SESSION['post'] = $_POST;}
    if(isset($_SESSION['post']) && count($_SESSION['post'])) {$_POST = $_SESSION['post'];}---*/
   
  ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
    	<!-- +++ Title and meta tags section +++ --> 

        <title>Turkish Series with English Subtitles</title>				
	<meta name="description" content="">
	<meta name="keywords" content="turkish series with english subtitles">
	<meta name="author" content="turkishseriesandmovies.com"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- +++ Links and Scripts Section +++ -->		

	<!-- +++ Basic small screen style up to 960px +++ -->
	<link rel="stylesheet" type="text/css" href="../uni_styles.css">
	<link rel="stylesheet" type="text/css" href="series_styles.css">
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
                  <a href="index_series.php" class="current">Series</a>
                  <a href="../movies/index_movies.php">Movies</a>
                  <a href="../premium/premium.php">Premium</a>
               </div>
         </div>
      </div>
    </div>
             
<div id="content">
	<div id="wrapper">
		   <h1>Turkish Series with English Subtitles</h1>

		     <!-- The sort and search section-->

			<div id="sort_form">
			<h2>Choose a Sorting Option:</h2>
			<form method="POST">
				<select name = "Sort">
				  <option value="def" <?php if($Sort=="def") echo 'selected="selected"'; ?>>Default</option>
				  <option value="a_z" <?php if($Sort=="a_z") echo 'selected="selected"'; ?>>Alphabetic(A-Z)</option>
				  <option value="z_a" <?php if($Sort=="z_a") echo 'selected="selected"'; ?>>Alphabetic Inv (Z-A)</option>
				  <option value="n_o" <?php if($Sort=="n_o") echo 'selected="selected"'; ?>>Date(Newer Titles First)</option>
				  <option value="o_n" <?php if($Sort=="o_n") echo 'selected="selected"'; ?>>Date Inv(Older Titles First)</option>
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
			<a href="#" id="avd_search_toggler">Advanced Search</a> 
		</div>
		<div id="adv_search_form">			
			<form method="POST">
			    <fieldset>
					<legend>Advanced Search</legend>
				    <p>Note: When entering multiple data on one field, separate them with a comma.</p>
				    <ul>
					<li>
					<label for="title">Title:</label>
					<input type="text" id="titulli" name="Title" placeholder="Kara Sevda">
					</li>
					
					<li>
					<label for="director">Direct:</label>
					<input type="text" id="regjia" name="Directors" placeholder="Hilal Saral">
					</li>
					
					<li>
					<label for="years">Year:</label>
					<input type="text" id="vitet" name="Years" placeholder="2016,2017">
					</li>
					
					<li>
					<label for="actors">Actors:</label>
					<input type="text" id="aktoret" name="Actors" placeholder="Burak Ozcivit,Neslihan Atagul">
					</li>
					
					<li>
					<label for="genre">Genre:</label>
					<input type="text" id="zhanri" name="Subgenre" placeholder="drama, romance">
					</li>
					
					<li>
					<input type="submit" value="Search">
					</li>					
				</ul>				
			</form>
		</div>
		
		
		
	<div id="series_list">
           
		<?php 
		
		include("sort.php");
		?>
	
	</div>
</div>
</div>
</body>	
</html>   