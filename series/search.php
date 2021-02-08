<?php
        include_once("../uni/db_connect.php"); 
?>
 <form action="" method="post">
<input type="text" name="Title">
<input type="submit" name="submit" value="Search">
</form>

<?php  
        if(isset($_POST["Title"])) 
        {
         $search_value=$_POST["Title"];
        $sql="select * from Main where Search_Index like '%$search_value%'";

        $result=mysqli_query($VID_SERIES, $sql);

        while($row=mysqli_fetch_assoc($result)){
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
            }      } 

?>
