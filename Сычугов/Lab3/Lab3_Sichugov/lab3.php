<!doctype html>
<html lang="ru">
<head>
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Lab_3</title>
</head>
<body>
<header>
    <h1>Континентальная хоккейная лига</h1>
</header>
<section>
    <section class="section1">
        <h2>История Турниров</h2>
    </section>
        <form method="POST">
            <section class="section2">
            <?php
            printTable();
            ?>
            </section>
        </form>
</section>
<section class="formi">
    <h2>Взаимодействие с Формами</h2>
</section>
<!--Секции Добавления Удаления Обновления Параметр-->
<section class="section3">
<!--Левая часть-->
<div class="left">
    <h2>Добавить</h2>
<!--    Секция Добавления-->
    <section class="sec_2">
        <form method="POST">
            <table>
                <tr>
                    <td>
                        <label type="checkbox">Добавить Судью</label>
                    </td>
                    <td>
                        <input type="text" name="name" class="inp">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input align="center" type="submit" class="border-button" name="add" value="Добавить данные">
                    </td>
                </tr>
            </table>
        </form>
    </section>
    <h2>Удаление</h2>
<!--    Секция Удаления-->
    <section class="sec_2"">
        <form method="POST">
            <table>
                <tr>
                    <td>
                        <label>Судья</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, "SELECT ФИО FROM Судья") or
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
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input class="border-button" type="submit" name="del" value="Удалить">
                    </td>
                </tr>
            </table>
        </form>
    </section>
<!--    Секция обновления-->
    <h2>Обновление</h2>
    <section class="sec_2">
        <form method="POST">
            <table>
                <tr>
                    <td>
                        <label>Команда</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $result1 = mysqli_query($dp, "Select Название_команды FROM Команда") or
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
                        <label>Количество Побед</label>
                    </td>
                    <td>
                        <input type="number" name="pobed" class="inp">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" class="border-button" name="update" value="Изменить">
                    </td>
                </tr>
            </table>
        </form>
    </section>
    <h2>Информация об Игре</h2>
    <section class="sec_2">
        <form method="POST">
            <table>
                <tr>
                    <td>Выберите Игру</td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, "SELECT Название FROM Арена") or
                        die("Ошибка ". mysqli_error($dp));
                        if ($result)
                        {
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($dp);
                        ?>
                        <select class="select" name="list">
                            <option value="0">Выберите Арену...</option>
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
                    <td></td>
                    <td>
                        <input type="submit" class="border-button" name="b" value ="Подробнее">
                    </td>
                </tr>
            </table>
        </form>
    </section>
</div>
<div class="right">
    <section class="sec_3">
    <?php
    if(isset($_POST["add"]))
    {
        add($_POST["name"]);
    }
    if(isset($_POST["del"]))
    {
        del($_POST["list1"]);
    }
    if(isset($_POST['update']))
    {
        update($_POST["list2"], $_POST["pobed"]);
    }
    if(isset($_POST['b']))
    {
        printHT($_POST['list']);
    }
    ?>
    </section>
</div>
</body>
</html>

<?php
function printTable(){
    include "setup.php";
    $result = 'SELECT *,  Команда.Название_команды, Турнир.ID_Турнира FROM Турнир_Команда INNER JOIN Команда ON (Турнир_Команда.ID_Команды = Команда.ID_Команды) INNER JOIN Турнир ON (Турнир_Команда.ID_Турнира = Турнир.ID_Турнира)ORDER BY Название_команды';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
    if($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>Номер Турнира</th><th class='tbl_1'>Название Команды</th><th class='tbl_1'>Поражения</th><th class='tbl_1'>Победы</th></tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['ID_Турнира']."</td>";
            $table .= "<td class='tbl_1'>".$row['Название_команды']."</td>";
            $table .= "<td class='tbl_1'>".$row['Сумма_пораж']."</td>";
            $table .= "<td class='tbl_1'>".$row['Сумма_побед']."</td>";

            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
}
function add($name){
    include "setup.php";
    $result = mysqli_query($dp, "INSERT INTO Судья (ФИО) VALUES ('$name')") or die("Ошибка добавления данных". mysqli_error($dp));
    printU();
}
function printU(){
    include "setup.php";
    $result = mysqli_query($dp, "SELECT * FROM Судья") or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result)
    {
        $table="<table class='table1' align='center' cellpadding='4' cellspacing='0'>
        <tr><td><h3>Вывод с Таблицы с Добавлением/Удалением</h3></td></tr>
        <tr><th class='tbl_1'>№</th><th class='tbl_1'>ФИО</th>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['ID_Судьи']."</td>";
            $table .= "<td class='tbl_1'>".$row['ФИО']."</td>";
            $table .= "</tr>";
        }
        $table .="</table>";
        echo $table;
    }
    mysqli_close($dp);
}
function del($name) {
    include "setup.php";
    $result = mysqli_query($dp,"DELETE FROM Судья WHERE ФИО LIKE '$name'") or die("Ошибка удаления направления" . mysqli_error($dp));
    mysqli_close($dp);
    printU();
}
function update($name, $pobed){
    include "setup.php";
    $req_upd = "UPDATE Команда SET Кол_побед = $pobed WHERE Название_команды = '$name'";
    $req_upd = mysqli_query($dp, $req_upd) or die("Ошибка ошибка изменения"  . mysqli_error($dp));
    mysqli_close($dp);
    printPh();
}

function printPh()
{
    include "setup.php";
    $result = mysqli_query($dp, 'SELECT * FROM Команда') or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result) {
        $table = "<center><table class='table1' cellpadding='4' cellspacing='0'>
        <tr><td><h3>Обновление</h3></td></tr>
        <tr><th class='tbl_1'>Команда</th><th class='tbl_1'>Количество побед</th><th class='tbl_1'>Количество поражений</th><th class='tbl_1'>Город</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['Название_команды'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Кол_побед'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Кол_поражений'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Город'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
}

function printHT($name)
{
    include "setup.php";
    $result = 'SELECT *, Арена.Название FROM Игра INNER JOIN Арена ON (Игра.ID_Арены = Арена.ID_Арены) WHERE Название LIKE \'' . $name . '\'';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result) {

        $table = "<center><table class='table1' cellpadding='4' cellspacing='0'>
        <tr><td><h3>Вывод с параметром</h3></td></tr>
        <tr><th class='tbl_1'>Номер Игры</th><th class='tbl_1'>Арена</th><th class='tbl_1'>Вместимость</th><th class='tbl_1'>Город</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['ID_Игры'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Название'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Вместимость'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Город'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}