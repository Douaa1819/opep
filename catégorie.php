<?php
include './connect.php';

if (isset($_POST['add_category'])) {
    $product_name = $_POST['product_name'];

    if (empty($product_name)) {
        $message[] = 'Please fill out all fields.';
    } else {
        $insert = "INSERT INTO catégorie (nom) VALUES ('$product_name')";
        $stmt = mysqli_query($conn, $insert); 

        if ($stmt) {
            $message[] = 'New category added successfully';
        } else {
            $message[] = 'Could not add the category';
        }
    }
}



if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM catégorie WHERE id_catégorie= $id");
};
?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
    <link rel="stylesheet" href="style3.css">
    <title>Category</title>
</head>
<body>
     

<div class="header-2">

  <nav class="bg-gray-300 py-2 md:py-4">
    <div class="container px-4 mx-auto md:flex md:items-center">
  <div class="w-40"><img src="img/llogo.png"></div>  
      <div class="flex justify-between items-center">
       
        <button class="border border-solid border-gray-600 px-3 py-1 rounded text-gray-600 opacity-50 hover:opacity-75 md:hidden" id="navbar-toggle">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <div class="hidden md:flex flex-col md:flex-row md:ml-auto mt-3 md:mt-0" id="navbar-collapse">
        <a href="home.php" class="p-2 lg:px-4 md:mx-2 text-white rounded bg-green-600">plants</a>
        <a href="catégorie.php" class="p-2 lg:px-4 md:mx-2 text-gray-600 rounded hover:bg-gray-200 hover:text-gray-700 transition-colors duration-300">category</a>

        <a href="clien.php" class="p-2 lg:px-4 md:mx-2 text-green-600 text-center border border-solid border-green-600 rounded hover:bg-green-800 hover:text-white transition-colors duration-300 mt-1 md:mt-0 md:ml-1">Client</a>
      </div>
    </div>
  </nav>
</div>






  <!-- forme -->
<div class="container">

<div class="admin-product-form-container">

   <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <h3>add a new category</h3>
      <input type="text" placeholder="enter category name" name="product_name" class="box">
      
      <input type="submit" class="btn" name="add_category" value="add category">
   </form>



   </div>



   <?php

$select = mysqli_query($conn, "SELECT * FROM catégorie");

?>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
         
         <th>category name</th>
         <th>action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['nom']; ?></td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['id_catégorie']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="?delete=<?php echo $row['id_catégorie']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>