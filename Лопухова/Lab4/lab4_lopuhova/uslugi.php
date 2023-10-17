<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страница Услуг</title>
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
    <div class="table_uslug">
        <center>
            <h2 align="center" style="margin: 20px 0">Список доступных услуг</h2>
            <h5 align="center">Выберите фильр</h5>
            <form method="post">
                <select name="filter">
                    <option label="Без фильтра" value="Без фильтра"></option>
                    <optgroup label="По Типу" value="Тип">
                        <?php
                        include "base/setup.php";
                        $expo = array();
                        $query_sel = "SELECT distinct Тип_услуги from Услуга";
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
                    $req = "SELECT * FROM Услуга ";
                    print_store($req);
                } else {
                    include "base/setup.php";
                    $filter_type = "WHERE Услуга.Тип_услуги LIKE '" . $filter . "'";
                    $req = "SELECT * FROM Услуга " . $filter_type;
                    print_store($req);
                }
            } else {
                $req = "SELECT * FROM Услуга ";
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
include "components/footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
<?php
function print_store($req)
{
    include "base/setup.php";
    echo '<b>Выберите интересующую вас услугу</b><br><br>';
    $req = mysqli_query($conn, $req) or die("Ошибка запроса" . mysqli_error($conn));
    echo "<form metod = 'GET'>";
    if ($req) {
        echo "<center><table class='table'><tr><th>Название услуги</th><th>Стоимость (Р)</th><th>Тип Услуги</th><th>Заказать</th></tr>";
        while ($row_u = mysqli_fetch_assoc($req)) {
            echo "<tr><td>". $row_u['Название_услуги']."</td>
                    <td>" . $row_u['Стоимость_услуги'] . "Р</td><td>".$row_u['Тип_услуги']."</td><td><input type=\"checkbox\" name=\"choices[]\" value = \"" . $row_u['id_услуги'] . "\"></td>
                    </tr>";
        }
        echo "</table></center>
           
                      <input class='btn-lk' type='submit' name='add' value='Добавить'></form>";
        if (!empty($_GET['add'])) {
            if (!empty($_GET['choices'])) {
                if (isset($_SESSION['id'])) {
                    $_SESSION['bas'] = $_GET['choices'];
                    echo "Услуга добавлена<br><br>";
                } else echo "К сожалению вы не зарегистрированы<b><a href=\"login.php\">Авторизуйтесь</a> или <a href=\"reg.php\">зарегистрируйтесь</a> на сайте и возвращайтесь<br><br>";
            } else echo "<b>Ничего не выбрано</b>";
        }
    }
}
?>


