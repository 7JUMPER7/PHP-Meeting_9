<div class="container">
    <?php
        if(isset($_SESSION['user'])) {
            if($_SESSION['user']->getRoleId() == 2) {
                ?>
                    <form class="imageLoader">
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Multiple files input example
                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                            </label>
                        </div>
                    </form>
                <?php
                uniqid('image_');
            }
        }

        if(!isset($_GET['id'])) {
            RedirectToNotFound();
        } else {
            include_once('./functions.php');
            $res = getHotelById($_GET['id']);
            if(!$res['status']) {
                RedirectToNotFound();
            } else {
                $hotel = $res['res'];
                if(!$hotel) {
                    RedirectToNotFound();
                } else {
                    $imagesRes = getHotelImages($_GET['id']);
                    // var_dump($imagesRes);

                    echo "<div class='hotelContainer'>";
                    echo "<div class='imagesBox'>";
                    if(!$imagesRes['status']) { // Если нет картинок отеля
                        echo '<div class="undefinedImage"><svg width="16" height="16" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
                        </svg></div>';
                    } else { // Если есть
                    ?>
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php
                                for($i = 0; $i < count($imagesRes['res']); $i++) {
                                    if($i == 0) {
                                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'" class="active" aria-current="true" aria-label="Image '.($i + 1).'"></button>';
                                    } else {
                                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i.'" aria-label="Image '.($i + 1).'"></button>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="carousel-inner">
                            <?php
                                for($i = 0; $i < count($imagesRes['res']); $i++) {
                                    $image = $imagesRes['res'][$i];
                                    if($i == 0) {
                                        echo "<div class='carousel-item active'>";
                                    } else {
                                        echo "<div class='carousel-item'>";
                                    }
                                    echo "<img src='./images/".$image['Path']."' class='d-block w-100' alt='".$image['Path']."'>";
                                    echo "</div>";
                                }                                    
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                        <?php
                    }
                    echo "</div>";
                    echo "<div class='hotelBody'>";
                    echo "<div class='header'><div>";
                    echo "<h1>".$hotel['Hotel']."</h1>";
                    $place = getPlaceByCityId($hotel['CityId']);
                    if($place['status']) {
                        echo "<p>".$place['res'][0].", ".$place['res'][1]."</p>";
                    }
                    echo "</div><h2>".$hotel["Price"]." грн</h2>";
                    echo "</div>";
                    echo "<p class='desc'>".$hotel['Description']."</p>";
                    echo "</div></div>";
                }
            }
        }
    ?>
</div>