<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Lab_3</title>
</head>
<body>
<header>
    <h1>
        Сеть Кофеин "Аврора"
    </h1>
</header>
<section class="section_1">
    <h2 class="main">Сотрудники кофейн</h2>
</section>
<section class="section_2">
    <form method="POST">
        <?php
        include "setup.php";
        $result = 'SELECT *, Кафе.Адрес, Должность.Название FROM Сотрудник INNER JOIN 
        Кафе ON (Сотрудник.ID_кафе = Кафе.ID_кафе) INNER JOIN Должность ON (Сотрудник.ID_Должности = Должность.ID_Должности)
        ORDER BY Адрес';
        $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
        if($result){
            $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr><th class='td'>Фамилия</th><th class='td'>Имя</th>
        <th class='td'>Отчество</th><th class='td'>Должность</th>
        <th class='td'>Адрес</th></tr>";
            while ($row = mysqli_fetch_assoc($result)){
                $table .= "<tr>";
                $table .= "<td class='td'>".$row['Фамилия']."</td>";
                $table .= "<td class='td'>".$row['Имя']."</td>";
                $table .= "<td class='td'>".$row['Отчество']."</td>";
                $table .= "<td class='td'>".$row['Название']."</td>";
                $table .= "<td class='td'>".$row['Адрес']."</td>";
                $table .= "</tr>";
            }
            $table .="</table></center>";
            echo $table;
        }
        ?>
    </form>
