<?php
include './connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fetch cart
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

if (!$id_user) {
    die("User not logged in."); 
}

$cartQuery = "SELECT id_panier, id_plante, Nom, prix, image
              FROM panier, plante
              WHERE id_plante = id AND id_user = $id_user";
$cartResult = mysqli_query($conn, $cartQuery);

if (!$cartResult) {
    die("Cart query failed: " . mysqli_error($conn));
}

// Get total number of plants
$totalBeforeDeletion = mysqli_num_rows($cartResult);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteCartItem'])) {
    $id_panier_to_delete = $_POST['deleteCartItem'];

    // Deletion from the database
    $deleteQuery = "DELETE FROM panier WHERE id_panier = $id_panier_to_delete AND id_user = $id_user";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if (!$deleteResult) {
        die("Delete query failed: " . mysqli_error($conn));
    }

    // Get total number of plants after deletion
    $cartResultAfterDeletion = mysqli_query($conn, $cartQuery);
    $totalAfterDeletion = mysqli_num_rows($cartResultAfterDeletion);

    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

if (isset($_POST['add_commande'])) {
    $cartQuery = "SELECT id_panier, id_plante, Nom, id_user
                  FROM panier, plante
                  WHERE id_plante = id AND id_user = $id_user";
    $cartResult = mysqli_query($conn, $cartQuery);

    if (!$cartResult || mysqli_num_rows($cartResult) == 0) {
        die("Error fetching cart or cart is empty.");
    }

    while ($row = mysqli_fetch_assoc($cartResult)) {
        $name = $row['Nom'];
        $id_P = $row['id_plante'];
        $id_U = $row['id_user'];

        // Insert into the commande table
        $reqet = "INSERT INTO commande (nomCommande, id_plante, id_user) VALUES ('$name', $id_P, $id_U)";
        $result = mysqli_query($conn, $reqet);

}


$totalBeforeDisplay = mysqli_num_rows($cartResult);

e
$totalPrice = 0;
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
        <nav class="bg-gray-300 py-2 md:py-4 ">
            <div class="container px-4 mx-auto md:flex md:items-center">
                <div class="w-40"><img src="img/llogo.png"></div>
                <div class="flex justify-between items-center">
                    <button class="border border-solid border-gray-600 px-3 py-1 rounded text-gray-600 opacity-50 hover:opacity-75 md:hidden" id="navbar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="hidden md:flex flex-col md:flex-row md:ml-auto mt-3 md:mt-0" id="navbar-collapse">
                    <a href="clien.php" class="p-2 lg:px-4 md:mx-2 text-gray-600 rounded hover:bg-gray-200 hover:text-gray-700 transition-colors duration-300">Shopping Cart</a>
                    <a href="#" class="p-2 lg:px-4 md:mx-2 text-gray-600 rounded hover:bg-gray-200 hover:text-gray-700 transition-colors duration-300">Contact</a>
                    <a href="panier.php">
                        <svg class="h-8 p-1 hover:text-green-500 duration-200" aria-hidden="true" focusable="false" data-prefix="far" data-icon="shopping-cart" href="panier.php" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-shopping-cart fa-w-18 fa-7x">
                            <path fill="currentColor" d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z" class=""></path>
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!--cartss  -->
    <div class="container mx-auto mt-8 flex justify-center">
        <section class="w-full max-w-2xl">

            <?php
            while ($row = mysqli_fetch_assoc($cartResult)) {
                // Update total price
                $totalPrice += $row['prix'];

                echo '<form method="post" class="bg-white p-4 shadow-md mb-4 flex items-center justify-between">';
                echo '<img src="' . $row['image'] . '" alt="' . $row['Nom'] . '" class="w-16 h-16 object-cover mr-4">';
                echo '<div class="flex-grow">';
                echo '<h2 class="text-lg font-semibold mb-2">' . $row['Nom'] . '</h2>';
                echo '<p class="text-green-500 font-semibold">Prix: ' . $row['prix'] . '$' . '</p>';
                echo '</div>';
                echo '<button type="submit" name="deleteCartItem" value="' . $row['id_panier'] . '" class="text-red-500 hover:text-red-700">Delete</button>';
                echo '</form>';
            }
            if (mysqli_num_rows($cartResult) == 0) {
                echo '<p class="text-gray-700">Your shopping cart is empty.</p>';
            }
            ?>
            <p>Total price of plants: <?php echo $totalPrice; ?>$</p>
            <p>Total products : <?php echo $totalAfterDeletion ?? $totalBeforeDisplay; ?></p>
            <form method="post">
                <button name="add_commande" type="submit" class="bg-green-500 text-white px-3 py-1 mt-4 ">commander </button>
            </form>
        </section>

    </div>

</body>

</html>
