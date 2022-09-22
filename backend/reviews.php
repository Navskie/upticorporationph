<?php
    session_start();
    include '../function.php';
    include '../include/db.php';

    $profile = $_SESSION['code'];
    $item_code = $_GET['code'];

    if(isset($_POST['review'])) {
        $rating = $_POST['rating'];
        $skin = $_POST['skin'];
        $concern = $_POST['concern'];
        $age = $_POST['age'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];

        if ($profile != '') {
            $reviews = mysqli_query($connect, "INSERT INTO web_reviews (
                rev_code,
                rev_user,
                rev_star,
                rev_skin,
                rev_concern,
                rev_age,
                rev_title,
                rev_desc,
                rev_time,
                rev_date
            ) VALUES (
                '$item_code',
                '$profile',
                '$rating',
                '$skin',
                '$concern',
                '$age',
                '$title',
                '$desc',
                '$time',
                '$today'
            )");
    
            header('location: ../details.php?code='.$item_code.'');
        } else {
            header('location: ../login.php');
        }
    }
?>