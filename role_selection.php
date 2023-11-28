<?php
include './connect.php';

if (isset($_POST["submit"])) {

$role=$_POST["role"];
if($_SESSION['email']) {
    $email = $_SESSION['email'];
}
$selec = "SELECT * FROM users WHERE email = '$email'";
$query = mysqli_query($conn,$selec);
$row = mysqli_fetch_assoc($query);
$id = $row['id'];
   

    $sql = "INSERT INTO  roles (user_id,name) VALUES ('$id','$role')";
    $connect = mysqli_query($conn,$sql);
    if ($connect) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/licone.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <title>Role Selection</title>
</head>

<body class="bg-opacity-70 h-screen flex items-center justify-center bg-cover" style="background-image: url('https://images.unsplash.com/photo-1509567852316-09a353a7914a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
    <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-md w-96 border border-solid">
        <h2 class="text-2xl font-semibold mb-4 text-center text-black">Select Your Role</h2>
        <form method='post'>
            <div class="mb-4">
                <select name="role" id="role" class="mt-1 p-2 border border-gray-300 rounded w-full">
                    <option value="admin">Admin</option>
                    <option value="client">Client</option>
                </select>
            </div>

            <div class="text-right">
                <input type='submit' value='Submit' name="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-gray-400">
            </div>
        </form>
    </div>

</body>

</html>

