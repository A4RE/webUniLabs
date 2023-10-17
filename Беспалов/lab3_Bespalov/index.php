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
    <h1>Магазин Мебели</h1>
</header>
<h2>Заказы в нашем магазине</h2>
<!--Секция с многотабличным запросом-->
<div class="table_div_mnog">
    <form method="post">
        <?php
        include "setup.php";
        $result = 'Select *,
        Клиент.ФИО, Тип_доставки.Название_типа from Заказ 
        INNER JOIN Клиент on (Заказ.ID_клиента = Клиент.ID_клиента) 
        INNER JOIN Тип_доставки on (Заказ.ID_тип_доставки = Тип_доставки.ID_типа_доставки)
        order by ID_заказа';
        $result = mysqli_query($dp, $result) or die("Ошибка запроса Select". mysqli_error($dp));
        if($result)
        {
            $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>Номер заказа</th>
        <th>ФИО Клиента</th>
        <th>Тип Доставки</th>
        <th>Дата заказа</th>
        <th>Сумма аказа</th>
        </tr>";
            while ($row = mysqli_fetch_assoc($result))
            {
                $table .= "<tr>";
                $table .= "<td>".$row['ID_заказа']."</td>";
                $table .= "<td>".$row['ФИО']."</td>";
                $table .= "<td>".$row['Название_типа']."</td>";
                $table .= "<td>".$row['Дата_заказа']."</td>";
                $table .= "<td>".$row['Сумма']."</td>";
                $table .= "</tr>";
            }
            $table .="</table></center>";
            echo $table;
        }
        ?>
    </form>
</div>

