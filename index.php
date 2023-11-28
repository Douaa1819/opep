<?php
include './connect.php';


if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $password = $_POST["password"];
    $sql = "INSERT INTO users (email,password,firstName,lastName) VALUES ('$email', '$password','$firstName','$lastName')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['email'] = $email;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        session_start();
        $_SESSION['email'] = $email;
        header("Location: role_selection.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>
    <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <title>Inscription</title>
  
</head>
<body>

  <div class="all">
    <div class="container">
      <h2>Inscription</h2>
      <form action="" method="post">
      <div class="form-group">
          <label for="prenom">Prénom :</label>
          <input type="text" id="prenom" name="firstName" required>
        </div>

        <div class="form-group">
          <label for="nom">Nom :</label>
          <input type="text" id="nom" name="lastName" required>
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" id="email" name="email"  required>
        </div> 

        <div class="form-group">
          <label for="motDePasse">Mot de passe :</label>
          <input type="password" id="motDePasse" name="password" required>
        </div>

        <div class="form-group">
          <button type="submit" name="submit">S'inscrire</button>
        </div>
       <p> <a href="./login.php">Vous avez déjà un compte?</a></p>
      </form>



      

    </div>
  </div>

</body>
</html>
    
