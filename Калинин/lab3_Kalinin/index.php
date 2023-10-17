<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Lab №3</title>
  <link href="styleS.css" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<header>
  <h1 align="center">Сборки ПК</h1>
</header>
<h2 align="center" class="title_zad1">Задание 1</h2>
<div class="table_div_mnog">
    <form method="post">
        <?php
        include "connect.php";
        $result = 'Select *, 
        Видеокарты.Фирма_видеокарты, Видеокарты.Серия_видеокарты, 
        Материнская_плата.Фирма_матплаты,
        Память_ОЗУ.Тип_ОЗУ, Память_ПЗУ.Тип_ПЗУ, Память_ПЗУ.Фирма_ПЗУ, Память_ПЗУ.Размер_ПЗУ,
        Процессоры.Фирма_процессора, Процессоры.Процессор From системный_блок 
            INNER JOIN Видеокарты ON (системный_блок.ID_видеокарты = Видеокарты.ID_видеокарты)
            INNER JOIN Материнская_плата ON (системный_блок.ID_матплаты = Материнская_плата.ID_матплаты)
            INNER JOIN Память_ОЗУ ON (системный_блок.ID_пам_ОЗУ = Память_ОЗУ.ID_ОЗУ)
            INNER JOIN Память_ПЗУ ON (системный_блок.ID_пам_ПЗУ = Память_ПЗУ.ID_ПЗУ)
            INNER JOIN Процессоры ON (системный_блок.ID_процессора = Процессоры.ID_процессора) ORDER BY ID_сис_блока';
        $result = mysqli_query($db, $result) or die("Ошибка запроса Select". mysqli_error($dp));
        if($result)
        {
            $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th class='tbl_1'>№ Системного блока</th>
        <th class='tbl_1'>Фирма видеокарты</th>
        <th class='tbl_1'>Серия видеокарты</th>
        <th class='tbl_1'>Фирма материнской платы</th>
        <th class='tbl_1'>Тип ОЗУ</th>
        <th class='tbl_1'>Тип ПЗУ</th>
        <th class='tbl_1'>Фирма ПЗУ</th>
        <th class='tbl_1'>Размер ПЗУ</th>
        <th class='tbl_1'>Фирма процессора</th>
        <th class='tbl_1'>Процессор</th>
        </tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                $table .= "<tr>";
                $table .= "<td class='tbl_1'>".$row['ID_сис_блока']."</td>";
                $table .= "<td class='tbl_1'>".$row['Фирма_видеокарты']."</td>";
                $table .= "<td class='tbl_1'>".$row['Серия_видеокарты']."</td>";
                $table .= "<td class='tbl_1'>".$row['Фирма_матплаты']."</td>";
                $table .= "<td class='tbl_1'>".$row['Тип_ОЗУ']."</td>";
                $table .= "<td class='tbl_1'>".$row['Тип_ПЗУ']."</td>";
                $table .= "<td class='tbl_1'>".$row['Фирма_ПЗУ']."</td>";
                $table .= "<td class='tbl_1'>".$row['Размер_ПЗУ']."</td>";
                $table .= "<td class='tbl_1'>".$row['Фирма_процессора']."</td>";
                $table .= "<td class='tbl_1'>".$row['Процессор']."</td>";
                $table .= "</tr>";
            }
            $table .="</table></center>";
            echo $table;
        }
        ?>
    </form>
