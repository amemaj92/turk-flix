<?php
function setSortColumns ($sort_key)
{
	global $Sort_Col, $Sort_ASC_DESC; 
	//Use Example: 
	//setSortColumns("def");
	//setSortColumns("o_n");
	if ($sort_key == "def")    {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC"; }
	elseif ($sort_key=="a_z")  {$Sort_Col="Indexer"; $Sort_ASC_DESC="DESC";}
	elseif ($sort_key=="n_o")  {$Sort_Col="Year2"; $Sort_ASC_DESC="DESC";} //n_o="New to Old"
	elseif ($sort_key=="o_n")  {$Sort_Col="Year2"; $Sort_ASC_DESC="ASC";} //o_n="Old to New"
	else  {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC";}
}

function saveSortKeyInSession ($sort_key)
{
	$_SESSION["Sort"] = $sort_key;
}

function clearSortKeyFromSession()
{
	unset($SESSION["Sort"]);
}
?>