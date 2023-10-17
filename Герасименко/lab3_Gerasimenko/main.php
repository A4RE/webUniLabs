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
    <h1>Зоопарки</h1>
</header>
<!--Секция с многотабличным запросом-->
<div class="main_section">
    <div class="h2">
        <h2>Животные и зоопарки</h2>
    </div>
    <div class="mnog-section">
        <form method="post">
            <?php
            printTable();
            ?>
        </form>
    </div>
</div>
<!--Секция с запросами и выводом-->
<div class="zapros_section">
<!--    Секция с выводом таблиц-->
    <div class="left-section">
        <?php
        if(isset($_POST["add"]))
        {
            add($_POST["name"], $_POST["town"], $_POST["year"], $_POST["phone"]);
        }
        if(isset($_POST["del"]))
        {
            del($_POST["list1"]);
        }
        if(isset($_POST['update']))
        {
            update($_POST["list2"], $_POST["salary"]);
        }
        if(isset($_POST['b']))
        {
            printHT($_POST['list3']);
        }
        ?>
    </div>
<!--    Секция с запросами-->
    <div class="right-section">
        <h2>Добавить Зоопарк</h2>
<!--        Добавить-->
        <div class="forms">
            <form method="post">
                <table>
                    <tr>
                        <td>
                            <label>Название зоопарка</label>
                        </td>
                        <td>
                            <input type="text" name="name" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Город зоопарка</label>
                        </td>
                        <td>
                            <input type="text" name="town" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Год открытия</label>
                        </td>
                        <td>
                            <input type="number" name="year" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Телефон зоопарка</label>
                        </td>
                        <td>
                            <input type="text" name="phone" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input align="center" type="submit" class="border-button" name="add" value="Добавить данные">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
