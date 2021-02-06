<!DOCTYPE HTML>
<?php 

 /*----PHP Scripts And Variables----*/
    	error_reporting(E_ALL);
    	ini_set('display_errors', 1);
 
    session_start();
	
    //Variabli Sort per radhitjen e rezultatit
    if(isset($_POST["Sort"])) {$Sort=$_POST["Sort"]; $_SESSION["Sort"]=$Sort;}
    elseif(isset($_SESSION["Sort"]))  {$Sort = $_SESSION["Sort"];}
	else {$Sort="default";}

  ?>
<html lang="en">
    <head>
        
	</head>

      	<div id="sort_form">
			<h2>Choose a Sorting Option:</h2>
			<form method="POST">
				<select name = "Sort">
				  <option value="def" <?php if($Sort=="def") echo 'selected="selected"'; ?>>Default</option>
				  <option value="a_z" <?php if($Sort=="def") echo 'selected="selected"'; ?>>Alphabetic(A-Z)</option>
				  <option value="z_a" <?php if($Sort=="def") echo 'selected="selected"'; ?>>Alphabetic Inv (Z-A)</option>
				  <option value="n_o" <?php if($Sort=="def") echo 'selected="selected"'; ?>>Date(Newer Titles First)</option>
				  <option value="o_n" <?php if($Sort=="def") echo 'selected="selected"'; ?>>Date Inv(Older Titles First)</option>
				</select>
				<input type="submit" value="Sort">
			</form>
		</div>
		
</div>
</body>	
</html>   