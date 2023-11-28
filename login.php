<?php
include './connect.php';

if (isset($_POST['suivant'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $email;
    echo $password;

    
    if (!empty($password) && !empty($email)) {

    
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($query)) {
            $IDuser = $row['id'];
            $cherker = "SELECT * FROM roles WHERE user_id = '$IDuser'";
            $querycheker = mysqli_query($conn,$cherker);
            while($row = mysqli_fetch_assoc($querycheker)) {
                if($row['name'] == 'admin') {
                    header("location: home.php");
                }
                else{
                    header("location: clien.php");
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>s'authentifier</title>
</head>
<body>

<div class="all">
    <div class="container">
        <h2>S'authentifier</h2>
        <form action="" method="post">

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="motDePasse">Mot de passe :</label>
                <input type="password" id="motDePasse" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit" name="suivant">suivant</button>
            </div>
            <p><a href="./index.php">Vous avez déjà un compte?</a></p>

        </form>
    </div>
</div>
</body>
</html>

