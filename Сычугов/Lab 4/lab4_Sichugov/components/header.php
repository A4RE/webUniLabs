<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="index.php" class="logo">КХЛ</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="match.php">Новости</a></li>
                    <li><a href="galery.php">Галерея</a></li>
                    <li><a href="svaz.php">Связь</a></li>
                    <?php
                    if(isset($_SESSION['id']))
                    {
                        echo '<li><a href="lk.php">Кабинет</a></li>';
                        echo '<li><a href="merch.php">Мерч</a></li>';
                    } else {
                        echo '<li><a href="login.php">Вход</a></li>';
                        echo '<li><a href="reg.php">Регистрация</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</header>

