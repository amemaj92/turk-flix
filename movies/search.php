<?php 

include_once("sort_functions.php");

function refineString($dirty_string)
{
        $clean_string = trim(preg_replace('/\s\s+/', ' ', $dirty_string));
        if(substr_count($clean_string, ',')!=0) 
        {
                $clean_string=str_replace(" , ", ",", $clean_string);	
                $clean_string=str_replace(" ,", ",", $clean_string);	
                $clean_string=str_replace(",", " ", $clean_string);	
        }
        return $clean_string;
}

function outputSeriesList($query, $database)
{
        /*-- Use mysql functions: mysqli_query(…) and mysqli_fetch_array(…) 
		        to execute a sql query to take the data from the database and
		        than to take a row array from the query result set.--*/
			   
        $result_2=mysqli_query($database, $query);
        while($row=mysqli_fetch_assoc($result_2)) {
                $genre=($row["Subgenre"]);
                $ID=($row["Indexer"]);
                $title_str=($row["Search_Index"]);
                $anchor_href="file.php?ID=$row[Indexer]";
                $img_src="foto/thumbs/".$row["Indexer"].".jpg";
                        echo '<li> <a href="'.$anchor_href.'"> <img src="'.$img_src.'" alt="" />
                                        <p>'.$title_str.'</p>
                                        <p>Genres:'.$genre.'</p>
                                        <p> <span> </span></p></a>
                              </li>';
                }
}

function saveSearchStringInSession ($input_string)
{
        $_SESSION["search_string"] = $input_string;
}

function removeSearchStringFromSession ()
{
        if (isset($_SESSION["search_string"])) unset($_SESSION["search_string"]);
}

global $page; 
global $Sort_Col, $Sort_ASC_DESC;

//Doing Search if search string is given 

if(isset($_POST["reset_search_string"]))
{       $page=1;
        removeSearchStringFromSession();
        
}

if(isset($_POST["simple_search"]))
{
        //Clearing previous sort key from session and setting it to default
        clearSortKeyFromSession();
        setSortColumns("def");
        saveSortKeyInSession("def");
        
        //Same is supposed to be done with the search string right? 
        //If you want to display more than 1 page in the pagination you need to save it in session and then set/clear it. 

        //start at page 1
        $page = 1; 
        //define total number of results you want per page  
        $results_per_page = 4;  
        $search_string=""; 
        if(isset($_POST["search_string"]) && !empty($_POST["search_string"])) $search_string=$_POST["search_string"];
        else {return("No data input. Please input some data to search for and try again.");}

        //Refining the Search String for use in the database (i.e. only keywords or search phrases separated with a komma)
        $clean_search_string = refineString($search_string);
        //Getting the keywords out of the refined string
        $search_words_array=explode(",", $clean_search_string);

        //Transforming search string in directly usable form for the search in the database
        for($i=0; $i<count($search_words_array); $i++)
        {
                //small words are not separated from what follows 
                if(strlen($search_words_array[$i])<4) {$search_string=$search_string."+".$search_words_array[$i]." ";}
                else $search_string=$search_string."+".$search_words_array[$i]."* ";
        }

        
        $query="SELECT * FROM Main WHERE MATCH(`Search_Index`, `Other_Titles`, `Subgenre`, `Year`, `Directors`, `Actors`) 
        AGAINST('$search_string' IN BOOLEAN MODE)";
        $result=mysqli_query($VID_MOVIES, $query); 
        //find the total number of results stored in the database  
        $number_of_result = mysqli_num_rows($result);  

        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page); 

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page; 

        $query_2="SELECT * FROM Main WHERE MATCH(`Search_Index`, `Other_Titles`, `Subgenre`, `Year`, `Directors`, `Actors`) 
        AGAINST('$search_string' IN BOOLEAN MODE) ORDER BY $Sort_Col $Sort_ASC_DESC LIMIT $results_per_page OFFSET $page_first_result";
        outputSeriesList($query_2, $VID_MOVIES);	

        saveSearchStringInSession($search_string);
}

elseif (isset($_SESSION["search_string"]))
{        
        //Same is supposed to be done with the search string right? 
        //If you want to display more than 1 page in the pagination you need to save it in session and then set/clear it. 

        //define total number of results you want per page  
        $results_per_page = 4;  
        $search_string=$_SESSION["search_string"];

        //Refining the Search String for use in the database (i.e. only keywords or search phrases separated with a komma)
        $clean_search_string = refineString($search_string);
        //Getting the keywords out of the refined string
        $search_words_array=explode(",", $clean_search_string);

        //Transforming search string in directly usable form for the search in the database
        for($i=0; $i<count($search_words_array); $i++)
        {
                //small words are not separated from what follows 
                if(strlen($search_words_array[$i])<4) {$search_string=$search_string."+".$search_words_array[$i]." ";}
                else $search_string=$search_string."+".$search_words_array[$i]."* ";
        }

        
        $query="SELECT * FROM Main WHERE MATCH(`Search_Index`, `Other_Titles`, `Subgenre`, `Year`, `Directors`, `Actors`) 
        AGAINST('$search_string' IN BOOLEAN MODE)";
        $result=mysqli_query($VID_MOVIES, $query); 
        //find the total number of results stored in the database  
        $number_of_result = mysqli_num_rows($result);  

        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page); 

        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page; 

        $query_2="SELECT * FROM Main WHERE MATCH(`Search_Index`, `Other_Titles`, `Subgenre`, `Year`, `Directors`, `Actors`) 
        AGAINST('$search_string' IN BOOLEAN MODE) ORDER BY $Sort_Col $Sort_ASC_DESC LIMIT $results_per_page OFFSET $page_first_result";
        outputSeriesList($query_2, $VID_MOVIES);	
}

else 
{
        //Echoing Series List for the default case. 
        //define total number of results you want per page  
        $results_per_page = 4;  

        //find the total number of results stored in the database  
        $query = "SELECT * FROM Main";  
        $result = mysqli_query($VID_MOVIES, $query);  
        $number_of_result = mysqli_num_rows($result);  

        //determine the total number of pages available  
        $number_of_page = ceil ($number_of_result / $results_per_page); 
        
        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page-1) * $results_per_page; 
        $query_2="SELECT * FROM `Main` ORDER BY $Sort_Col $Sort_ASC_DESC LIMIT $results_per_page OFFSET $page_first_result";   
        outputSeriesList($query_2,$VID_MOVIES);
        
}             
?>