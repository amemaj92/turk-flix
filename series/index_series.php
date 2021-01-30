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
           
    //Cler the SESSION POST array saved values when clicking on the Subcategory link. 
    if(!isset($_GET["Sort"]) && !isset($_GET["Wind"])) {unset($_SESSION['post']);}

    //Variabli Sort per radhitjen e rezultatit
    if(isset($_GET["Sort"])) {$Sort=$_GET["Sort"];}
    else {$Sort="default";}

    //Dritarja per kuantizimin e listes se serialeve
    if(isset($_GET["Wind"])) {$Window=intval($_GET["Wind"]);}
    else $Window=1; 

    //Updating the $_SESSION['post'] superglobal for the next or previous nav clicks (specific post variables should be deleted with functions)
    if(isset($_POST) && count($_POST)) {$_SESSION['post'] = $_POST;}
    if(isset($_SESSION['post']) && count($_SESSION['post'])) {$_POST = $_SESSION['post'];}

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
                  <a href="../premium/info.php">Premium</a>
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
			<form action="" method="GET">
				<select>
				  <option value="def"';if($Sort=="def") echo'selected="selected"'; echo'>Default</option>
				  <option value="a_z"';if($Sort=="a_z") echo'selected="selected"'; echo'>Alphabetic(A-Z)</option>
				  <option value="z_a"';if($Sort=="z_a") echo'selected="selected"'; echo'>Alphabetic Inv (Z-A)</option>
				  <option value="n_o"';if($Sort=="n_o") echo'selected="selected"'; echo'>Date(Newer Titles First)</option>
				  <option value="o_n"';if($Sort=="o_n") echo'selected="selected"'; echo'>Date Inv(Older Titles First)</option>
				</select>
				<input type="submit" value="Sort">
			</form>
		</div>
		
		<div id="simple_search_form">
			<h2>Search for something general:</h2>
			<form  action="'.$Sort.'" method="POST">
				<input type="hidden" name="Req_Type" value="simple_search">
				<input type="text" name="search_string" placeholder="Title, actor, director">
				<input type="submit" value="Search">
			</form>
			<a href="#" id="avd_search_toggler">Advanced Search</a> 
		</div>
		<div id="adv_search_form">			
			<form action="'.$Sort.'" method="POST">
			  <input type="hidden" name="Req_Type" value="advanced_search">
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
		
		/*-- Use mysql functions: mysqli_query(…) and mysqli_fetch_array(…) 
		to execute a sql query to take the data from the database and
		than to take a row array from the query result set.--*/
		$query="SELECT * FROM `Main` ORDER BY `Last_Update` DESC, `Rank` DESC LIMIT 24";
		$result=mysqli_query($VID_SERIES, $query);
		while($row=mysqli_fetch_assoc($result)) {
		 $Last_Episode_Part_array=($row["Last_Episode"]);
		 $genre=($row["Subgenre"]);
		 $title_str=($row["Search_Index"]);
		 $last_episode=($row["Last_Episode"]);
		 $anchor_href="/series/file/$row[Indexer]";
		 $img_src="foto/thumbs/".$row["Indexer"].".jpg";
		   echo '<li> <a href="'.$anchor_href.'"> <img src="'.$img_src.'" alt="" />
					 <p>'.$title_str.'</p>
					 <p>Genres:'.$genre.'</p>
					 <p> <span>Last Episode: '.$last_episode.' </span></p>
				</li>';
		   } 
		 //Window Range Calculation
		   



		?>
	</div>

	 
   
</div>
</div>
</body>	
</html>   
