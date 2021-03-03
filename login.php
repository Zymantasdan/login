<?php
require __DIR__.'/bootstrap.php';        

// LOGOUT scenarijus
if (isset($_GET['logout'])) {
    //keli budai
    // $_SESSION['login'] = 0;
    // unset($_SESSION['user']);

    // kitas
    session_destroy();
    header('Location: '.URL.'login.php');
    die;
}


// Jau prisijungusio vartotojo scenarijus
if(isset($_SESSION['login']) && 1 == $_SESSION['login']) {
    header('Location: '.URL.'private.php');
    die;
}




// POST metodo scenarijus LOGIN
if ($_SERVER['REQUEST_METHOD'] == 'POST') {     // indentifikuojam senariju

    $users = file_get_contents(__DIR__.'/users.json');      //nuskaitau visus usserius 
    $users = json_decode($users, 1);        //jsono stringa pasiverciam i masyva is migrations imam $users

    $postName = $_POST['name'] ?? '';       //jeji name nera tuscia
    $postPass = $_POST['pass'] ?? '';       

    foreach ($users as $user) {                     // imam po viena useri ir ziurim ar jis yra, jei turetume duomenu baze nereiketu sito.
        if ($postName == $user['name']) { // <--- turim useri
            if (password_verify($postPass, $user['pass'])) { // <--- viskas OK
                 // sugalvojam kad 1 reiks prisijungusi vartotoja
                //  o 0 reiks neprisijungusi
                
                $_SESSION['login'] = 1;
                $_SESSION['user'] = $user;
                header('Location: '.URL.'private.php');
                die;
            }
        }
    }
    //jei nerandu userio ir slaptazodzio generuosiu bendrini pranesima
    $_SESSION['error_msg'] = 'Password or Name is invalid.';
    header('Location: '.URL.'login.php');
    die;
}









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
    <h1>Login puslapis</h1>
    <!-- tikrinam ar yra pranesimas,jeigu sesijoje yra irasytas pranesimas tai mes ji rpdysim -->
    <?php if(isset($_SESSION['error_msg'])): ?>         
        <!-- jei pranesimas yra. atvaizduojame -->
        <h3 style="color:red"><?= $_SESSION['error_msg'] ?></h3>
        <!-- atvaizdavome. nebereikalingas istrinam, kad nerodytu sekati karta -->
        <?php unset($_SESSION['error_msg']) ?>
    <?php endif ?>
    <!-- action kur kreipiames -->
  
    <form action="<?= URL ?>login.php" method="post">
        NAME:<input type="text" name="name">
        PASSWORD:<input type="password" name="pass">
        <button type="submit">login</button>
    
    </form>
 
</body>
</html>