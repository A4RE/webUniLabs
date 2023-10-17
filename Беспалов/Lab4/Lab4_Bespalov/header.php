<header class="container-fluid">
    <div class="container">
        <div class="row align-items-start">
            <nav class="col">
                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="promotions.php">Акции</a></li>
                    <li><a href="gallery.php">Галерея</a></li>
                </ul>
            </nav>
            <div class="col text-center">
                <h1>
                    <a href="index.php" class="logo">MebelSPB</a>
                </h1>
            </div>
            <nav class="col">
                <ul>
                    <li><a href="obr_svaz.php">Контакты</a></li>
                    <li><a href="tovar.php">Купить</a></li>
                    <?php
                    if(isset($_SESSION['id']))
                    {
                        echo "<li><a href='lk.php'>ЛК</a></li>";
                    } else {
                        echo "<li><a href='login.php'>Вход</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</header>

