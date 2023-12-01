<?php
require '../../../PHP/Functions.php';



$conn = connect(); 
$name = mysqli_real_escape_string($conn, $_POST['name']); 
$sql = "SELECT p.id, p.title, p.PRIX, p.Quantity, p.image_file, c.Category_name 
        FROM products p 
        INNER JOIN category c ON c.id = p.id_category 
        WHERE (p.title LIKE '%$name%' OR p.title LIKE '%$name' OR p.title LIKE '$name%') 
        ORDER BY p.title";

$query = mysqli_query($conn, $sql);

$data = "<table>
 <thead>
<tr>
    <td>Image Product</td>
    <td>Title</td>
    
    <td>Price</td>
    <td>Category</td>
    <td>Quantity</td>
    <td>Actions</td>
</tr>
</thead>";

while ($row = mysqli_fetch_assoc($query)) {
    $data .= "<tr";

    if ($row['Quantity'] <= 0) {
        $data .= " class=\"red_row\"";
    }
    
    $data .= ">
    <td><img src=\"../../../product_images/{$row['image_file']}\" alt=\"\" height=\"50px\" width=\"50px\"></td>
    <td>{$row['title']}</td>
    <td>{$row['PRIX']}</td>
    <td>{$row['Category_name']}</td>
    <td>{$row['Quantity']}</td>

   
   
    <td>
        <a href=\"modify\\modify.php?var={$row['id']}\">
            <svg viewBox=\"0 0 48 48\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                <g id=\"SVGRepo_bgCarrier\" stroke-width=\"0\"></g>
                <g id=\"SVGRepo_tracerCarrier\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></g>
                <g id=\"SVGRepo_iconCarrier\">
                    <rect width=\"48\" height=\"48\" fill=\"white\" fill-opacity=\"0.01\"></rect>
                    <path d=\"M42 26V40C42 41.1046 41.1046 42 40 42H8C6.89543 42 6 41.1046 6 40V8C6 6.89543 6.89543 6 8 6L22 6\" stroke=\"#000000\" stroke-width=\"4\" stroke-linecap=\"round\" stroke-linejoin=\"round\"></path>
                    <path d=\"M14 26.7199V34H21.3172L42 13.3081L34.6951 6L14 26.7199Z\" fill=\"#2F88FF\" stroke=\"#000000\" stroke-width=\"4\" stroke-linejoin=\"round\"></path>
                </g>
            </svg>
        </a>
    </td>
</tr>";


}

$data .= "</table>";
echo $data;
?>