</div>
<h2 align="center" class="title">Работа с формами</h2>
<div class="forms-section">
    <h2 align="center">
        Добавить процессор
    </h2>
    <div class="work">
        <form method="post">
        <table>
            <tr>
                <td>
                    <label>Фирма процессора</label>
                </td>
                <td>
                    <input type="text" name="firm" class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Серия процессора</label>
                </td>
                <td>
                    <input type="text" name="series" class="input">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Название процессора</label>
                </td>
                <td>
                    <input type="text" name="proc_name" class="input">
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
    <h2 align="center">
        Удалить процессор
    </h2>
    <div class="work">
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Процессор</label>
                    </td>
                    <td>
                        <?php
                        include "connect.php";
                        $arr = array();
                        $result = mysqli_query($db, "Select Процессор From Процессоры")
                        or die("Ошибка ". mysqli_error($db));
                        if ($result){
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($db);
                        ?>
                        <select class="select" name="proc">
                            <option value="0">Выберите...</option>
                            <?php
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['proc'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
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
    <h2 align="center">
        Обновить данные
    </h2>
    <div class="work">
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Процессор</label>
                    </td>
                    <td>
                        <?php
                        include "connect.php";
                        $arr = array();
                        $result = mysqli_query($db, "Select Процессор From Процессоры")
                        or die("Ошибка ". mysqli_error($db));
                        if ($result){
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($db);
                        ?>
                        <select class="select" name="proc1">
                            <option value="0">Выберите...</option>
                            <?php
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['proc1'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            Серия процессора
                        </label>
                    </td>
                    <td>
                        <input type="text" name="ser" class="input">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn" name="update" value="Изменить">
                    </td>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <h2 align="center">
        Вывод с параметром
    </h2>
    <div class="work">
        <form method="post">
            <tr>
                <td>
                    Выберите Тип ПО
                </td>
                <td>
                <?php
                include "connect.php";
                $arr = array();
                $result = mysqli_query($db, "SELECT Тип_ПО FROM Программное_обеспечение") or
                die("Ошибка ". mysqli_error($db));
                if ($result)
                {
                    while ($rows = mysqli_fetch_assoc($result)){
                        $arr[] = array_values($rows);
                    }
                }
                mysqli_close($db);
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
                    <input type="submit" class="btn" name="b" value="Подробнее">
                </td>
            </tr>
        </form>
    </div>
</div>
<h2 align="center">Вывод таблиц</h2>
<div class="result-forms">
    <?php
    if(isset($_POST["add"]))
    {
        add($_POST['firm'], $_POST['series'], $_POST['proc_name']);
    }
    if(isset($_POST["del"]))
    {
        del($_POST["proc"]);
    }
    if(isset($_POST['update']))
    {
        update($_POST["proc1"], $_POST["ser"]);
    }
    if(isset($_POST['b']))
    {
        printParam($_POST['list']);
    }
    ?>
</div>
</body>
</html>

<?php
function add($firm, $series, $proc_name){
    include "connect.php";
    $result = mysqli_query($db, "INSERT INTO Процессоры (Фирма_процессора, Серия_процессора, Процессор) values ('$firm', '$series', '$proc_name')")
    or die("Ошибка добавления данных". mysqli_error($db));
    printAddDelUpd();
}

function del($name) {
    include "connect.php";
    $result = mysqli_query($db, "Delete from Процессоры Where Процессор LIKE '$name'")
    or die("Ошибка удаления направления" . mysqli_error($db));
    mysqli_close($db);
    printAddDelUpd();
}

function update($name, $ser) {
    include "connect.php";
    $result = mysqli_query($db, "Update Процессоры SET Серия_процессора = '$ser' WHERE Процессор = '$name'")
    or die("Ошибка удаления направления" . mysqli_error($db));
    mysqli_close($db);
    printAddDelUpd();
}

function printAddDelUpd() {
    include "connect.php";
    $result = mysqli_query($db, "SELECT Фирма_процессора, Серия_процессора, Процессор FROM Процессоры")
    or die("Ошибка запроса Select пользователь" . mysqli_error($db));
    if($result)
    {
        $table="<table class='table1'align='center' cellpadding='0' cellspacing='0'>
        <tr>
        <th>Фирма</th>
        <th>Серия</th>
        <th>Название</th></tr>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td>".$row['Фирма_процессора']."</td>";
            $table .= "<td>".$row['Серия_процессора']."</td>";
            $table .= "<td>".$row['Процессор']."</td>";
            $table .= "</tr>";
        }
        $table .="</table>";
        echo $table;
    }
    mysqli_close($db);
}

function printParam($name) {
    include "connect.php";
    $result = 'Select *, Программное_обеспечение.Тип_ПО, Программное_обеспечение.ПО, Клиент.ФИО
    from Покупатель 
        INNER JOIN Программное_обеспечение ON (Покупатель.ID_по = Программное_обеспечение.ID_ПО) 
        INNER JOIN Клиент ON (Покупатель.ID_клиента = Клиент.ID_клиента) where Тип_ПО LIKE \'' . $name . '\'';
    $result = mysqli_query($db, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result) {
        $table = "<center><table class='table' cellpadding='0'>
        <tr>
        <th>ФИО</th>
        <th>Тип_ПО</th>
        <th>ПО</th>
        <th>Дата</th>
        <th>Количество</th>
        <th>Цена</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>";
            $table .= "<td>" . $row['ФИО'] . "</td>";
            $table .= "<td>" . $row['Тип_ПО'] . "</td>";
            $table .= "<td>" . $row['ПО'] . "</td>";
            $table .= "<td>" . $row['Дата'] . "</td>";
            $table .= "<td>" . $row['Количество'] . "</td>";
            $table .= "<td>" . $row['Цена'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table></center>";
        echo $table;
    }
    mysqli_close($db);
}