<!--Работа с запросами-->
<div class="form-section">
    <div class="form">
        <h2>Добавить клиента</h2>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>ФИО</label>
                    </td>
                    <td>
                        <input type="text" name="name" class="input" placeholder="Введите ФИО">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Пароль</label>
                    </td>
                    <td>
                        <input type="password" name="pass" class="input" placeholder="Введите пароль">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Адрес</label>
                    </td>
                    <td>
                        <input type="text" name="adres" class="input" placeholder="Введите адрес">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="email" class="input" placeholder="Введите email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Телефон</label>
                    </td>
                    <td>
                        <input type="text" name="phone" class="input" placeholder="Введите телефон">
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
        <h2>Удалить Клиента</h2>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label>Клиент</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, 'Select ФИО from Клиент')
                        or die("Ошибка ". mysqli_error($dp));
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
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['klient'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
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
                        <label>Модель мебели</label>
                    </td>
                    <td>
                        <?php
                        include "setup.php";
                        $arr = array();
                        $result = mysqli_query($dp, 'Select Название_модели from Модель')
                        or die("Ошибка ". mysqli_error($dp));
                        if ($result){
                            while ($rows = mysqli_fetch_assoc($result)){
                                $arr[] = array_values($rows);
                            }
                        }
                        mysqli_close($dp);
                        ?>
                        <select class="select-1" name="mebel">
                            <option value="0">Выберите...</option>
                            <?php
                            foreach ($arr as $k){
                                foreach ($k as $Value)
                                {
                                    echo '<option value="'.$Value.'"'.($Value == $_POST['mebel'] ? ' selected="selected"' : '').'>'.$Value.'</option>';
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
                        <input type="number" name="price" class="input-1" placeholder="Введите новую цену">
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
        <h2>Вывод заказов клиента</h2>
        <form method="post">
            <tr>
                <td>
                    <label>Клиент</label>
                </td>
                <td>
                    <?php
                    include "setup.php";
                    $arr = array();
                    $result = mysqli_query($dp, 'Select ФИО from Клиент')
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
                        <option value="0">Выберите клиента...</option>
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
        add($_POST['name'], $_POST['pass'], $_POST['adres'], $_POST['email'], $_POST['phone']);
    }
    if(isset($_POST['del']))
    {
        echo "<h2>Таблица после удаления:</h2>";
        del($_POST['klient']);
    }
    if(isset($_POST['update']))
    {
        echo "<h2>Таблица после обновления:</h2>";
        update($_POST["mebel"], $_POST["price"]);
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
function add($name, $pass, $adres, $email, $phone) {
    include "setup.php";
    $result = mysqli_query($dp, "Insert Into Клиент (ФИО, Пароль, Адрес_получателя, email, Телефон) 
    values ('$name', '$pass', '$adres', '$email', '$phone')")
        or die("Ошибка добавления". mysqli_error($dp));
    printAddDel();
}
function del($name) {
    include "setup.php";
    $result = mysqli_query($dp, "Delete from Клиент WHERE ФИО like '$name'")
    or die("Ошибка добавления". mysqli_error($dp));
    mysqli_close($dp);
    printAddDel();
}

function update($mebel, $price)
{
    include "setup.php";
    $result = mysqli_query($dp, "Update Модель SET Цена = $price WHERE Название_модели = '$mebel'")
    or die("Ошибка удаления направления" . mysqli_error($dp));
    mysqli_close($dp);
    printUpd();
}

function printUpd(){
    include "setup.php";
    $result = mysqli_query($dp,
        "SELECT *, Категории.Название_категории 
                FROM Модель INNER JOIN Категории ON 
                    (Модель.ID_категории = Категории.ID_категории)")
    or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result)
    {
        $table="<center><table class='table1'align='center' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Категория</th>
        <th>Цена</th>
        <th>Описание</th>
        </tr>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td>".$row['ID_модели']."</td>";
            $table .= "<td>".$row['Название_модели']."</td>";
            $table .= "<td>".$row['Название_категории']."</td>";
            $table .= "<td>".$row['Цена']."</td>";
            $table .= "<td>".$row['Описание']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}

function printAddDel(){
    include "setup.php";
    $result = mysqli_query($dp, "SELECT * FROM Клиент")
    or die("Ошибка запроса Select пользователь" . mysqli_error($dp));
    if($result)
    {
        $table="<center><table class='table'align='center' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Пароль</th>
        <th>Адрес</th>
        <th>email</th>
        <th>Телефон</th>";
        while($row=mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td>".$row['ID_клиента']."</td>";
            $table .= "<td>".$row['ФИО']."</td>";
            $table .= "<td>".$row['Пароль']."</td>";
            $table .= "<td>".$row['Адрес_получателя']."</td>";
            $table .= "<td>".$row['email']."</td>";
            $table .= "<td>".$row['Телефон']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}

function printParam($name){
    include "setup.php";
    $result = 'Select *, Клиент.ФИО, Тип_доставки.Название_типа from Заказ 
        INNER JOIN Клиент on(Заказ.ID_клиента = Клиент.ID_клиента) 
        INNER JOIN Тип_доставки on(Заказ.ID_тип_доставки = Тип_доставки.ID_типа_доставки)
        WHERE ФИО LIKE \'' . $name . '\'';
    $result = mysqli_query($dp, $result) or die("Ошибка запроса Select" . mysqli_error($dp));
    if ($result)
    {
        $table = "<center><table class='table' cellpadding='0' cellspacing='0'>
        <tr>
        <th>Номер заказа</th>
        <th>ФИО Клиента</th>
        <th>Тип Доставки</th>
        <th>Дата заказа</th>
        <th>Сумма аказа</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $table .= "<tr>";
            $table .= "<td>".$row['ID_заказа']."</td>";
            $table .= "<td>".$row['ФИО']."</td>";
            $table .= "<td>".$row['Название_типа']."</td>";
            $table .= "<td>".$row['Дата_заказа']."</td>";
            $table .= "<td>".$row['Сумма']."</td>";
            $table .= "</tr>";
        }
        $table .="</table></center>";
        echo $table;
    }
    mysqli_close($dp);
}