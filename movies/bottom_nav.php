<?php
    global $page; 
    echo '<div id="bottom_nav">';
 //display the link of the pages in URL  
    for($page = 1; $page<= $number_of_page; $page++) {  
    echo '<li><a href = "index_movies.php?page=' . $page . '">' . $page . ' </a></li>';   
    } 
    echo '</div>';
?>