<!--        Удалить-->
        <h2>Удалить зоопарк</h2>
        <div class="forms">
            <form method="post">
                <table>
                    <tr>
                        <td>
                            <label>Зоопарк</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "SELECT Назв_зпарка FROM Зоопарк") or
                            die("Ошибка ". mysqli_error($dp));
                            if ($result){
                                while ($rows = mysqli_fetch_assoc($result)){
                                    $arr[] = array_values($rows);
                                }
                            }
                            mysqli_close($dp);
                            ?>
                            <select class="select" name="list1">
                                <option value="0">Выберите...</option>
                                <?php
                                foreach ($arr as $k){
                                    foreach ($k as $Value)
                                    {
                                        echo '<option value="'.$Value.'"'.($Value == $_POST['list1'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="border-button" type="submit" name="del" value="Удалить">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
<!--        Обновить-->
        <h2>Обновить данные о сотруднике</h2>
        <div class="forms">
            <form method="post">
                <table>
                    <tr>
                        <td>
                            <label>ФИО</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $result1 = mysqli_query($dp, "Select ФИО FROM Сотрудник") or
                            die("Ошибка ". mysqli_error($dp));
                            if($result1){
                                while ($rows1 = mysqli_fetch_assoc($result1))
                                {
                                    $arr1[] = array_values($rows1);
                                }
                            }
                            mysqli_close($dp);
                            ?>
                            <select class="select" name="list2">
                                <option value="0">Выберите</option>
                                <?php
                                foreach ($arr1 as $k)
                                {
                                    foreach ($k as $Value)
                                    {
                                        echo '<option value="'.$Value.'"'.($Value == $_POST['list2'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Оклад</label>
                        </td>
                        <td>
                            <input type="number" name="salary" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="border-button" name="update" value="Изменить">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
<!--Вывод с параметром-->
        <h2>Вывести животных и их зоопарк</h2>
        <div class="forms">
            <form method="post">
                <table>
                    <tr>
                        <td>Выберите зоопарк</td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "SELECT Назв_зпарка FROM Зоопарк") or
                            die("Ошибка " . mysqli_error($dp));
                            if ($result) {
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    $arr[] = array_values($rows);
                                }
                            }
                            mysqli_close($dp);
                            ?>
                            <select class="select" name="list3">
                                <option value="0">Выберите...</option>
                                <?php
                                foreach ($arr as $k){
                                    foreach ($k as $Value){
                                        echo '<option value="'.$Value.'"'.($Value == $_POST['list3'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="border-button" name="b" value="Подробнее">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
function printTable() {
    include "setup.php";
    $result = 'SELECT *, Зоопарк.Назв_зпарка, Виды_жив.Назв_вида FROM Животные 
    INNER JOIN Зоопарк ON (Животные.ID_зоопарка = Зоопарк.ID_зоопарка) INNER JOIN Виды_жив ON (Животные.ID_вида = Виды_жив.ID_вида) ORDER BY Назв_вида';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
    if ($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>Животное</th><th class='tbl_1'>Кличка</th>
        <th class='tbl_1'>Родина</th><th class='tbl_1'>Зоопарк</th></tr>";
        while ($row = mysqli_fetch_assoc($result)){
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['Назв_вида']."</td>";
            $table .= "<td class='tbl_1'>".$row['Кличка']."</td>";
            $table .= "<td class='tbl_1'>".$row['Родина']."</td>";
            $table .= "<td class='tbl_1'>".$row['Назв_зпарка']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
}

function add($name, $town, $year, $phone)
{
    include "setup.php";
    $result = mysqli_query($dp, "INSERT INTO Зоопарк (Назв_зпарка, Город, Год_открытия, Телефон) 
    VALUES ('$name', '$town', $year, '$phone')")
    or die("Ошибка добавления данных". mysqli_error($dp));
    printTAD();
}

function del($name_zoo) {
    include "setup.php";
    $result = mysqli_query($dp,"DELETE FROM Зоопарк WHERE Назв_зпарка LIKE '$name_zoo'") or die("Ошибка удаления направления" . mysqli_error($dp));
    mysqli_close($dp);
    printTAD();
}
function printTAD()
{
    include "setup.php";
    $result = mysqli_query($dp, "Select Назв_зпарка, Город, Год_открытия, Телефон from Зоопарк") or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if ($result) {
        $table = "<table class='table1'align='center' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>Название</th>
        <th class='tbl_1'>Город</th><th class='tbl_1'>Год открытия</th>
        <th class='tbl_1'>Телефон</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['Назв_зпарка'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Город'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Год_открытия'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Телефон'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo $table;
    }
    mysqli_close($dp);
}

function update($name_sotr, $salary) {
    include "setup.php";
    $req_upd = "UPDATE Сотрудник SET Оклад = $salary WHERE ФИО = '$name_sotr'";
    $req_upd = mysqli_query($dp, $req_upd) or die("Ошибка ошибка изменения"  . mysqli_error($dp));
    mysqli_close($dp);
    printUPD();
}

function printUPD(){
    include "setup.php";
    $result = mysqli_query($dp, 'SELECT *, Должности.Назв_должн, Зоопарк.Назв_зпарка 
    FROM Сотрудник INNER JOIN Должности ON(Сотрудник.ID_должн = Должности.ID_Должности) 
        INNER JOIN Зоопарк ON(Сотрудник.ID_зоопарка = Зоопарк.ID_зоопарка)')
    or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result) {
        $table = "<center><table class='table1' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>ФИО</th>
        <th class='tbl_1'>Дата рождения</th>
        <th class='tbl_1'>Должность</th>
        <th class='tbl_1'>Оклад</th>
        <th class='tbl_1'>Зоопарк</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['ФИО'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Дата_рожд'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Назв_должн'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Оклад'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Назв_зпарка'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
}

function printHT($name) {
    include "setup.php";
    $result = 'SELECT *, Зоопарк.Назв_зпарка, Виды_жив.Назв_вида FROM Животные 
    INNER JOIN Зоопарк ON (Животные.ID_зоопарка = Зоопарк.ID_зоопарка) 
    INNER JOIN Виды_жив ON (Животные.ID_вида = Виды_жив.ID_вида) WHERE Назв_зпарка LIKE \'' . $name . '\'';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result) {
        $table = "<center><table class='table1' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>Животное</th><th class='tbl_1'>Кличка</th><th class='tbl_1'>Возраст</th>
        <th class='tbl_1'>Родина</th><th class='tbl_1'>Зоопарк</th><th class='tbl_1'>Дата поступления</th></tr>";
        while ($row = mysqli_fetch_assoc($result)){
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['Назв_вида']."</td>";
            $table .= "<td class='tbl_1'>".$row['Кличка']."</td>";
            $table .= "<td class='tbl_1'>".$row['Возраст']."</td>";
            $table .= "<td class='tbl_1'>".$row['Родина']."</td>";
            $table .= "<td class='tbl_1'>".$row['Назв_зпарка']."</td>";
            $table .= "<td class='tbl_1'>".$row['Дата_поступл']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}