<?php
include './connect.php';
$category_name = 'category_name';
$sql = "SELECT * FROM catégorie";
$selctCatg = $conn->query($sql);


if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = "image" . "/" . $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    // $product_image_folder = 'img/'.$product_image;

    if (empty($product_name) || empty($product_price) || empty($product_image)) {
        $message[] = 'Please fill out all fields.';
    } else {
        if (isset($_POST['category_name'])) {
            // $category_name = $_POST['category_name'];
            // $sit = "INSERT INTO catégorie (nom) VALUES ('$category_name')";
            // mysqli_query($conn, $sit);
        }
        $insert = "INSERT INTO plante (Nom, prix, image) VALUES ('$product_name', '$product_price', '$product_image')";
        $upload = mysqli_query($conn, $insert);

        if ($upload) {
            move_uploaded_file($product_image_tmp_name, 'C:\xampp\htdocs\opep\\' . $product_image);
            $message[] = 'New plant added successfully';
        } else {
            $message[] = 'Could not add the plant';
        }
    }
}
// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM plante WHERE id = $id");
}

$select = mysqli_query($conn, "SELECT * FROM plante");
$selecte = mysqli_query($conn, "SELECT * FROM catégorie");
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
     <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
    <link rel="stylesheet" href="style3.css">
    <title>Plantes</title>
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

<!-- forme -->
<div class="container">

      <div class="admin-product-form-container">

         <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new plant</h3>
         <input type="text" placeholder="enter plant name" name="product_name" class="box">
          <select class="box">
            <?php while($row = $selctCatg->fetch_assoc()): ?>
              <option><?php echo $row['nom'] ?> </option>
              <?php endwhile; ?>
          </select>
          
         <input type="number" placeholder="enter plant price" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add plant">
         </form>
      </div>


<?php

$select = mysqli_query($conn, "SELECT * FROM plante");
$selecte = mysqli_query($conn, "SELECT * FROM catégorie");


?>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
        
         <th>plant image</th>
         <th>plant name</th>
         <th>category</th>
         <th>plant price</th>
         <th>action</th>
          
      </tr>
      </thead>
      <?php while (($row = mysqli_fetch_assoc($select)) && ($rowe = mysqli_fetch_assoc($selecte))) {
          ?>
         <tr>
            <td><img src="<?php echo $row['image']; ?>" height="70" alt="image"></td>
            <td><?php echo $row['Nom']; ?></td>
            <td><?php echo $rowe['nom']; ?></td>
            <td><?php echo $row['prix']; ?>$</td>
            <td>
               <a href="?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>
</body>
</html>