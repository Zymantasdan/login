<?php
require __DIR__.'/bootstrap.php';        // kad nereiketu i kiekviena faila rasyti to pacio susidedu i reqvoir ir uzloudinu visur
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login forma</title>
</head>
<body>
    <h1>Pradinis puslapis</h1>
 <!-- konstanta, super globali iseina is funkcijos -->
    <a href="<?= URL ?>login.php">Login</a>    
    <a href="<?= URL ?>private.php">Private</a>
    
</body>
</html>