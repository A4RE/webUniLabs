<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Лабораторная работа №3</title>
</head>
<body>
<header>
    <h1>Выставка Живописи</h1>
</header>
<h2>Таблица Живописи</h2>
<!--Секция с многотабличным запросом-->
<div class="table_div_mnog">
    <form method="post">
        <center>
            <table style="padding-bottom: 20px ">
                <tr>
                    <td>Сортировать по:</td>
                </tr>
                <tr>
                    <td>
                        <input class="btn" type="submit" name="vozr" value="По возрастанию">
                    </td>
                    <td>
                        <input class="btn" type="submit" name="ubiv" value="По убыванию">
                    </td>
                </tr>
            </table>
        </center>
    </form>
    <?php
    if(isset($_POST['vozr']))
    {
        include "setup.php";
        $result = 'Select *, Автор.ФИО_автора, Стиль.Название_стиля from Живопись 
                    INNER JOIN Автор ON (Живопись.id_автора = Автор.id_автора)
                    INNER JOIN Стиль ON (Живопись.id_стиля = Стиль.id_стиля) order by id_живописи ASC';
        $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
        if($result)
        {
            $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>id живописи</th>
        <th>Название</th>
        <th>Автор</th>
        <th>Год</th>
        <th>Стиль</th>
        <th>Стоимость (Р)</th>
        </tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                $table .= "<tr><td>".$row['id_живописи']."</td>
                            <td>".$row['Название_живописи']."</td>
                            <td>".$row['ФИО_автора']."</td>
                            <td>".$row['Год_создания']."</td>
                            <td>".$row['Название_стиля']."</td>
                            <td>".$row['Стоимость']."</td>
                            </tr>";
            }
            $table .="</table></center>";
            echo $table;
        }
    }
    else {
        include "setup.php";
        $result = 'Select *, Автор.ФИО_автора, Стиль.Название_стиля from Живопись 
                    INNER JOIN Автор ON (Живопись.id_автора = Автор.id_автора)
                    INNER JOIN Стиль ON (Живопись.id_стиля = Стиль.id_стиля) order by id_живописи DESC';
        $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
        if ($result) {
            $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>id живописи</th>
        <th>Название</th>
        <th>Автор</th>
        <th>Год</th>
        <th>Стиль</th>
        <th>Стоимость (Р)</th>
        </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $table .= "<tr><td>".$row['id_живописи']."</td>
                            <td>".$row['Название_живописи']."</td>
                            <td>".$row['ФИО_автора']."</td>
                            <td>".$row['Год_создания']."</td>
                            <td>".$row['Название_стиля']."</td>
                            <td>".$row['Стоимость']."</td>
                            </tr>";
            }
            $table .= "</table></center>";
            echo $table;
        }
    }
    ?>
</div>

