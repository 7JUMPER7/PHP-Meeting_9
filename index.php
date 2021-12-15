<?php
    $links = ['home' => './pages/homepage.php', 'hotels' => './pages/hotels.php'];
    $loginLinks = ['register' => './pages/registration.php', 'login' => './pages/login.php'];
    $hideLinks = ['admin' => './pages/admin.php', 'notfound' => './pages/notfound.php', 'hotel' => './pages/hotel.php'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
    <link href="./css/form.css" rel="stylesheet">
</head>
<body>
    <header id="header">
        <?php
            include_once('./functions.php');
            include_once('./header.php');
            generateMenu($links, $loginLinks);
        ?>
    </header>

    <main>
        <?php
            if(!isset($_GET['page'])) {
                $_GET['page'] = 'home';
            } 

            if(array_key_exists($_GET['page'], $links)) {
                include_once($links[$_GET['page']]);
            } else if(array_key_exists($_GET['page'], $loginLinks)) {
                include_once($loginLinks[$_GET['page']]);
            } else if(array_key_exists($_GET['page'], $hideLinks)) {
                include_once($hideLinks[$_GET['page']]);
            } else {
                include_once('./pages/notfound.php');
            }
        ?>
    </main>

    <footer>

    </footer>
    
    <script src="./js/header.js"></script>
</body>
</html>