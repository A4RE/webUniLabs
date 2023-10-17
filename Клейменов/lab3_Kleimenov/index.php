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
    <h1>Строительный магазин</h1>
</header>
<h2>Прайс Лист</h2>
<!--Секция с многотабличным запросом-->
<div class="table_div_mnog">
    <form method="post">
        <input style="background: cadetblue" type="submit" name="vozr" value="По возрастанию">
        <br>
        <input style="background: cadetblue" type="submit" name="ubiv" value="По убыванию">
    </form>
    <?php
    if(isset($_POST['vozr']))
    {
        include "setup.php";
        $result = 'Select *,
        Макет.Название_макета, материал.название_материала, Фундамент.Тип from Ценновой_лист 
        INNER JOIN Макет on (Ценновой_лист.id_шаблона  = Макет.id_макета) 
        INNER JOIN Материал on (Ценновой_лист.id_материала = материал.id_материала)
        INNER JOIN Фундамент on (Ценновой_лист.id_фундамента = Фундамент.id_фундамента) order by id_листа ASC';
        $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
        if($result)
        {
            $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ID Листа</th>
        <th>Макет</th>
        <th>Материал</th>
        <th>Фундамент</th>
        <th>Цена</th>
        </tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                $table .= "<tr>";
                $table .= "<td>".$row['id_листа']."</td>";
                $table .= "<td>".$row['Название_макета']."</td>";
                $table .= "<td>".$row['название_материала']."</td>";
                $table .= "<td>".$row['Тип']."</td>";
                $table .= "<td>".$row['Стоимость']."</td>";
                $table .= "</tr>";
            }
            $table .="</table></center>";
            echo $table;
        }
    }
    if(isset($_POST['ubiv']))
    {
        include "setup.php";
        $result = 'Select *,
        Макет.Название_макета, материал.название_материала, Фундамент.Тип from Ценновой_лист 
        INNER JOIN Макет on (Ценновой_лист.id_шаблона  = Макет.id_макета) 
        INNER JOIN Материал on (Ценновой_лист.id_материала = материал.id_материала)
        INNER JOIN Фундамент on (Ценновой_лист.id_фундамента = Фундамент.id_фундамента) order by id_листа DESC';
        $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
        if($result)
        {
            $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ID Листа</th>
        <th>Макет</th>
        <th>Материал</th>
        <th>Фундамент</th>
        <th>Цена</th>
        </tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                $table .= "<tr>";
                $table .= "<td>".$row['id_листа']."</td>";
                $table .= "<td>".$row['Название_макета']."</td>";
                $table .= "<td>".$row['название_материала']."</td>";
                $table .= "<td>".$row['Тип']."</td>";
                $table .= "<td>".$row['Стоимость']."</td>";
                $table .= "</tr>";
            }
            $table .="</table></center>";
            echo $table;
        }
    }
    ?>
</div>

<!--Работа с запросами-->
<div class="form-section">
    <div class="form">
        <h2>Добавить материал</h2>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Название материала</label>
                    </td>
                    <td>
                        <input type="text" name="mat" class="input" placeholder="Введите название материала">
                    </td>
                <tr>
                    <td>
                        <input type="submit" class="btn" name="add" value="Добавить">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="form">
        <h2>Удалить материал</h2>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Материал</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, 'Select название_материала from материал')
                        or die("Ошибка ". mysqli_error($dp));
                        if ($result){
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($dp);
                        ?>
                        <select class="select" name="material">
                            <option value="0">Выберите...</option>
                            <?php
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['material'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
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
                        <label>Сотрудник</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, 'Select ФИО_сотрудника from Сотрудник')
                        or die("Ошибка ". mysqli_error($dp));
                        if ($result){
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($dp);
                        ?>
                        <select class="select-1" name="sotrudnik">
                            <option value="0">Выберите...</option>
                            <?php
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['sotrudnik'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Телефон</label>
                    </td>
                    <td>
                        <input type="text" name="phone" class="input-1" placeholder="Введите новый телефон">
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
        <h2>Вывод ценового листа по макетам</h2>
        <form method="post">
            <tr>
                <td>
                    <label>Макет</label>
                </td>
                <td>
                    <?php
                    include "setup.php";
                    $arr = array();
                    $result = mysqli_query($dp, 'Select Название_макета from макет')
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
                    <select class="select-2" name="list">
                        <option value="0">Выберите макет...</option>
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
        add($_POST['mat']);
    }
    if(isset($_POST['del']))
    {
        echo "<h2>Таблица после удаления:</h2>";
        del($_POST['material']);
    }
    if(isset($_POST['update']))
    {
        echo "<h2>Таблица после обновления:</h2>";
        update($_POST["sotrudnik"], $_POST["phone"]);
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
function add($name) {
    include "setup.php";
    $result = mysqli_query($dp, "INSERT INTO материал (`id_материала`, `название_материала`) VALUES (NULL, '$name')")
    or die("Ошибка добавления". mysqli_error($dp));
    printAddDel();
}
function del($name) {
    include "setup.php";
    $result = mysqli_query($dp, "Delete from материал WHERE название_материала like '$name'")
    or die("Ошибка добавления". mysqli_error($dp));
    mysqli_close($dp);
    printAddDel();
}

function update($sotrudnik, $phone)
{
    include "setup.php";
    $result = mysqli_query($dp, "Update Сотрудник SET Телефон_сотрудника = '$phone' WHERE ФИО_сотрудника = '$sotrudnik'")
    or die("Ошибка удаления направления" . mysqli_error($dp));
    mysqli_close($dp);
    printUpd();
}

function printUpd(){
    include "setup.php";
    $result = mysqli_query($dp,
        "SELECT * from Сотрудник")
    or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result)
    {
        $table="<center><table class='table1'align='center' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>email</th>
        <th>Должность</th>
        </tr>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td>".$row['ФИО_сотрудника']."</td>";
            $table .= "<td>".$row['Телефон_сотрудника']."</td>";
            $table .= "<td>".$row['email_сотр']."</td>";
            $table .= "<td>".$row['Должность']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}

function printAddDel(){
    include "setup.php";
    $result = mysqli_query($dp, "SELECT * FROM материал")
    or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result)
    {
        $table="<center><table class='table'align='center' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ID</th>
        <th>Название материала</th>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td>".$row['id_материала']."</td>";
            $table .= "<td>".$row['название_материала']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}

function printParam($name){
    include "setup.php";
    $result = 'Select *,
        Макет.Название_макета, материал.название_материала, Фундамент.Тип from Ценновой_лист 
        INNER JOIN Макет on (Ценновой_лист.id_шаблона  = Макет.id_макета) 
        INNER JOIN Материал on (Ценновой_лист.id_материала = материал.id_материала)
        INNER JOIN Фундамент on (Ценновой_лист.id_фундамента = Фундамент.id_фундамента)
        WHERE Макет.Название_макета LIKE \'' . $name . '\'';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ID Листа</th>
        <th>Макет</th>
        <th>Материал</th>
        <th>Фундамент</th>
        <th>Цена</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td>".$row['id_листа']."</td>";
            $table .= "<td>".$row['Название_макета']."</td>";
            $table .= "<td>".$row['название_материала']."</td>";
            $table .= "<td>".$row['Тип']."</td>";
            $table .= "<td>".$row['Стоимость']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}
