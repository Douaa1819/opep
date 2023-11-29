<?php
include './connect.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Fetch cartr
$id_user = $_SESSION['id_user'];
$cartQuery = "SELECT panier.id_panier, plante.Nom, plante.description, plante.prix ,plante.image
              FROM panier
              JOIN plante ON panier.id_plante = plante.id
              WHERE panier.id_user = $id_user";
$cartResult = mysqli_query($conn, $cartQuery);

if (!$cartResult) {
    die("Cart query failed: " . mysqli_error($conn));
}
?>

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
<body class="bg-gray-200">
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
    <!-- fin du nav -->
  <!--cartss  -->
    <?php
    while ($row = mysqli_fetch_assoc($cartResult)) {
        echo '<div class="bg-white p-4 shadow-md mb-4 flex">';
        echo '<img src="' . $row['image'] . '" alt="' . $row['Nom'] . '" class="w-20 h-20 object-cover mr-4">';
        echo '<div>';
        echo '<h2 class="text-lg font-semibold mb-2">' . $row['Nom'] . '</h2>';
        echo '<p class="text-gray-700 mb-2">' . $row['description'] . '</p>';
        echo '<p class="text-green-500 font-semibold">Prix: ' . $row['prix'] . '$' . '</p>';
        echo '</div>';
        echo '</div>';
    }

    if (mysqli_num_rows($cartResult) == 0) {
        echo '<p class="text-gray-700">Your shopping cart is empty.</p>';
    }
    ?>
</section>
</body>
</html>














