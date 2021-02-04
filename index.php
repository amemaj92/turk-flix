<!DOCTYPE HTML>

<?php 
    /*----report and show all the php errors----*/
    	error_reporting(E_ALL);
      ini_set('display_errors', 1);


    /*----include the database conection----*/  
      include_once("uni/db_connect.php");

    /*---. Declaring the variables. Find  what sort of browser the visitor is using. 
    This is conteined in global variable $_SERVER, find the operating system through the function GetOS() in Uni_Functions, 
    and find  if the user is in a mobile device. ----*/  
    $user_agent=$_SERVER['HTTP_USER_AGENT'];
    $OS_Platform=GetOS();
    $IsMobile=IsMobile();

?>

<html lang="en">

<head>
    <!-- Specifies the character encoding for the HTML document. Title and meta tags section -->
    <meta charset="utf-8"> 
    <title>Watch turkish series and movies</title>	
	<meta name="description" content="Web page to watch turkish series and movies with english subtlites">
	<meta name="keywords" content="turkish series, turkish movies, english subtitles">
	<meta name="author" content="Alketa Memaj"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    
    <link rel="stylesheet" type="text/css" href="home_styles.css">
    <link rel="stylesheet" type="text/css" href="uni_styles.css">

</head>
  
<body>

<!-- Create header section that has the navigation header menu and the logo of the page -->
<div id="header">
    <div id="header_upper_strip">
        <div id="header_main">
           <img id="logo" src="images/logo.png" alt="Turkishseriesandmovies logo">
                <div id="main_nav">
                  <a href="index.php" class="current">Home</a>
                  <a href="series/index_series.php">Series</a>
                  <a href="movies/index_movies.php">Movies</a>
                  <a href="premium/premium.php">Premium</a>
               </div>
         </div>
     </div>

</div>


<!-- Create introduction section that has the what we offer part and the tutorial part of the page -->
<div id="introduction"> 
 <!-- Create introwrapper section that has the what we offer part and the tutorial and video section that has the tutorial -->       
    <div id= "intro_wrapper">
             <div id="offered_categories">
               <h1> What we offer</h1>
                 <ul>
                  <li>Turkish series with english subtitles</li> 
                   <li>Free acces for all folks</li>
                   <li>Suport for mobile and tablet devices</li>
              

            
                   <li>Turkish movies with english subs</li>
                    <li>Cheap Adfree Premium Service</li>
                    <li>Frequent and regular updates</li>
                </ul> 
            </div>  
     </div>


    <div id="tutorial_and_videos_section">
         <h1>Tutorial: How to watch a video</h1>
             <div id="frame_wrapper">
                <div id="frame_container">
                  <iframe id="tutorial" src=""></iframe>   
                </div>   
             </div>
      </div>

</div>


<!-- Create content section that has the part of new series and the part of new movies that we have added -->
<div id="content">
    <div id="news_wrapper">

         <div id="new_series">
               <?php FcbSeriesEcho(""); ?>
              <h2>New updates from the Turkish Series</h2>  
                  <ul id="new_series_nav">
                    <li class="current">1</li><li>2</li><li>3</li>
                   </ul>
     
           <div id="series_list">
            <?php
           /*-- Use mysql functions: mysqli_query(…) and mysqli_fetch_array(…) 
           to execute a sql query to take the data from the database and
           than to take a row array from the query result set.--*/
           $query="SELECT * FROM `Main` ORDER BY `Last_Update` DESC, `Rank` DESC LIMIT 24";
           $result=mysqli_query($VID_SERIES, $query);
           while($row=mysqli_fetch_assoc($result)) {
            $Last_Episode_Part_array=($row["Last_Episode"]);
            $title_str=($row["Search_Index"]);
            $anchor_href="/series/file/$row[Indexer]";
            $img_src="series/foto/thumbs/".$row["Indexer"].".jpg";
              echo '<li> <a href="'.$anchor_href.'"> <img src="'.$img_src.'" alt="" />
                        <p>'.$title_str.'</p>
                        <p><span>Last Update on:</span> '.date_format(date_create($row["Last_Update"]), "d.m.Y").'</p> </a>
                   </li>';
              } 
          ?>
         </div>
        </div>
     
      <div id="new_movies">
      <?php FcbMoviesEcho(""); ?>	
        <h2>New updates from the Turkish Movies</h2>
             <ul id="new_movies_nav">
               <li class="current">1</li><li>2</li><li>3</li>
             </ul>

            <div id="movies_list">
              <?php
               /*-- Use mysql functions: mysqli_query(…) and mysqli_fetch_array(…) 
               to execute a sql query to take the data from the database and
                than to take a row array from the query result set.--*/
                $query_movies="SELECT * FROM `main` ORDER BY `Last_Update` DESC LIMIT 24";
                $result_movies=mysqli_query($VID_MOVIES, $query_movies);
                while($row_movies=mysqli_fetch_assoc($result_movies)) {
                $title_str_movies=($row_movies["Search_Index"]);
                $anchor_href_movies="/movies/file/$row[Indexer]";
                $img_src_movies="/movies/foto/thumbs/".$row["Indexer"].".jpg";
                 echo '<li> <a href="'.$anchor_href_movies.'"> <img src="'.$img_src_movies.'" alt="" />
                        <p>'.$title_str_movies.'</p>
                        <p><span>Last Update on:</span> '.date_format(date_create($row_movies["Last_Update"]), "d.m.Y").'</p> </a>
                   </li>';
                  }
             ?>
           </div>
       </div>     
 </div> 
</div>  

</body>
</html>