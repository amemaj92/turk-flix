<?php
        include_once("../uni/db_connect.php"); 



    if(isset($Sort)) 
    {
		//We do it this way to not show the name of the columns in DB for security reasons
		if ($Sort=="default") {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC"; }
		else if($Sort=="def") {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC"; }
		else if($Sort=="a_z") {$Sort_Col="Indexer"; $Sort_ASC_DESC="ASC"; }
		else if($Sort=="z_a") {$Sort_Col="Indexer"; $Sort_ASC_DESC="DESC";}
		else if($Sort=="n_o") {$Sort_Col="Year2"; $Sort_ASC_DESC="DESC"; $Sort_Col2="Indexer"; $Sort_ASC_DESC2="ASC";} //n_o="New to Old"
		else if($Sort=="o_n") {$Sort_Col="Year2"; $Sort_ASC_DESC="ASC"; $Sort_Col2="Indexer"; $Sort_ASC_DESC2="ASC";} //o_n="Old to New"
		else {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC";}
    }
    else {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC";} 

	if(isset($_POST["simple_search"]))
	{
		//define total number of results you want per page  
		$results_per_page = 4;  
		$search_string=""; 
		if(isset($_POST["search_string"]) && !empty($_POST["search_string"])) $search_string=$_POST["search_string"];
		else {return("No data input. Please input some data to search for and try again.");}
		
		//Fshirja e hapesirave rrotull presjes dhe copetimi i stringut te kerkimit me baze presjen. 
		$clean_search_string = trim(preg_replace('/\s\s+/', ' ', $search_string));
		if(substr_count($clean_search_string, ',')!=0) 
		{
			$clean_search_string=str_replace(" , ", ",", $clean_search_string);	
			$clean_search_string=str_replace(" ,", ",", $clean_search_string);	
			$clean_search_string=str_replace(",", " ", $clean_search_string);	
		}
		$search_words_array=explode(",", $clean_search_string);
	
		for($i=0; $i<count($search_words_array); $i++)
		{
			if(strlen($search_words_array[$i])<4) {$search_string=$search_string."+".$search_words_array[$i]." ";}
			else $search_string=$search_string."+".$search_words_array[$i]."* ";
		}
		
		
		$query="SELECT * FROM Main WHERE MATCH(`Search_Index`, `Other_Titles`, `Subgenre`, `Year1`, `Year2`, `Directors`, `Actors`) 
		AGAINST('$search_string' IN BOOLEAN MODE) ORDER BY $Sort_Col $Sort_ASC_DESC";
		$result=mysqli_query($VID_SERIES, $query); 
		    
	// Printing Output Data
     //define total number of results you want per page  
	 $results_per_page = 4;  

    //find the total number of results stored in the database  
       $number_of_result = mysqli_num_rows($result);  

    //determine the total number of pages available  
       $number_of_page = ceil ($number_of_result / $results_per_page); 
 
     //determine which page number visitor is currently on  
       if (!isset ($_GET['page']) ) {  
          $page = 1;  } 
       else {  $page = $_GET['page'];  }     

       //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page; 

        
		
		        /*-- Use mysql functions: mysqli_query(…) and mysqli_fetch_array(…) 
		        to execute a sql query to take the data from the database and
		        than to take a row array from the query result set.--*/
		
				$query_2=$query. "LIMIT $results_per_page OFFSET $page_first_result";   
				$result_2=mysqli_query($VID_SERIES, $query_2);
				while($row=mysqli_fetch_assoc($result_2)) {
					$Last_Episode_Part_array=($row["Last_Episode"]);
					$genre=($row["Subgenre"]);
					$title_str=($row["Search_Index"]);
					$last_episode=($row["Last_Episode"]);
					$anchor_href="file/$row[Indexer]";
					$img_src="foto/thumbs/".$row["Indexer"].".jpg";
					  echo '<li> <a href="'.$anchor_href.'"> <img src="'.$img_src.'" alt="" />
								<p>'.$title_str.'</p>
								<p>Genres:'.$genre.'</p>
								<p> <span>Last Episode: '.$last_episode.' </span></p></a>
						   </li>';
				   }
				   
		}
		
		/*
        else if((isset($_POST["advanced_search"]))&&(isset($_POST["Title"]))&&false)
		
	
		//------------Marrja e inputeve dhe pastrimi i tyre nga hapesirat boshe rrotull presjes. -------------------//
	{
			$temp=$_POST["Title"];
		 
	    $query="SELECT * FROM Main WHERE Search_Index like '%$temp%'";
		$result=mysqli_query($VID_SERIES, $query);	
		while($row=mysqli_fetch_assoc($result)) {
			$Last_Episode_Part_array=($row["Last_Episode"]);
					$genre=($row["Subgenre"]);
					$title_str=($row["Search_Index"]);
					$last_episode=($row["Last_Episode"]);
					$anchor_href="file/$row[Indexer]";
					$img_src="foto/thumbs/".$row["Indexer"].".jpg";
					echo '<li> <a href="'.$anchor_href.'"> <img src="'.$img_src.'" alt="" />
					<p>'.$title_str.'</p>
					<p>Genres:'.$genre.'</p>
					<p> <span>Last Episode: '.$last_episode.' </span></p></a>
			   </li>';
				   }

				}
				*/

	else 
	{
		//Printing Output data code
     //define total number of results you want per page  
     $results_per_page = 4;  

    //find the total number of results stored in the database  
       $query = "select *from Main";  
       $result = mysqli_query($VID_SERIES, $query);  
       $number_of_result = mysqli_num_rows($result);  

    //determine the total number of pages available  
       $number_of_page = ceil ($number_of_result / $results_per_page); 
 
     //determine which page number visitor is currently on  
       if (!isset ($_GET['page']) ) {  
          $page = 1;  } 
       else {  $page = $_GET['page'];  }     

       //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page; 

        
		
		        /*-- Use mysql functions: mysqli_query(…) and mysqli_fetch_array(…) 
		        to execute a sql query to take the data from the database and
		        than to take a row array from the query result set.--*/

				$query_2="SELECT * FROM `Main` ORDER BY $Sort_Col $Sort_ASC_DESC LIMIT $results_per_page OFFSET $page_first_result";   
				$result_2=mysqli_query($VID_SERIES, $query_2);

				while($row=mysqli_fetch_assoc($result_2)) {
					$Last_Episode_Part_array=($row["Last_Episode"]);
					$genre=($row["Subgenre"]);
					$title_str=($row["Search_Index"]);
					$last_episode=($row["Last_Episode"]);
					$anchor_href="file/$row[Indexer]";
					$img_src="foto/thumbs/".$row["Indexer"].".jpg";
					  echo '<li> <a href="'.$anchor_href.'"> <img src="'.$img_src.'" alt="" />
								<p>'.$title_str.'</p>
								<p>Genres:'.$genre.'</p>
								<p> <span>Last Episode: '.$last_episode.' </span></p></a>
						   </li>';
				   }
	}
			
	?>
	</div>
	 
    <div id="bottom_nav">

	<?php

     //display the link of the pages in URL  
        for($page = 1; $page<= $number_of_page; $page++) {  
		echo '<li><a href = "index_series.php?page=' . $page . '">' . $page . ' </a></li>';   
	    } 
	?>