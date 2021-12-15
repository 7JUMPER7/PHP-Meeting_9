<div class="container">
    <?php
        if(isset($_GET['id'])) {
            include_once('./functions.php');
            $res = getHotelById($_GET['id']);
            if($res['status']) {
                    $hotel = $res['res'];
                    if($hotel) {
                        echo "<div class='hotelContainer'>";
                        echo "<h1>".$hotel['Hotel']."</h1>";
                        echo "</div>";
                    } else {
                        RedirectToNotFound();
                    }
            } else {
                RedirectToNotFound();
            }
        } else {
            RedirectToNotFound();
        }
    ?>
</div>