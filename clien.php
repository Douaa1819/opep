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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
    <link rel="stylesheet" href="style3.css">
    <title>Client</title>
</head>

<body class="bg-gray-200">

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
                <a href="clien.php" class="p-2 lg:px-4 md:mx-2 text-gray-600 rounded hover:bg-gray-200 hover:text-gray-700 transition-colors duration-300">Home</a>
                <a href="#" class="p-2 lg:px-4 md:mx-2 text-green-600 text-center border border-solid border-green-600 rounded hover:bg-green-800 hover:text-white transition-colors duration-300 mt-1 md:mt-0 md:ml-1">Sign-out</a>
            </div>
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
        <button type="submit" name="search_submit"  class="px-4 py-2 bg-green-500 text-white rounded-r hover:bg-gray-400 focus:outline-none border rounded-l ">
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
        <div class="grid grid-cols-4 gap-4 ">

            <?php
            while ($row = mysqli_fetch_assoc($plantResult)) {
                echo '<div class="bg-white p-4 shadow-md w-full md:w-80 h-96 flex flex-col justify-between">';
                echo '<img src="' . $row['image'] . '" alt="' . $row['Nom'] . '" class="w-70 h-1/2 object-cover mb-4">';
                echo '<div class="flex-1">';
                echo '<h2 class="text-lg font-semibold mb-2">' . $row['Nom'] . '</h2>';
                echo '<p class="text-gray-700 mb-4">' . $row['description'] . '</p>';
                echo '<p class="text-green-500 font-semibold">Prix: ' . $row['prix'] . '$' . '</p>';
                echo '</div>';
                echo '</div>';
            }

            mysqli_free_result($categoryResult);
            mysqli_free_result($plantResult);
            mysqli_close($conn);
            ?>
        </div>
    </section>

</body>

</html>
