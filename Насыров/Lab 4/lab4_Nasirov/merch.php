<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мерч</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <?php
    include "database/connect.php";
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
    <div class="table_merch">
        <center>
            <h2 align="center" style="margin: 20px 0">Список товаров</h2>
            <h5 align="center">Выберите фильр</h5>
            <form method="post">
                <select name="filter">
                    <option label="Без фильтра" value="Без фильтра"></option>
                    <optgroup label="По Типу" value="Тип">
                        <?php
                        include "database/connect.php";
                        $expo = array();
                        $query_sel = "SELECT distinct Тип from Мерч";
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
                <input class='btn-lk' type="submit" name="filtrate" value = "Фильтровать">
            </form>
            <?php
            if(isset($_POST["filtrate"]))
            {
                $filter = $_POST['filter'];
                if ($filter == "Без фильтра")
                {
                    $filter_type = "";
                    $req = "SELECT *, Команды.Название FROM Мерч INNER JOIN Команды on (Мерч.id_команды = Команды.ID_Команды)";
                    print_store($req);
                } else {
                    include "database/connect.php";
                    $filter_type = "WHERE Мерч.Тип LIKE '" . $filter . "'";
                    $req = "SELECT *, Команды.Название FROM Мерч INNER JOIN Команды on (Мерч.id_команды = Команды.ID_Команды) " . $filter_type;
                    print_store($req);
                }
            } else {
                $req = "SELECT *, Команды.Название FROM Мерч INNER JOIN Команды on (Мерч.id_команды = Команды.ID_Команды) ";
                print_store($req);
            }
            ?>
        </center>
    </div>
</div>
<!--
    MAIN BLOCK END
-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
<?php
function print_store($req)
{
    include "database/connect.php";
    echo '<p>Ниже представлен мерч, доступный для заказа</p>';
    $req = mysqli_query($conn, $req) or die("Ошибка запроса" . mysqli_error($conn));
    echo "<form metod = 'GET'>";
    if ($req) {
        echo "<center><table class='table'><tr><th>Название</th><th>Тип</th><th>Команда</th><th>Стоимость (Р)</th><th>Заказать</th></tr>";
        while ($row_u = mysqli_fetch_assoc($req)) {
            echo "<tr><td>". $row_u['Название_мерча']."</td>
                    <td>".$row_u['Тип']."</td><td>".$row_u['Название']."</td><td>".$row_u['Стоимость']."</td><td><input type=\"checkbox\" name=\"choices[]\" value = \"" . $row_u['id_мерча'] . "\"></td>
                    </tr>";
        }
        echo "</table></center>
           
                      <input class='btn-lk' type='submit' name='add' value='Добавить'></form>";
        if (!empty($_GET['add'])) {
            if (!empty($_GET['choices'])) {
                if (isset($_SESSION['id'])) {
                    $_SESSION['bas'] = $_GET['choices'];
                    echo "Товар добавлен в корзину<br><br>";
                } else echo "К сожалению вы не зарегистрированы<b><a href=\"login.php\">Авторизуйтесь</a> или <a href=\"reg.php\">зарегистрируйтесь</a> на сайте и возвращайтесь<br><br>";
            } else echo "<b>Ничего не выбрано</b>";
        }
    }
}
?>



