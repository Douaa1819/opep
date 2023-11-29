<?php

include './connect.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];

   if(empty($product_name) ){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE catégorie SET nom ='$product_name' WHERE id_catégorie = '$id'";
      $upload = mysqli_query($conn, $update_data);

    
   }
};
?>


<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>
  <!DOCTYPE html>
   <html lang="en">
   <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
         <link rel="stylesheet" href="style3.css">
         <title>UPDATE</title>
   </head>
   
   <body>
      <div class="container">


            <div class="admin-product-form-container centered">

            <?php
            
               $select = mysqli_query($conn, "SELECT * FROM catégorie WHERE id_catégorie = '$id'");
               while($row = mysqli_fetch_assoc($select)){

               ?>
      
            <form action="" method="post" enctype="multipart/form-data">
            <h3 class="title">update the category</h3>
            <input type="text" class="box" name="product_name" value="<?php echo $row['nom']; ?>" placeholder="enter the category name">
            <input type="submit" value="update category" name="update_product" class="btn">
            <a href="catégorie.php" class="btn">go back!</a>
            </form>
         


         <?php }; ?>

                </div>
      </div>

</body>
</html>