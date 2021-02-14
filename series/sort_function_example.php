<?php

function set_Sort($sort_key)
{
	//Use Example: 
	//setSort("def");
	//setSort("o_n");
	if($sort_key == "def") 	  {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC"; }
	else if($sort_key=="a_z") {$Sort_Col="Indexer"; $Sort_ASC_DESC="ASC"; }
	else if($sort_key=="z_a") {$Sort_Col="Indexer"; $Sort_ASC_DESC="DESC";}
	else if($sort_key=="n_o") {$Sort_Col="Year2"; $Sort_ASC_DESC="DESC"; $Sort_Col2="Indexer"; $Sort_ASC_DESC2="ASC";} //n_o="New to Old"
	else if($sort_key=="o_n") {$Sort_Col="Year2"; $Sort_ASC_DESC="ASC"; $Sort_Col2="Indexer"; $Sort_ASC_DESC2="ASC";} //o_n="Old to New"
	else {$Sort_Col="Rank"; $Sort_ASC_DESC="DESC";}
}

?>
