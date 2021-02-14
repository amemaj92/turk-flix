<?php

include_once("sort_functions.php");
//Setting Sort variables. 
$Sort_Col; $Sort_ASC_DESC; 
//Initial Value of Sorting variable $sort_key; 
if(isset($_POST["Sort"])) $sort_key = $_POST["Sort"];		//Post value of Sort key has precedence
elseif(isset($SESSION["Sort"])) $sort_key=$SESSION["Sort"]; //Then get value of sort key saved in session
else $sort_key="def";  										//Otherwise set to default value. 
setSortColumns ($sort_key); 
saveSortKeyInSession ($sort_key);
