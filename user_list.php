<?php 
	require('config.php');

			
	$sql = "SELECT * FROM user_login";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	       	//print_r($row);
	        echo "id: " . $row["id"]. " || Name: " . $row["Name"]. " || Email: " . $row["Email"]." ||  Contact: ".$row['Contact']. " || Location: " . $row["Location"] ." || Description: " . $row["Description"] ." || Category: " . $row["Category"]." || Website: " . $row["Website"]. " || Password: " . $row["Password"]."<br>";
		}
	} 
	else
	{
	    echo "0 results";
	}
	mysqli_close($conn);

?>