<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ассортимент</title>
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
            <h2>Каталог товаров</h2>
            <form style="padding-top: 20px" method="post">
                <label><b>Выберите фильтр</b></label>
                <select name="filter">
                    <option label="Без фильтра" value="Без фильтра"></option>
                    <optgroup label="По Типу" value="Тип">
                        <?php
                        include "connect.php";
                        $expo = array();
                        $query_sel = "SELECT distinct Наименование_типа from Тип_сборки";
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
            <?php
            if(isset($_POST["filtrate"]))
            {
                $filter = $_POST['filter'];
                if ($filter == "Без фильтра")
                {
                    $filter_type = "";
                    $req = "Select *, Видеокарты.*, Материнская_плата.*, 
                                 Память_ОЗУ.*, Память_ПЗУ.*, Процессоры.*, 
                                 Программное_обеспечение.*, Тип_сборки.* from системный_блок 
                                 INNER JOIN Видеокарты on (системный_блок.ID_видеокарты = Видеокарты.ID_видеокарты )
                                 INNER JOIN Материнская_плата on (системный_блок.ID_матплаты = Материнская_плата.ID_матплаты)
                                 INNER JOIN Память_ОЗУ on (системный_блок.ID_пам_ОЗУ = Память_ОЗУ.ID_ОЗУ)
                                 INNER JOIN Память_ПЗУ on (системный_блок.ID_пам_ПЗУ =Память_ПЗУ.ID_ПЗУ)
                                 INNER JOIN Процессоры on (системный_блок.ID_процессора = Процессоры.ID_процессора)
                                 INNER JOIN Программное_обеспечение on (системный_блок.ID_по = Программное_обеспечение.ID_ПО)
                                 INNER JOIN Тип_сборки on (системный_блок.ID_типа = Тип_сборки.id_типа)";
                    print_store($req);
                } else {
                    include "connect.php";
                    $filter_type = "WHERE Тип_сборки.Наименование_типа LIKE '" . $filter . "'";
                    $req = "Select *, Видеокарты.*, Материнская_плата.*, 
                                 Память_ОЗУ.*, Память_ПЗУ.*, Процессоры.*, 
                                 Программное_обеспечение.*, Тип_сборки.* from системный_блок 
                                 INNER JOIN Видеокарты on (системный_блок.ID_видеокарты = Видеокарты.ID_видеокарты )
                                 INNER JOIN Материнская_плата on (системный_блок.ID_матплаты = Материнская_плата.ID_матплаты)
                                 INNER JOIN Память_ОЗУ on (системный_блок.ID_пам_ОЗУ = Память_ОЗУ.ID_ОЗУ)
                                 INNER JOIN Память_ПЗУ on (системный_блок.ID_пам_ПЗУ =Память_ПЗУ.ID_ПЗУ)
                                 INNER JOIN Процессоры on (системный_блок.ID_процессора = Процессоры.ID_процессора)
                                 INNER JOIN Программное_обеспечение on (системный_блок.ID_по = Программное_обеспечение.ID_ПО)
                                 INNER JOIN Тип_сборки on (системный_блок.ID_типа = Тип_сборки.id_типа)" . $filter_type;
                    print_store($req);
                }
            } else {
                $req = "Select *, Видеокарты.*, Материнская_плата.*, 
                                 Память_ОЗУ.*, Память_ПЗУ.*, Процессоры.*, 
                                 Программное_обеспечение.*, Тип_сборки.* from системный_блок 
                                 INNER JOIN Видеокарты on (системный_блок.ID_видеокарты = Видеокарты.ID_видеокарты )
                                 INNER JOIN Материнская_плата on (системный_блок.ID_матплаты = Материнская_плата.ID_матплаты)
                                 INNER JOIN Память_ОЗУ on (системный_блок.ID_пам_ОЗУ = Память_ОЗУ.ID_ОЗУ)
                                 INNER JOIN Память_ПЗУ on (системный_блок.ID_пам_ПЗУ =Память_ПЗУ.ID_ПЗУ)
                                 INNER JOIN Процессоры on (системный_блок.ID_процессора = Процессоры.ID_процессора)
                                 INNER JOIN Программное_обеспечение on (системный_блок.ID_по = Программное_обеспечение.ID_ПО)
                                 INNER JOIN Тип_сборки on (системный_блок.ID_типа = Тип_сборки.id_типа)";
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
        echo "<center><table class='table'>";
        while ($row_u = mysqli_fetch_assoc($req)) {
            echo "<tr><td><img src='".$row_u['Изображение_сборки']."'alt='изображение сборки'></td>
                              <td><p>Видеокарта: ".$row_u['Фирма_видеокарты']." ".$row_u['Серия_видеокарты']."<br>
                              ОЗУ: ".$row_u['Тип_ОЗУ']."<br>
                              ПЗУ: ".$row_u['Тип_ПЗУ']." ".$row_u['Фирма_ПЗУ']." ".$row_u['Размер_ПЗУ']."<br>
                              Процессор: ".$row_u['Фирма_процессора']." ".$row_u['Серия_процессора']." ".$row_u['Процессор']."<br>
                              ПО: ".$row_u['Тип_ПО']."<br>
                              Тип сборки: ".$row_u['Наименование_типа']."<br>
                              Цена: ".$row_u['Цена']."</p></td><td><input type=\"checkbox\" name=\"choices[]\" value = \"" . $row_u['ID_сис_блока'] . "\"></td>
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





