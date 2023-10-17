<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Акции</title>
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
<!--Header-->
<?php
include "header.php";
?>

<!--Main block start-->
<div class="container">
    <div class="content row">
        <!--    content-->
        <div class="main-content row justify-content-center col-md-12">
            <?php
            include "connect.php";
            $result = 'Select * from Акция ORDER BY id_акции DESC';
            $result = mysqli_query($conn, $result) or die ('Ошибка Select '.mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                $dateStart=strtotime($row['Начало_акции']);
                $dateEnd=strtotime($row['Конец_акции']);
                $dateStart=date('d F y', $dateStart);
                $dateEnd=date('d F y', $dateEnd);
                echo '<div class="main-page-style col-12 col-md-3">
                        <h3>Акция №'.$row['id_акции'].'</h3>
                        <div class="house_text">
                      <p>'.$row['Описание_акции'].'<br>Срок проведения акции с '.$dateStart.' по '.$dateEnd.'<br></p>
                       </div></div>';
            }
            ?>
        </div>
    </div>
</div>
<!--Main block end-->
<?php
include "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>

