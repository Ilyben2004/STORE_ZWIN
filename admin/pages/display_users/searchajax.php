<?php
require '../../../PHP/Functions.php';



$conn = connect(); 
$name = mysqli_real_escape_string($conn, $_POST['name']); 
$sql = "SELECT * 
        FROM users
      
        WHERE (FN LIKE '%$name%' OR FN LIKE '%$name' OR FN LIKE '$name%') OR 
         (LN LIKE '%$name%' OR LN LIKE '%$name' OR LN LIKE '$name%') OR
         (USERNAME LIKE '%$name%' OR USERNAME LIKE '%$name' OR USERNAME LIKE '$name%')
        ORDER BY FN";

$query = mysqli_query($conn, $sql);

$data = " <table>
 <thead>
<tr>
    <td>First Name </td>
    
    <td>Last Name</td>
    <td>Username </td>
    <td>Email</td>
</tr>
</thead>";

while ($row = mysqli_fetch_assoc($query)) {
   

  
    
    $data .= "<tr>
    <td>{$row['FN']}</td>
    <td>{$row['LN']}</td>
    <td>{$row['USERNAME']}</td>
    <td>{$row['EMAIL']}</td>
</tr>";


}

$data .= "</table>";
echo $data;

?>
