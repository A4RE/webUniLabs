<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
    <title>Lab_3</title>
</head>
<body>
<header>
    <h1>Продажа Автомобилей</h1>
</header>
<section>
    <section class="first_section">
    <h2>Покупки Клиентов</h2>
    </section>
    <form method="POST">
        <section class="second_section">
        <?php
        printTable()
        ?>
        </section>
    </form>
</section>
<section class="third_section">
    <!--Левая часть-->
    <div class="left">
        <h2>Добавить Сотрудника</h2>
        <section class="section_cng">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label type="checkbox">Имя</label>
                        </td>
                        <td>
                            <input type="text" name="name" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <label>Фамилия</label>
                        </td>
                        <td>
                            <br>
                            <input type="text" name="sname" class="inp">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <label>Отчество</label>
                        </td>
                        <td>
                            <br>
                            <input type="text" name="sdname" class="inp">
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
        <h2>Удалить Сотрудника</h2>
        <section class="section_cng">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Сотрудник</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "SELECT Фамилия FROM Сотрудники") or
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
                            <br>
                            <input class="border-button" type="submit" name="del" value="Удалить">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <h2>Обновление данных</h2>
        <section class="section_cng">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Автомобиль</label>
                        </td>
                        <td>
                            <?php
                            include "setup.php";
                            $result1 = mysqli_query($dp, "Select Модель FROM Автомобили") or
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
                            <label>Цена</label>
                        </td>
                        <td>
                            <br>
                            <input type="number" name="price" class="inp">
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
        <h2>Марки Клиентов</h2>
        <section class="section_cng">
            <form method="POST">
                <table>
                    <tr>
                        <td>Выберите Марку</td>
                        <td>
                            <?php
                            include "setup.php";
                            $arr = array();
                            $result = mysqli_query($dp, "SELECT Название FROM Автопроизводители") or
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
                                <option value="0">Выберите производителя...</option>
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
        <section class="fourth_section">
            <?php
            if(isset($_POST["add"]))
            {
                add($_POST["name"], $_POST["sname"], $_POST["sdname"]);
            }
            if(isset($_POST["del"]))
            {
                del($_POST["list1"]);
            }
            if(isset($_POST['update']))
            {
                update($_POST["list2"], $_POST["price"]);
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
    $result = 'SELECT *, Автопроизводители.Название, Автомобили.Модель, Прибыль.Сумма FROM Клиенты INNER JOIN 
    Автопроизводители ON (Клиенты.ID_Организации = Автопроизводители.ID_Организации)
    INNER JOIN Автомобили ON (Клиенты.ID_Автомобиля = Автомобили.ID_Авто) INNER JOIN Прибыль ON (Клиенты.ID_Прибыли = Прибыль.ID_Прибыли) ORDER BY Название';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
    if($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr><th class='tbl_1'>Имя</th><th class='tbl_1'>Фамилия</th>
        <th class='tbl_1'>Отчество</th><th class='tbl_1'>Марка</th>
        <th class='tbl_1'>Модель</th><th class='tbl_1'>Сумма</th></tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['Имя']."</td>";
            $table .= "<td class='tbl_1'>".$row['Фамилия']."</td>";
            $table .= "<td class='tbl_1'>".$row['Отчество']."</td>";
            $table .= "<td class='tbl_1'>".$row['Название']."</td>";
            $table .= "<td class='tbl_1'>".$row['Модель']."</td>";
            $table .= "<td class='tbl_1'>".$row['Сумма']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
}
function add($name, $sname, $sdname){
    include "setup.php";
    $result = mysqli_query($dp, "INSERT INTO Сотрудники (Имя, Фамилия, Отчество) VALUES ('$name', '$sname', '$sdname')")
    or die("Ошибка добавления данных". mysqli_error($dp));
    printU();
}

function printU(){
    include "setup.php";
    $result = mysqli_query($dp, "SELECT Фамилия, Имя, Отчество FROM Сотрудники") or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result)
    {
        $table="<table class='table1'align='center' cellpadding='0' cellspacing='0'><tr><th class='tbl_1'>Фамилия</th><th class='tbl_1'>Имя</th>
        <th class='tbl_1'>Отчество</th></tr>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>".$row['Фамилия']."</td>";
            $table .= "<td class='tbl_1'>".$row['Имя']."</td>";
            $table .= "<td class='tbl_1'>".$row['Отчество']."</td>";
            $table .= "</tr>";
        }
        $table .="</table>";
        echo $table;
    }
    mysqli_close($dp);
}
function del($name) {
    include "setup.php";
    $result = mysqli_query($dp,"DELETE FROM Сотрудники WHERE Фамилия LIKE '$name'") or die("Ошибка удаления направления" . mysqli_error($dp));
    mysqli_close($dp);
    printU();
}
function update($name, $price){
    include "setup.php";
    $req_upd = "UPDATE Автомобили SET Цена = $price WHERE Модель = '$name'";
    $req_upd = mysqli_query($dp, $req_upd) or die("Ошибка ошибка изменения"  . mysqli_error($dp));
    mysqli_close($dp);
    printPh();
}

function printPh()
{
    include "setup.php";
    $result = mysqli_query($dp, 'SELECT * FROM Автомобили') or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result) {
        $table = "<center><table class='table1' cellpadding='0' cellspacing='0'><tr><th class='tbl_1'>Марка</th><th class='tbl_1'>Модель</th><th class='tbl_1'>Мощность</th><th class='tbl_1'>Цена</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['Марка'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Модель'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Мощность'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Цена'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
}

function printHT($name)
{
    include "setup.php";
    $result = 'SELECT *, Автопроизводители.Название, Автомобили.Модель FROM Клиенты INNER JOIN 
    Автопроизводители ON (Клиенты.ID_Организации = Автопроизводители.ID_Организации)
    INNER JOIN Автомобили ON (Клиенты.ID_Автомобиля = Автомобили.ID_Авто)  WHERE Название LIKE \'' . $name . '\'';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result) {
        $table = "<center><table class='table1' cellpadding='0'>
        <tr><th class='tbl_1'>Имя</th><th class='tbl_1'>Фамилия</th><th class='tbl_1'>Отчество</th><th class='tbl_1'>Марка</th><th class='tbl_1'>Модель</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td class='tbl_1'>" . $row['Имя'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Фамилия'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Отчество'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Название'] . "</td>";
            $table .= "<td class='tbl_1'>" . $row['Модель'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;

    }
    mysqli_close($dp);
}