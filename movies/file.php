<!DOCTYPE HTML>
<?php include('../uni/db_connect.php');  ?>
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
	<link rel="stylesheet" type="text/css" href="file_styles.css">
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
	<div id="info">
	<?php
     if(isset($_GET["ID"])) $ID=$_GET["ID"]; 
     else exit("Error - No serie selected."); 
	    $query="SELECT * FROM `Main` WHERE `Indexer`='$ID'";
		$result=mysqli_query($VID_MOVIES, $query);
		while($row=mysqli_fetch_assoc($result))
		{
		$index=$row["Indexer"];
		$title= $row["Search_Index"];
		$other_titles= $row["Other_Titles"];
		$subgenre= $row["Subgenre"];
		$year=$row["Year"];
		$directors= $row["Directors"];
		$actors= $row["Actors"];
		$description= $row["Description"];
	    }
		echo '
		     <h1>'.$title. ' with English Subtitles</h1>
			 <h2>Movie Trailer</h2>

			 <div id="video_container"><video controls poster="/movies/foto/'.$row["Indexer"].'.jpg'.'">
  			 <source src="'.$row["Trailer"].'.mp4" type="video/mp4">
	  		 Your Browser does not support HTML 5 techology :(.
  			 </video>
		     </div>

			 <div id="tabs_info">
			 <h3> If you want to buy this movie, contact us in the <a href="">contact form </a>. </h3>
		     <ul>
			 <li> <span> Other Titles: </span> '.$other_titles.' </li>
			 <li> <span> Production Year: </span> '.$year.' </li>
			 <li> <span>Genre: </span>' .$subgenre.' </li>
			 <li> <span> Directors: </span> '.$directors.' </li>
			 <li> <span> Actors: </span>'.$actors.' </li>
			 </ul>
			 </div>

			 <div id="description"><p itemprop="description"><span>Synopsis:</span><br> '.$description.'</p></div>'
		   ?>
		   </div>
	</div>
  </body>
  </html>
