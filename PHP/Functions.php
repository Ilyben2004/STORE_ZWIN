<?php  

function connect(){
    $mysqli = new mysqli('localhost', 'root', '', 'moukhliss_store');
    if($mysqli->connect_errno != 0){
       return $mysqli->connect_error;
    }else{
       $mysqli->set_charset("utf8mb4");	
    }
    return $mysqli;
 }

function get_all_cate(){
   $mysqli = connect();
   $res = $mysqli->query("select * from category ");
   if ($res->num_rows > 0){
   while($row = $res->fetch_assoc()){
      $cate[] = $row;
   }}
   
   return $cate;

 }

 function insertIntoP($title, $description, $price, $id_category,$qt,$imageName) {
   $mysqli = connect();

   if ($mysqli->connect_errno) {
       return false;
   }

   $query = "INSERT INTO products (title, DESCREPTION, prix, id_category,Quantity,image_file) VALUES (?, ?, ?, ?,?,?)";

   if ($stmt = $mysqli->prepare($query)) {
       $stmt->bind_param("ssdiis", $title, $description, $price, $id_category,$qt,$imageName);

       if ($stmt->execute()) {
           $stmt->close();
           $mysqli->close();
           return true;
       } else {
           $stmt->close();
           $mysqli->close();
           return false;
       }
   } else {
       $mysqli->close();
       return false;
   }
}



function getidbycate($category){

   $mysqli = connect();

   if ($mysqli->connect_errno) {
       return false;
   }

   $sql = "SELECT id FROM category WHERE Category_name = '$category'";
   $result = $mysqli->query($sql);
   $row = $result->fetch_assoc();
   $categoryID = $row['id'];

 return $categoryID;
 $mysqli->close();



}

function getAllProducts(){
    $mysqli = connect();
   $res = $mysqli->query("SELECT p.id, p.title, p.PRIX, p.Quantity, p.image_file, c.Category_name FROM products p INNER JOIN category c ON c.id = p.id_category  ORDER BY p.title  ");
   if ($res->num_rows > 0){
   while($row = $res->fetch_assoc()){
      $products[] = $row;
   }}
   else{
     $users=0;
   }
   return $products;

}


function getcatebyid($idcategory){

    $mysqli = connect();
 
    if ($mysqli->connect_errno) {
        return false;
    }
 
    $sql = "SELECT Category_name FROM category WHERE id = '$idcategory'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $categoryName = $row['Category_name'];
 
 return   $categoryName;
 $mysqli->close();
 
 
 
 }

 function getProductsByCategory($category){
    $mysqli = connect();
  
    $res = $mysqli->query("SELECT p.id, p.title, p.PRIX, p.Quantity, p.image_file, c.Category_name FROM products p INNER JOIN category c ON c.id = p.id_category and c.Category_name='$category' ORDER BY p.title   ");
    if ($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
       $products[] = $row;
    }} 
    return $products;
 }



 function executeSingleValueQuery($query) {
    $mysqli = connect(); 
    if ($mysqli->connect_errno) {
        
        return null;
    }

    $result = $mysqli->query($query);

    if ($result) {
       
        $row = $result->fetch_row();

        if ($row) {
          
            return $row[0];
        }
    }

  
    return null;
}


function getAllCommandes(){
    $mysqli = connect();
   $res = $mysqli->query("SELECT o.id, u.FN, u.LN, o.STATUS, o.ordate, o.dilivredate, io.icon
   FROM orders o
   JOIN users u ON o.id_user = u.id 
   JOIN icon_order io ON o.STATUS = io.status
   ORDER BY o.ordate DESC
    ");
   if ($res->num_rows > 0){
   while($row = $res->fetch_assoc()){
      $commands[] = $row;
   }}
   else{
     $users=0;
   }
   return $commands;

}

function getAllUsers(){
    $mysqli = connect();
   $res = $mysqli->query("SELECT * FROM users ");
    
   if ($res->num_rows > 0){
   while($row = $res->fetch_assoc()){
      $users[] = $row;
   }}
   else{
     $users=0;
   }
   return $users;

}




?>


