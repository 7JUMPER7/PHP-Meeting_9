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
                        <table class="table table-hover mt-5" style="border-radius: 10px; overflow: hidden; box-shadow: 0 0 15px 0 rgba(0, 0, 0, .1);">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <input type="text" name="Country" placeholder="Country">
                        <div class="buttons">
                            <input type="submit" name="sBtn" value="Add" onclick="addCountry(event)">
                            <input type="submit" name="delBtn" value="Delete selected" onclick="deleteFromTable(event)">
                        </div>
                    </form>

                    <form action="?page=admin" method="POST" id="Cities">
                        <div class="header">Cities</div>
                        <table class="table table-hover mt-5" style="border-radius: 10px; overflow: hidden; box-shadow: 0 0 15px 0 rgba(0, 0, 0, .1);">
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
                        <select name="countries"></select>
                        <input type="text" name="City" placeholder="City">
                        <div class="buttons">
                            <input type="submit" name="sBtn" value="Add" onclick="addCity(event)">
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