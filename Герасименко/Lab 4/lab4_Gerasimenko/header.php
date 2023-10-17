<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="index.php" class="logo"><i class='bx bxl-postgresql'>ZooSer</i></a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="vid_ziv.php">Виды животных</a></li>
                    <li><a href="galery.php">Галерея</a></li>
                    <li><a href="svaz.php">Обратная связь</a></li>
                    <li><a href="bileti.php">Билеты</a> </li>
                    <?php
                    if(isset($_SESSION['id']))
                    {
                        echo '<li><a href="lk.php">ЛК</a></li>';
                    } else {
                        echo '<li><a href="login.php">Вход</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</header>
