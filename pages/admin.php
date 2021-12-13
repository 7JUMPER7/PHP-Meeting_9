<?php
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->getRoleId() == 2) {
            ?>
                <div class="container">
                    <form action="?page=admin&form=Countries">
                        <div class="header">Countries</div>

                        <table class="table table-dark table-hover mt-5" style="border-radius: 10px; overflow: hidden; box-shadow: 7px 7px 15px 0 rgba(0, 0, 0, .3);">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Manufacturer</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                        <input type="text" name="Country" placeholder="Country">
                        <input type="submit" name="sBtn" value="Add">
                    </form>
                    <form action="?page=admin&form=Cities">
                        <div class="header">Cities</div>
                        <input type="text" name="City" placeholder="City">
                        <input type="submit" name="sBtn" value="Add">
                    </form>
                </div>

                <script>

                </script>
            <?php
        } else {
            echo "<div class='alertMessage'>You are not allowed</div>";
        }
    } else {
        echo "<div class='alertMessage'>Log in first</div>";
    }
?>