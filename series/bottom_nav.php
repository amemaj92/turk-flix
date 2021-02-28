<?php
    //The bottom nav is divided into sets, each with [$nav_pages_per_set] pages at a time. 
    //Example: Set=1 and $nav_pages_per_set=5. Then bottom nav will be: << | 1 | 2 | 3 | 4 | 5 | >>
    //A backward and forward arrow allow the navigation between theses sets. 
    //Pages that fall beyond the [$last_page_with_content] will be displayed as greyed out (by using a .greyed_out css class) and won't be clickable, 
    //while the current page (given by the variable [$page]) will be displayed differently  by using a .current css class. 
    
    function outputBottomNav($set_number, $current_page, $pages_per_set, $last_page_with_content)
    {
        echo '<div id="bottom_nav">';
        $starting_page= ($set_number-1)*$pages_per_set+1;

        //Previous Set Button (&#60;&#60; stands for "<<" in html)
        if($starting_page!=1) echo '<li><a href = "index_series.php?page=' . ($starting_page-$pages_per_set). '">  	&#60;&#60; </a></li>';
        else  echo '<li class = "greyed_out"><a href = ""> 	&#60;&#60; </a></li>';
        //Main Part
        for($mypage = $starting_page; $mypage<$starting_page + $pages_per_set; $mypage++) 
        {  
            if($mypage > $last_page_with_content) {echo '<li class = "greyed_out"><a href = "">' . $mypage . ' </a></li>';}
            elseif($mypage == $current_page) {echo '<li class = "current"><a href = "index_series.php?page=' . $mypage . '">' . $mypage . ' </a></li>';} 
            else  {echo '<li><a href = "index_series.php?page=' . $mypage . '">' . $mypage . ' </a></li>'; }
        } 
        //Next Set Button (&#62;&#62; stands for ">>" in html)
        if ($mypage > $last_page_with_content) {echo '<li class = "greyed_out"><a href = ""> &#62;&#62; </a></li>';}
        else {echo '<li><a href = "index_series.php?page=' . $mypage . '">  &#62;&#62; </a></li>'; }
        echo '</div>';
    }
    

    global $page; 
    $nav_pages_per_set=5;

    //define total number of results you want per page  
    global $results_per_page;  

    //find the total number of results stored in the database  
    $number_of_result = mysqli_num_rows(mysqli_query($VID_SERIES, "SELECT * FROM Main"));  
    $total_pages = ceil ($number_of_result / $results_per_page);

    //First determine the set in which the $page belongs
    $set_of_current_page = max(1,ceil($total_pages / $nav_pages_per_set)); //lowest limit is 1

    echo "$set_of_current_page, $page, $nav_pages_per_set, $total_pages";
    //Output the Bottom nav by supplying the right arguments to the function
    outputBottomNav($set_of_current_page, $page, $nav_pages_per_set, $total_pages);


    
?>
