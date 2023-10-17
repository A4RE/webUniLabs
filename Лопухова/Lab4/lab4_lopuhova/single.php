
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страница выставки</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <?php
    include "base/setup.php";
    session_start();
    unset($_SESSION['message']);
    ?>

</head>
<body>
<!--
    HEADER
-->
<?php
include "components/header.php";
?>
<!--
    MAIN BLOCK
-->

<div class="container">
    <div class="content row">
        <!--    content-->
        <div class="main-content col-md-8 col-12">
            <?php
            include "base/setup.php";
            $page = $_GET['id'];
            $result = 'Select *, Организатор.ФИО_Организатора from Выставка 
                        INNER JOIN Организатор ON (Выставка.id_организатора = Организатор.id_организатора) WHERE id_выставки ='.$page;
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
            $date1 = strtotime($row['Дата_начала']);
            $date2 = strtotime($row['Дата_окончания']);
            $newDate1 = date('d.m.Y', $date1);
            $newDate2 = date('d.m.Y', $date2);
            echo '<h2>Выставка '.$row['Название'].'</h2>';
            echo "<div class='single_vistavka_info'>";
            echo '<p><i class="bx bx-calendar">Выставка проходит c</i> '.$newDate1.' по '.$newDate2.'</p>
                    <p><i class="bx bx-user">Организатор - '.$row['ФИО_Организатора'].'</i></p>';
            echo "</div>";
            ?>
            <div class="single_vistavka_text col-12">
                <h4>Картины, представленные на выставке</h4>
                <?php
                include "base/setup.php";
                $res = "Select *, Живопись.*, Автор.ФИО_автора, Стиль.Название_стиля, Выставка.Название from Выставляется_на
                        INNER JOIN Живопись ON (Выставляется_на.id_живописи=Живопись.id_живописи)
                        INNER JOIN Автор ON (Живопись.id_автора=Автор.id_автора)
                        INNER JOIN Стиль ON (Живопись.id_стиля=Стиль.id_стиля)
                        INNER JOIN Выставка ON (Выставляется_на.id_выставки=Выставка.id_выставки) WHERE Выставка.id_выставки LIKE $page";
                $res = mysqli_query($conn, $res) or die("Ошибка запроса Select". mysqli_error($conn));
                while ($row = mysqli_fetch_assoc($res))
                {
                    echo '<div class="vistavka row">
                            <div class="img col-12 col-md-4">
                                <img src="'.$row['Картина'].'" alt="Картина" class="img-thumbnail">
                          </div>
                          <div style="background: saddlebrown; color: #e1e1e1" class="vistavka_text col-12 col-md-8">';
                            echo '<h3>'.$row['Название_живописи'].'</h3>
                                  <p>Автор: '.$row['ФИО_автора'].'</p>
                                  <p>Год создания - '.$row['Год_создания'].' год</p>
                                  <p>Стиль -  '.$row['Название_стиля'].'</p>
                                  <p>Цена -  '.$row['Стоимость'].' Р</p>
                                  </div></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<!--
    MAIN BLOCK END
-->
<!--FOOTER BLOCK-->
<?php
include "components/footer.php"
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