<!--Работа с запросами-->
<div class="form-section">
    <div class="form">
        <h2>Добавить выставку</h2>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Название выставки</label>
                    </td>
                    <td>
                        <input type="text" name="name" class="input" placeholder="Введите название выставки">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Дата начала выставки</label>
                    </td>
                    <td>
                        <input type="date" name="date_1" class="input" placeholder="Введите дату начала выставки">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Дата окончания выставки</label>
                    </td>
                    <td>
                        <input type="date" name="date_2" class="input" placeholder="Введите дату окончания выставки">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Адрес выставки</label>
                    </td>
                    <td>
                        <input type="text" name="adres" class="input" placeholder="Введите адрес выставки">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn" name="add" value="Добавить">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="form">
        <h2>Удалить Выставку</h2>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Выставка</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, 'Select Название from Выставка')
                        or die("Ошибка ". mysqli_error($dp));
                        if ($result){
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($dp);
                        ?>
                        <select class="select" name="vistavka">
                            <option value="0">Выберите...</option>
                            <?php
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['vistavka'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn" name="del" value="Удалить">
                    </td>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="form">
        <h2>Обновить данные</h2>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Выставка</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, 'Select Название from Выставка')
                        or die("Ошибка ". mysqli_error($dp));
                        if ($result){
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($dp);
                        ?>
                        <select class="select" name="vistavka_1">
                            <option value="0">Выберите...</option>
                            <?php
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['vistavka_1'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Дата начала выставки</label>
                    </td>
                    <td>
                        <input type="date" name="data_3" class="input-1" placeholder="Введите новый телефон">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Дата окончания выставки</label>
                    </td>
                    <td>
                        <input type="date" name="data_4" class="input-1" placeholder="Введите новый телефон">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn" name="update" value="Изменить">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="form">
        <h2>Вывод Живописи по стилям</h2>
        <form method="post">
            <tr>
                <td>
                    <label>Стиль</label>
                </td>
                <td>
                    <?php
                    include "setup.php";
                    $arr = array();
                    $result = mysqli_query($dp, 'Select Название_стиля from Стиль')
                    or die("Ошибка ". mysqli_error($dp));
                    if ($result)
                    {
                        while ($rows = mysqli_fetch_assoc($result))
                        {
                            $arr[] = array_values($rows);
                        }
                    }
                    mysqli_close($dp);
                    ?>
                    <select class="select" name="list">
                        <option value="0">Выберите стиль...</option>
                        <?php
                        foreach ($arr as $k){
                            foreach ($k as $Value){
                                echo '<option value="'.$Value.'"'.($Value == $_POST['list'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <input type="submit" class="btn" name="b" value="Подробнее">
                </td>
            </tr>
        </form>
    </div>
</div>
<!--Вывод таблиц-->

<div class="result-forms">
    <?php
    if(isset($_POST['add']))
    {
        echo "<h2>Таблица после добавления:</h2>";
        add($_POST['name'], $_POST['date_1'], $_POST['date_2'], $_POST['adres']);
    }
    if(isset($_POST['del']))
    {
        echo "<h2>Таблица после удаления:</h2>";
        del($_POST['vistavka']);
    }
    if(isset($_POST['update']))
    {
        echo "<h2>Таблица после обновления:</h2>";
        update($_POST["vistavka_1"], $_POST["data_3"], $_POST["data_4"]);
    }
    if(isset($_POST['b']))
    {
        echo "<h2>Таблица с выводом по параметру:</h2>";
        printParam($_POST['list']);
    }
    ?>
</div>
</body>
</html>
<?php
function add($name, $date1, $date2, $adres) {
    include "setup.php";
    $oldDate1=strtotime($date1);
    $new_date1 = date('Y-m-d', $oldDate1);
    $oldDate2=strtotime($date2);
    $new_date2 = date('Y-m-d', $oldDate2);

    $result = mysqli_query($dp,
        "INSERT INTO Выставка (`id_выставки`, `Название`, `Дата_начала`, `Дата_окончания`, `Адрес`, `id_организатора`) 
                    VALUES (NULL, '$name', '$new_date1', '$new_date2', '$adres', NULL)")
    or die("Ошибка добавления". mysqli_error($dp));
    printAddDelUpd();
}
function del($name) {
    include "setup.php";
    $result = mysqli_query($dp, "Delete from Выставка WHERE Название like '$name'")
    or die("Ошибка удаления". mysqli_error($dp));
    mysqli_close($dp);
    printAddDelUpd();
}

function update($vistavka_1, $date3, $date4)
{
    $oldDate3=strtotime($date3);
    $new_date3 = date('Y-m-d', $oldDate3);
    $oldDate4=strtotime($date4);
    $new_date4 = date('Y-m-d', $oldDate4);
    include "setup.php";
    $result = mysqli_query($dp, "Update Выставка SET Дата_начала = '$new_date3', Дата_окончания = '$new_date4' WHERE Название = '$vistavka_1'")
    or die("Ошибка обновления выставки" . mysqli_error($dp));
    mysqli_close($dp);
    printAddDelUpd();
}

function printAddDelUpd(){
    include "setup.php";
    $result = mysqli_query($dp, "SELECT * FROM Выставка")
    or die("Ошибка запроса Select" . mysqli_error($dp));
    if($result)
    {
        $table="<center><table class='table'align='center' cellpadding='0' cellspacing='0'>
        <tr>
        <th>id_выставки</th>
        <th>Название</th>
        <th>Дата начала</th>
        <th>Дата окончания</th>
        <th>Адрес</th>
        </tr>";
        while($row=mysqli_fetch_assoc($result))
        {
            $date_start=strtotime($row['Дата_начала']);
            $date_end=strtotime($row['Дата_окончания']);
            $startDate = date('d.m.Y', $date_start);
            $endDate = date('d.m.Y', $date_end);
            $table .= "<tr><td>".$row['id_выставки']."</td>
                            <td>".$row['Название']."</td>
                            <td>".$startDate."</td>
                            <td>".$endDate."</td>
                            <td>".$row['Адрес']."</td></tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}

function printParam($name_p){
    include "setup.php";
    $result = "Select *, Автор.ФИО_автора, Стиль.Название_стиля from Живопись 
                    INNER JOIN Автор ON (Живопись.id_автора = Автор.id_автора)
                    INNER JOIN Стиль ON (Живопись.id_стиля = Стиль.id_стиля) WHERE Стиль.Название_стиля LIKE '$name_p'";
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>id живописи</th>
        <th>Название</th>
        <th>Автор</th>
        <th>Год</th>
        <th>Стиль</th>
        <th>Стоимость (Р)</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $table .= "<tr>
                        <td>".$row['id_живописи']."</td>
                        <td>".$row['Название_живописи']."</td>
                        <td>".$row['ФИО_автора']."</td>
                        <td>".$row['Год_создания']."</td>
                        <td>".$row['Название_стиля']."</td>
                        <td>".$row['Стоимость']."</td>
                        </tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}

