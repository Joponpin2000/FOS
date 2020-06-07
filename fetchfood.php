<?php
$connect = mysqli_connect("localhost", "root", "", "fos");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM foods
	WHERE foodname LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM foods ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '';
	while($row = mysqli_fetch_array($result))
	{
		$food_id= $row['id'];
		$output .= '
			<tr style="width:100%;background: white; border:1px solid #7386D5;">
				<td style="border-bottom:solid 1px #7386D5; padding:10px;"><a href="menu.php?id=' . $food_id . '" style="text-decoration:none; font-weight:bold; color: #7386D5; padding:5px;">'.$row["foodname"].'</a></td>
				
			</tr>
		';
	}
	echo $output;
}
else
{
	echo '<p style="padding:10px; font-weight:bold; color: #7386D5;">Not available</p>';
}
?>