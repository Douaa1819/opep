<?php
include './connect.php';

$categoryQuery = "SELECT * FROM catégorie";
$categoryResult = mysqli_query($conn, $categoryQuery);

if (!$categoryResult) {
    die("Category query failed: " . mysqli_error($conn));
}
$searchQuery = "";

if (isset($_POST['search_submit'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_POST['search_query']);
}



if (isset($_POST['add'])) {
    $id_user = $_SESSION['id_user'];
    $id_panier = $_POST['id_plante'];
    $req = "INSERT INTO panier (id_user,id_plante) VALUES ($id_user,$id_panier)";
    $result = $conn->query($req);
    if ($result) {
        echo "<script>alert('Succès');</script>";
    } else {
        echo "<style>alert('erreur');</style>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xrwnEFO3v2eLuGqDqlpo5eK5CQ5+gHpJG0BEmWL1BaNVR1Vw+YF6t8uE+Y6xLPL2e7N23Lx7ekgnf1zT9p0LEHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style3.css">
    <title>Client</title>
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
        </nav>
    </div>

    <!-- Category Filter -->
    <nav class="p-4 my-4">
        <ul class="flex space-x-4 justify-center text-center">
            <li><a href="clien.php" class="text-gray-800 hover:text-green-500">All</a></li>

            <?php
            while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                echo '<li><a href="?category=' . $categoryRow['id_catégorie'] . '" class="text-gray-800 hover:text-green-500">' . $categoryRow['nom'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>

    <!-- nom du plant filter -->
    <div class="flex justify-end items-center mt-4 pr-4">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="flex items-center">
            <input type="text" placeholder="Search by plant name" name="search_query" class="px-4 py-2 border border-gray-400 rounded-l focus:outline-none focus:border-gray-500 bg-transparent">
            <button type="submit" name="search_submit" class="px-4 py-2 bg-green-500 text-white rounded-r hover:bg-gray-400 focus:outline-none border rounded-l ">
                Search
            </button>
        </form>
    </div>


    <?php
    if (isset($_GET['category'])) {
        $selectedCategoryId = $_GET['category'];

        if (!empty($searchQuery)) {
            $plantQuery = "SELECT * FROM plante WHERE id_catégorie = $selectedCategoryId AND Nom LIKE '%$searchQuery%'";
        } else {
            $plantQuery = "SELECT * FROM plante WHERE id_catégorie = $selectedCategoryId";
        }

        $plantResult = mysqli_query($conn, $plantQuery);

        if (!$plantResult) {
            die("Plant query failed: " . mysqli_error($conn));
        }
    } else {
        $plantQuery = "SELECT * FROM plante";
        if (!empty($searchQuery)) {
            $plantQuery .= " WHERE Nom LIKE '%$searchQuery%'";
        }
        $plantResult = mysqli_query($conn, $plantQuery);
        if (!$plantResult) {
            die("Plant query failed: " . mysqli_error($conn));
        }
    }
    ?>



    <section class="p-8">
        <!-- Product Grid -->
        <div class="grid grid-cols-4 gap-5 ">


            <?php
            while ($row = mysqli_fetch_assoc($plantResult)) {
                echo '<div class="bg-white p-3 shadow-md w-80 md:w-80 h-96 flex flex-col justify-between mb-4">';
                echo '<div class="relative h-40 mb-4">';
                echo '<img src="' . $row['image'] . '" alt="' . $row['Nom'] . '" class="w-full h-full object-cover">';
                echo '</div>';
                echo '<div class="flex-1">';
                echo '<h2 class="text-lg font-semibold mb-2">' . $row['Nom'] . '</h2>';
                echo '<p class="text-gray-700 mb-4">' . $row['description'] . '</p>';
                echo '<p class="text-green-500 font-semibold">Prix: ' . $row['prix'] . '$' . '</p>';
                echo '</div>';
                echo '<form  method="post">';
                echo '<input type="hidden" name="id_plante" value="' . $row['id'] . '">';
                $_SESSION['id_plante'] = $row['id'];
                echo '<button name ="add" type="submit" class="bg-green-500 text-white px-3 py-1 mt-4">Ajouter </button>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
</body>

</html>