</section>
<div class="div-main">
    <div class="left">
        <h2>Добавить клиента</h2>
        <section class="section_s">
            <form method="post">
                <table>
                    <tr>
                        <td>
                            <label>Фамилия</label>
                        </td>
                        <td>
                            <input type="text" name="sname" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Имя</label>
                        </td>
                        <td>
                            <input type="text" name="name" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Отчество</label>
                        </td>
                        <td>
                            <input type="text" name="lname" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Телефон</label>
                        </td>
                        <td>
                            <input type="text" name="phone" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Карта</label>
                        </td>
                        <td>
                            <input type="number" name="card" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btn" name="add" value="Добавить клиента">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <h2>Удалить клиента</h2>
        <section class="section_s">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Карта клиента</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "SELECT Номер_карты FROM Клиент") or
                            die("Ошибка ". mysqli_error($dp));
                            if ($result){
                                while ($rows = mysqli_fetch_assoc($result)){
                                    $arr[] = array_values($rows);
                                }
                            }
                            mysqli_close($dp);
                            ?>
                            <select class="select" name="klient">
                                <option value="0">Выберите...</option>
                                <?php
                                foreach ($arr as $k) {
                                    foreach ($k as $Value) {
                                        echo '<option value="' . $Value . '"' . ($Value == $_POST['klient'] ? ' selected="selected"' : '') . '>' . $Value . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn" type="submit" name="del" value="Удалить">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <h2>Обновление данных</h2>
        <section class="section_s">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Ассортимент</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $result1 = mysqli_query($dp, "Select Наименование_вып FROM Ассортимент")
                            or die("Ошибка ". mysqli_error($dp));
                            if($result1){
                                while ($rows1 = mysqli_fetch_assoc($result1))
                                {
                                    $arr1[] = array_values($rows1);
                                }
                            }
                            mysqli_close($dp);
                            ?>
                            <select class="select" name="assort">
                                <option value="0">Выберите</option>
                                <?php
                                foreach ($arr1 as $k)
                                {
                                    foreach ($k as $Value)
                                    {
                                        echo '<option value="'.$Value.'"'.($Value == $_POST['assort'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Описание</label>
                        </td>
                        <td>
                            <input type="text" name="opis" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Цена</label>
                        </td>
                        <td>
                            <input type="number" name="price" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btn" name="update" value="Обновить">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <h2>Сотрудники Кафе</h2>
        <section class="section_s">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Выберите Кафе</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "Select Адрес FROM Кафе")
                            or die("Ошибка ". mysqli_error($dp));
                            if ($result)
                            {
                                while ($rows = mysqli_fetch_assoc($result)){
                                    $arr[] = array_values($rows);
                                }
                            }
                            mysqli_close($dp);
                            ?>
                            <select class="select" name="list">
                                <option value="0">Выберите кафе...</option>
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
                            <input type="submit" class="btn" name="cafe" value="Подробнее">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
    </div>
    <div class="right">
        <section class="section_right">
            <?php
            if(isset($_POST["add"]))
            {
                add($_POST["sname"], $_POST["name"], $_POST["lname"], $_POST["phone"], $_POST["card"]);
            }
            if(isset($_POST["del"]))
            {
                del($_POST["klient"]);
            }
            if(isset($_POST['update']))
            {
                update($_POST["assort"], $_POST["opis"], $_POST["price"]);
            }
            if(isset($_POST['cafe']))
            {
                printZP($_POST['list']);
            }
            ?>
        </section>
    </div>
</div>
</body>
</html>
<?php
function add($sname, $name, $lname, $phone, $card)
{
    include "setup.php";
    $result = mysqli_query($dp, "Insert Into Клиент (Фамилия, Имя, Отчество, Телефон, Номер_карты) 
    values ('$sname', '$name', '$lname', '$phone', '$card')")
    or die("Ошибка добавления данных". mysqli_error($dp));
    printTable();
}

function del($card) {
    include "setup.php";
    $result = mysqli_query($dp,"DELETE FROM Клиент WHERE Номер_карты LIKE '$card'") or die("Ошибка удаления направления" . mysqli_error($dp));
    mysqli_close($dp);
    printTable();
}

function printTable(){
    include "setup.php";
    $result = mysqli_query($dp, "SELECT Фамилия, Имя, Отчество, Телефон, Номер_карты FROM Клиент")
    or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result) {
        $table="<table class='table'align='center' cellpadding='0' cellspacing='0'>
<tr>
        <th class='td'>Фамилия</th><th class='td'>Имя</th>
        <th class='td'>Отчество</th><th class='td'>Телефон</th>
        <th class='td'>Номер карты</th></tr>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='td'>".$row['Фамилия']."</td>";
            $table .= "<td class='td'>".$row['Имя']."</td>";
            $table .= "<td class='td'>".$row['Отчество']."</td>";
            $table .= "<td class='td'>".$row['Телефон']."</td>";
            $table .= "<td class='td'>".$row['Номер_карты']."</td>";
            $table .= "</tr>";
        }
        $table .="</table>";
        echo $table;
    }
    mysqli_close($dp);
}

function update($assort, $opis, $price) {
    include "setup.php";
    $req_upd = "UPDATE Ассортимент SET Описание_вып = '$opis', Цена = $price WHERE Наименование_вып = '$assort'";
    $req_upd = mysqli_query($dp, $req_upd) or die("Ошибка ошибка изменения"  . mysqli_error($dp));
    mysqli_close($dp);
    printUpd();
}
function printUpd()
{
    include "setup.php";
    $result = mysqli_query($dp, 'SELECT *, Тип.Наименование FROM Ассортимент INNER JOIN Тип ON (Ассортимент.ID_Типа = Тип.ID_Типа)') or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result) {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr><th class='td'>Наименование</th><th class='td'>Описание</th>
        <th class='td'>Цена</th><th class='td'>Тип</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='td'>" . $row['Наименование_вып'] . "</td>";
            $table .= "<td class='td'>" . $row['Описание_вып'] . "</td>";
            $table .= "<td class='td'>" . $row['Цена'] . "</td>";
            $table .= "<td class='td'>" . $row['Наименование'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
}

function printZP($cafel)
{
    include "setup.php";
    $result = 'SELECT *, Кафе.Адрес, Должность.Название FROM Сотрудник INNER JOIN 
        Кафе ON (Сотрудник.ID_кафе = Кафе.ID_кафе) INNER JOIN Должность ON (Сотрудник.ID_Должности = Должность.ID_Должности)
        WHERE Адрес LIKE \'' . $cafel . '\'';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
    if($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr><th class='td'>Фамилия</th><th class='td'>Имя</th>
        <th class='td'>Отчество</th><th class='td'>Должность</th>
        <th class='td'>Адрес</th></tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='td'>".$row['Фамилия']."</td>";
            $table .= "<td class='td'>".$row['Имя']."</td>";
            $table .= "<td class='td'>".$row['Отчество']."</td>";
            $table .= "<td class='td'>".$row['Название']."</td>";
            $table .= "<td class='td'>".$row['Адрес']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
}