<?php
    $errors = [];
if ($_SERVER["REQUEST_METHOD"] === 'POST'){
    $uploadDirectory = 'avatar/';
    $uploadFile = $uploadDirectory . uniqid() . basename($_FILES['avatar']['name']);
    $extensionFile = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensionAuthorized = ['jpg', 'jpeg', 'png', 'svg', 'webp',];
    $maxFileSize = 1_000_000;
    $firstname = trim(htmlentities($_POST['firstname']));
    $lastname = trim(htmlentities($_POST['lastname']));
    if(!in_array($extensionFile, $extensionAuthorized)){
        $errors[] = 'Le format du fichier est incorrect. Veuillez choisir un fichier de type jpg, jpeg, png, webp ou svg';
    }
    if (file_exists($_FILES['avatar']['tmp_name'])){
        if (filesize($_FILES['avatar']['tmp_name']) > $maxFileSize){
            $errors[] = "Votre fichier est trop volumineux... Il ne doit pas dépasser 1Mo";
        }
    } else {
        if ($_FILES['avatar']['error'] === 1){
            $errors[] = "Votre fichier est beaucoup trop volumineux... Il ne doit pas dépasser 1Mo";
        }
    }
    
    if (count($errors) > 0){
        foreach ($errors as $error) {
            echo $error;
        } 
    } else {
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
            session_start();
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['srcAvatar'] = $uploadFile;
            $_SESSION['file'] = $_FILES;
            header("Location:index.php");
        }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="avatar">Avatar :
        <input type="file" name="avatar" id="avatar" >
    </label>
    <br />
    <label for="firstname">Firstname :
        <input type="text" name="firstname" id="firstname" >
    </label>
    <br />
    <label for="lastname">Lastname :
        <input type="text" name="lastname" id="lastname" >
    </label>
    <br />
    <input type="submit" value="send">
</form>
