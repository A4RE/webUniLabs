<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
    <title>Lab_3</title>
</head>
<body>
<header>
    <h1>National Basketball Assosiation</h1>
</header>
<section class="sec1">
    <div class="left-1">
        <h2  class="h2">Список Команд</h2>
    </div>
    <div class="right-1">
    <form method="POST">
        <section class="sec2">
        <?php
        printTable()
        ?>
        </section>
    </form>
    </div>
</section>
<section>
    <!--Левая часть-->
    <div class="left">
        <h2>Добавить Конференцию</h2>
        <section class="sec_2">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label type="checkbox">Конференция </label>
                        </td>
                        <td>
                            <input type="text" name="konfname" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input align="center" type="submit" class="border-button" name="add" value="Добавить данные">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <h2>Удалить конференцию</h2>
        <section class="sec_2">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Конференция</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "SELECT Название_конф FROM Конференция") or
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
                        <td></td>
                        <td>
                            <br>
                            <input class="border-button" type="submit" name="del" value="Удалить">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <h2>Обновление данных</h2>
        <section class="sec_2">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Обновление команды</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $result1 = mysqli_query($dp, "Select Название FROM Команды") or
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
                            <br>
                            <input type="number" name="pobed" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type="submit" class="border-button" name="update" value="Изменить">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <h2>Команды по конференциям</h2>
        <section class="sec_2">
            <form method="POST">
                <table>
                    <tr>
                        <td>Выберите конференцию</td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "SELECT Название_конф FROM Конференция") or
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
                                <option value="0">Выберите Конференцию...</option>
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
                            <br>
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
                add($_POST["konfname"]);
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
</section>
</body>
</html>

<?php
function printTable(){
    include "setup.php";
    $result = 'SELECT *,  Конференция.Название_конф FROM Конференция INNER JOIN Команды ON (Команды.ID_Конференции = Конференция.ID_конф ) ORDER BY Позиция_в_лиге';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
    if($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>Команда</th><th class='tbl_1'>Победы</th>
        <th class='tbl_1'>Поражения</th><th class='tbl_1'>Конференция</th>
        <th class='tbl_1'>Позиция в Конференции</th><th class='tbl_1'>Позиция в Лиге</th>
        <th class='tbl_1'>Штат</th></tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['Название']."</td>";
            $table .= "<td class='tbl_1'>".$row['Кол_побед']."</td>";
            $table .= "<td class='tbl_1'>".$row['Кол_поражений']."</td>";
            $table .= "<td class='tbl_1'>".$row['Название_конф']."</td>";
            $table .= "<td class='tbl_1'>".$row['Позиция_в_конф']."</td>";
            $table .= "<td class='tbl_1'>".$row['Позиция_в_лиге']."</td>";
            $table .= "<td class='tbl_1'>".$row['Штат']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
}
function add($konfname){
    include "setup.php";
    $result = mysqli_query($dp, "INSERT INTO Конференция (Название_конф) VALUES ('$konfname')")
    or die("Ошибка добавления данных". mysqli_error($dp));
    printU();
}
function printU(){
    include "setup.php";
    $result = mysqli_query($dp, "SELECT * FROM Конференция") or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result)
    {
        $table="<table class='table1'align='center' cellpadding='0' cellspacing='0'><tr><th class='tbl_1'>№</th><th class='tbl_1'>Конференция</th></tr>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['ID_конф']."</td>";
            $table .= "<td class='tbl_1'>".$row['Название_конф']."</td>";
            $table .= "</tr>";
        }
        $table .="</table>";
        echo $table;
    }
    mysqli_close($dp);
}

function del($name) {
    include "setup.php";
    $result = mysqli_query($dp,"DELETE FROM Конференция WHERE Название_конф LIKE '$name'") or die("Ошибка удаления направления" . mysqli_error($dp));
    mysqli_close($dp);
    printU();
}
function update($name, $pobed){
    include "setup.php";
    $req_upd = "UPDATE Команды SET Кол_побед = $pobed WHERE Название = '$name'";
    $req_upd = mysqli_query($dp, $req_upd) or die("Ошибка ошибка изменения"  . mysqli_error($dp));
    mysqli_close($dp);
    printPh();
}

function printPh()
{
    include "setup.php";
    $result = mysqli_query($dp, 'SELECT * FROM Команды') or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result) {
        $table = "<center><table class='table1' cellpadding='0' cellspacing='0'><tr><th class='tbl_1'>Команда</th><th class='tbl_1'>Количество побед</th><th class='tbl_1'>Количество поражений</th><th class='tbl_1'>Город</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['Название'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Кол_побед'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Кол_поражений'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Штат'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
}

function printHT($name)
{
    include "setup.php";
    $result = 'SELECT *, Конференция.Название_конф FROM Команды INNER JOIN Конференция ON (Команды.ID_Конференции = Конференция.ID_конф) WHERE Название_конф LIKE \'' . $name . '\'';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result) {
        $table = "<center><table class='table1' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>Команда</th><th class='tbl_1'>Победы</th><th class='tbl_1'>Поражения</th><th class='tbl_1'>Штат</th><th class='tbl_1'>Конференция</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['Название'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Кол_побед'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Кол_поражений'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Штат'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Название_конф'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}