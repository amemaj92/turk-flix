<?php

include_once("sort_functions.php");
//Initial Value of Sorting variable $sort_key; 
if(isset($_POST["simple_search"]) or isset($_POST["reset_search_string"])) 
{ 
        //Clearing previous sort key from session and setting it to default
        clearSortKeyFromSession();
        $sort_key = "def";
}
elseif(isset($_POST["Sort"])) $sort_key = $_POST["Sort"];		//Post value of Sort key has precedence
elseif(isset($_SESSION["Sort"])) $sort_key=$_SESSION["Sort"]; //Then get value of sort key saved in session
else $sort_key="def";  										//Otherwise set to default value. 
setSortColumns ($sort_key); 
saveSortKeyInSession ($sort_key);

?>