<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === 'POST'){
    if(file_exists($_SESSION['srcAvatar'])){
        unlink($_SESSION['srcAvatar']);
    }
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="/form.php">Register me</a>
    </div>
    <div class="card">
        <div class="card_imageContainer">
            <img src="<?= $_SESSION["srcAvatar"] ?>" alt="">
        </div>
        <div class="card_identityInformation">
            <p class="card_identityInformationName">Drivers License</p>
            <p class="card_identityInformationName_firstname"><?= $_SESSION['firstname'] ?></p>
            <p class="card_identityInformationName_lastname"><?= $_SESSION['lastname'] ?></p>
        </div>
    </div>
    <form action="" method="post">
        <input type="submit" value="Remove">
    </form>
</body>
</html>