<?php
    //The bottom nav is divided into sets, each with [$nav_pages_per_set] pages at a time. A backward and forward arrow allow the navigation between theses sets. 
    //Pages that fall beyond the $last_page will be displayed as greyed out (by using a .greyed_out css class), 
    //while the current page (given by the variable [$page]) will be displayed differently  by using a .current css class. 
    global $page; 
    $nav_pages_per_set=5;

    //define total number of results you want per page  
    global $results_per_page = 4;  

    //find the total number of results stored in the database  
    $number_of_result = mysqli_num_rows(mysqli_query($VID_SERIES, "SELECT * FROM Main"));  
    $total_pages = ceil ($number_of_result / $results_per_page);

    //First determine the set in which the $page belongs
    $set_of_current_page = int_val($total_pages / $nav_pages_per_set); 
    echo '<div id="bottom_nav">';
    //display the link of the pages in URL  
    //Go back error. 
    for($page = 1; $page<= $number_of_page; $page++) {  
    echo '<li><a href = "index_series.php?page=' . $page . '">' . $page . ' </a></li>';   
    } 
    echo '</div>';
?>
