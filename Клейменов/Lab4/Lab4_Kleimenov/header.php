<header class="container-fluid">
    <div class="container">
        <div class="row align-items-start">
            <nav class="col">
                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="akcii.php">Акции</a></li>
                    <li><a href="gallery.php">Галерея</a></li>
                    <li><a href="svaz.php">Контакты</a></li>
                    <li><a href="zakaz.php">Price List</a></li>
                    <?php
                    if(isset($_SESSION['id']))
                    {
                        echo "<li><a href='lk.php'>ЛК</a></li>";
                    } else {
                        echo "<li><a href='auth.php'>Вход</a></li>";
                        echo "<li><a href='reg.php'>Регистрация</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</header>

