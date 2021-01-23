<?php 

 /*----PHP Scripts And Variables----*/
    	error_reporting(E_ALL);
    	ini_set('display_errors', 1);
    //----Scripts   
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

echo '
<!DOCTYPE HTML>

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
	<link rel="stylesheet" type="text/css" href="../uni/uni_style.css">
	<link rel="stylesheet" type="text/css" href="../series/index_style.css">
	<!-- +++ Own Scripts +++ -->
        <script type="text/javascript" src="/uni/Core.js"></script>
        <script type="text/javascript" src="index.js"></script>
	
	<!-- +++ Outside Scripts +++ -->
    </head>
    <body>	    
        <!-- +++ Universal Header and Nav  ++ Serving SubCategory as Input to Scripts+++ -->';
        HeaderAndNavEcho("Series"); 
        echo '
             
	<div id="content">
	    <div id="wrapper">
		<h1>Turkish Series with English Subtitles</h1>';
		
		/*The Sort and search section*/
		echo '
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
			<form  action="/series/'.$Sort.'" method="POST">
				<input type="hidden" name="Req_Type" value="simple_search">
				<input type="text" name="search_string" placeholder="Title, actor, director">
				<input type="submit" value="Search">
			</form>
			<a href="#" id="avd_search_toggler">Advanced Search</a> 
		</div>
		<div id="adv_search_form">			
			<form action="/series/'.$Sort.'" method="POST">
			<input type="hidden" name="Req_Type" value="advanced_search">
			<fieldset><legend>Advanced Search</legend>
				<p>Note: When entering multiple data on one field, separate them with a comma.</p>
				<ul>
					<li>
					<label for="title">Title:</label>
					<input type="text" id="titulli" name="Title" placeholder="Kara Sevda">
					</li>
					
					<li>
					<label for="director">Director:</label>
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
		';	
		
		echo '<div id="nenkategorite">';
		echo '<form action="/series/'.$Sort.'" method="POST"> <input type="hidden" name="Req_Type" value="subgenre_filter">';		
		echo '<ul id="lista_nenkategorive">';	
		$subgenre_array=SeriesSubcategoriesArrayEcho();
		$selected_subgenre_array=array(); 
		if(isset($_POST["subgenre"]))  $selected_subgenre_array=$_POST["subgenre"];
		for($i=1; $i<count($subgenre_array); $i++) 
		{
			$checked=""; //make checked if checked. 
			$class="";  //change li class to "checked" if checked
			
			for($j=0; $j<count($selected_subgenre_array); $j++) 
			{
				if($subgenre_array[$i]==$_POST["subgenre"][$j]) 
				{
					$checked="checked"; $class="checked"; break;
				} 
				else continue;
			}
		echo "<li class='$class'><input type='checkbox' name='subgenre[]' id='checkbox".$i."' value='$subgenre_array[$i]' $checked><span>$subgenre_array[$i]</span></li>";}	
		
		echo '</ul>';
		echo '<div><input type="submit" name="submit" value="Filter"> 
		<a href="/series/">Reset</a></div></form></div>';

	  	echo '<ul id="lista_seriale">';

		//Script for series list generation
		$incl_return=include('../../protected_scripts/series_list_and_search_script.php');
		
		//Window Range Calculation 
		if($Window%5==0) $window_range=intval($Window/5);
		else $window_range=intval($Window/5)+1;
	 	echo '</ul>';
	 	
	 	echo '
	 	<ul id="bottom_nav"><li><a href="';
	 	//Numrat e navigacionit do te varen nga Current Window.
	 	if($window_range>1) echo '/series/'.(($window_range-1)*5).'">';
	 	else {echo '#" class="greyed">';}
	 	echo '&lt;&lt;</a></li>
	 	
	 	<li><a href="';
	 	//Check if window is within range
	 	if(((($window_range-1)*5)+1)>$num_windows) echo '#" class="greyed"';
	 	else {echo '/series/'.$Sort.'/'.((($window_range-1)*5)+1).'"'; if(((($window_range-1)*5)+1)==$Window) echo ' class="current"';}
	 	echo '>'.((($window_range-1)*5)+1).'</a></li>
	 	
	 	<li><a href="';
	 	//Check if window is within range
	 	if(((($window_range-1)*5)+2)>$num_windows) echo '#" class="greyed"';
	 	else {echo '/series/'.$Sort.'/'.((($window_range-1)*5)+2).'"'; if(((($window_range-1)*5)+2)==$Window) echo ' class="current"';}
	 	echo '>'.((($window_range-1)*5)+2).'</a></li>
	 	
	 	<li><a href="';
	 	//Check if window is within range
	 	if(((($window_range-1)*5)+3)>$num_windows) echo '#" class="greyed"';
	 	else {echo '/series/'.$Sort.'/'.((($window_range-1)*5)+3).'"'; if(((($window_range-1)*5)+3)==$Window) echo ' class="current"';}
	 	echo '>'.((($window_range-1)*5)+3).'</a></li>
	 	
	 	<li><a href="';
	 	//Check if window is within range
	 	if(((($window_range-1)*5)+4)>$num_windows) echo '#" class="greyed"';
	 	else {echo '/series/'.$Sort.'/'.((($window_range-1)*5)+4).'"'; if(((($window_range-1)*5)+4)==$Window) echo ' class="current"';}
	 	echo '>'.((($window_range-1)*5)+4).'</a></li>
	 	
	 	<li><a href="';
	 	//Check if window is within range
	 	if(((($window_range-1)*5)+5)>$num_windows) echo '#" class="greyed"';
	 	else {echo '/series/'.$Sort.'/'.((($window_range-1)*5)+5).'"'; if(((($window_range-1)*5)+5)==$Window) echo ' class="current"';}
	 	echo '">'.((($window_range-1)*5)+5).'</a></li>
	 	
	 	<li><a href="';
	 	//Check if window is within range
	 	if(((($window_range-1)*5)+6)>$num_windows) echo '#" class="greyed"';
	 	else echo '/series/'.$Sort.'/'.((($window_range-1)*5)+6);
	 	echo '">&gt;&gt;</a></li>
	 	
	 	</ul>
	 	
		</div>';
		
	    //Kontrolli nese eshte futur manualisht nje dritare ne url. 
	    if($incl_return!=1) echo "<p>$incl_return</p>";
	    else if ($num_windows==0) echo "<p>Error - No result matches the criteria.</p>";
	    else if($Window>$num_windows) echo "<p>Error - This Window is too big. Try a smaller number.</p>";
		
    	    echo '</div>';
    	    echo '
    </body>	
</html>';
?>   
