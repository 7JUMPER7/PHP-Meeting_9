<?php
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->getRoleId() == 2) {
            if(isset($_POST['form'])) {
                var_dump($_POST['form']);
                if(isset($_POST['sBtn'])) {
                    var_dump('test');
                }
            }

            ?>
                <div class="container">
                    <form action="?page=admin" method="POST" id="Countries">
                        <div class="header">Countries</div>
                        <div class="tableContainer">
                            <table class="table table-hover mt-5">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <input type="text" name="Country" placeholder="Country">
                        <div class="buttons">
                            <input type="submit" name="sBtn" value="Add" onclick="addCountry(event)">
                            <input type="submit" name="delBtn" value="Delete selected" onclick="deleteFromTable(event)">
                        </div>
                    </form>

                    <form action="?page=admin" method="POST" id="Cities">
                        <div class="header">Cities</div>
                        <div class="tableContainer">
                            <table class="table table-hover mt-5">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>City</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <select name="countries"></select>
                        <input type="text" name="City" placeholder="City">
                        <div class="buttons">
                            <input type="submit" name="sBtn" value="Add" onclick="addCity(event)">
                            <input type="submit" name="delBtn" value="Delete selected" onclick="deleteFromTable(event)">
                        </div>
                    </form>

                    <form action="?page=admin" method="POST" id="Hotels">
                        <div class="header">Hotels</div>
                        <div class="tableContainer">
                            <table class="table table-hover mt-5">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Hotel</th>
                                        <th>Place</th>
                                        <th>Stars</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <input type="text" name="Hotel" placeholder="Hotel">
                        <select name="Place"></select>
                        <input type="number" name="Price" placeholder="Price">
                        <input type="text" name="Description" placeholder="Description">
                        <div class="buttons">
                            <input type="submit" name="sBtn" value="Add" onclick="addHotel(event)">
                            <input type="submit" name="delBtn" value="Delete selected" onclick="deleteFromTable(event)">
                        </div>
                    </form>

                    <script src="./js/adminPage.js"></script>
                </div>
            <?php
        } else {
            echo "<div class='alertMessage'>You are not allowed</div>";
        }
    } else {
        echo "<div class='alertMessage'>Log in first</div>";
    }
?>