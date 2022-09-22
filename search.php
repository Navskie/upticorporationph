<?php
    include 'include/db.php';

    if (isset($_POST["query"])) {
        $output = '';
        $query = mysqli_query($connect, "SELECT * FROM upti_code WHERE code_name LIKE '%".$_POST["query"]."%'");
        $output = '<ul class="list-unstyled">';
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_array($query)) {
                $output .= '<li class="list-group-item list-group-item-action">'.$row["code_name"].'</li>';
            }
        } else {
            $output .= '<li class="list-group-item list-group-item-action text-center text-danger"><b>Invalid Code!</b></li>';
        }
        $output .= '</ul>';
        echo $output;
    }
?>