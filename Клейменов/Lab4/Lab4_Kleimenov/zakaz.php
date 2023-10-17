<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Price List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <?php
    include "connect.php";
    session_start();
    unset($_SESSION['message']);
    ?>

</head>
<body>
<!--
    HEADER
-->
<?php
include "header.php";
?>
<!--
    MAIN BLOCK
-->
<div class="container">
    <div class="table_tovari">
        <center>
            <h2>Price List</h2>
            <form style="padding-top: 20px" method="post">
                <label><b>Выберите фильтр</b></label>
                <select name="filter">
                    <option label="Без фильтра" value="Без фильтра"></option>
                    <optgroup label="По Материалу" value="Тип">
                        <?php
                        include "connect.php";
                        $expo = array();
                        $query_sel = "SELECT distinct Название_материала from материал";
                        $result_sel_qry = mysqli_query($conn, $query_sel) or die("Ошибка " . mysqli_error($conn));
                        if($result_sel_qry){
                            while($rows = mysqli_fetch_assoc($result_sel_qry))
                            {
                                $expo[] = array_values($rows);
                            }
                        }

                        foreach ($expo as $arr)
                        {
                            foreach ($arr as $value)
                            {
                                echo '<option value="'.$value.'"'.($value == $_POST['filter'] ? ' selected="selected"' : '').'>'.$value.'</option>';
                            }
                        }
                        ?>
                    </optgroup>
                </select>
                <input style="width: 10%" class='btn-lk' type="submit" name="filtrate" value = "Фильтровать">
            </form>
            <p>Цена указанная в данном листе может отличаться от фактической, когда заказ будет подтвержадться</p>
            <?php
            if(isset($_POST["filtrate"]))
            {
                $filter = $_POST['filter'];
                if ($filter == "Без фильтра")
                {
                    $filter_type = "";
                    $req = "SELECT *, Макет.*, материал.название_материала, Фундамент.Тип FROM Услуга 
                            INNER JOIN Макет on (Услуга.id_макета = Макет.id_макета)
                            INNER JOIN материал on (Услуга.id_материала = материал.id_материала)
                            INNER JOIN Фундамент on (Услуга.id_фундамента = Фундамент.id_фундамента)";
                    print_store($req);
                } else {
                    include "connect.php";
                    $filter_type = "WHERE материал.Название_материала LIKE '" . $filter . "'";
                    $req = "SELECT *, Макет.*, материал.название_материала, Фундамент.Тип FROM Услуга 
                            INNER JOIN Макет on (Услуга.id_макета = Макет.id_макета)
                            INNER JOIN материал on (Услуга.id_материала = материал.id_материала)
                            INNER JOIN Фундамент on (Услуга.id_фундамента = Фундамент.id_фундамента)". $filter_type;
                    print_store($req);
                }
            } else {
                $req = "SELECT *, Макет.*, материал.название_материала, Фундамент.Тип FROM Услуга 
                            INNER JOIN Макет on (Услуга.id_макета = Макет.id_макета)
                            INNER JOIN материал on (Услуга.id_материала = материал.id_материала)
                            INNER JOIN Фундамент on (Услуга.id_фундамента  = Фундамент.id_фундамента)";
                print_store($req);
            }
            ?>

        </center>
    </div>
</div>
<!--
    MAIN BLOCK END
-->
<?php
include "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
<?php
function print_store($req)
{
    include "connect.php";
    $req = mysqli_query($conn, $req) or die("Ошибка запроса" . mysqli_error($conn));
    echo "<form metod = 'GET' style='padding-bottom: 20px'>";
    if ($req) {
        echo "<center><table class='table'><tr><th>Фото Макета</th><th>Макет</th><th>Фундамент</th><th>Материал</th><th>Стоимость (Р)</th><th>Заказать</th></tr>";
        while ($row_u = mysqli_fetch_assoc($req)) {
            echo "<tr><td><img src='".$row_u['Фото']."' alt='Фото шаблона'></td><td>".$row_u['Название_макета']."</td>
                    <td>".$row_u['Тип']."</td><td>".$row_u['название_материала']."</td><td>".$row_u['Стоимость_услуги']."</td><td><input type=\"checkbox\" name=\"choices[]\" value = \"" . $row_u['id_услуги'] . "\"></td>
                    </tr>";
        }
        echo "</table></center>
                      <input class='btn-lk' type='submit' name='add' value='Добавить'>
                      </form>";
        if (!empty($_GET['add'])) {
            if (!empty($_GET['choices'])) {
                if (isset($_SESSION['id'])) {
                    $_SESSION['bas'] = $_GET['choices'];
                    echo "Товар добавлен в корзину<br><br>";
                } else echo "К сожалению вы не зарегистрированы<b><br><a class='a-link' href=\"login.php\">Авторизуйтесь</a> или <a class='a-link' href=\"reg.php\">зарегистрируйтесь</a> на сайте и возвращайтесь<br><br>";
            } else echo "<b>Ничего не выбрано</b>";
        }
    }
}
?>





