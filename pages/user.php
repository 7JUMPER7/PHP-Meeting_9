<div class="container">
    <?php
        if(isset($_POST['logOutBtn'])) {
            include_once('./functions.php');
            logOut();
            ?>
                <script>
                    window.location = '?page=home';
                </script>
            <?php
        }

        if(isset($_SESSION['user'])) {
            ?>
                <form action="?page=user" method="POST">
                    <input type="submit" name="logOutBtn" value="Log Out">
                </form>
            <?php
        } else {
            ?>
                <script>
                    window.location = '?page=home';
                </script>
            <?php
        }
    ?>
</div>