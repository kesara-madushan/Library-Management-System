<?php

include "navbar_librarian.php";
include "template.php";
include "../connectdb.php";

templateHeader();

if(isset($_POST['search'])){
    $_SESSION['regno'] = $_POST['regno'];
    $_SESSION['message'] = "";
}

if(isset($_POST['return'])){

    $conn = getConnection();

    $sql1 = "SELECT available FROM books WHERE isbn=(SELECT isbn FROM lending_records WHERE record_id={$_POST['return']})";
    $copiesAvailable = $conn->query($sql1)->fetch_assoc()['available'];
    $copiesAvailable = $copiesAvailable + 1;

    $sql2 = "UPDATE lending_records SET returned='yes' WHERE record_id={$_POST['return']}";
    $sql3 = "UPDATE books SET available=$copiesAvailable WHERE isbn=(SELECT isbn FROM lending_records WHERE record_id={$_POST['return']})";

    $conn->query($sql2);
    $conn->query($sql3);

    $sql4 = "SELECT DATEDIFF(CURDATE(), due_date) AS days_overdued FROM lending_records WHERE record_id={$_POST['return']};";
    $daysOverdued = $conn->query($sql4)->fetch_assoc()['days_overdued'];
    $penalty = $daysOverdued * 2;

    $fines = $conn->query("SELECT fines FROM members WHERE reg_no=(SELECT reg_no FROM lending_records WHERE record_id={$_POST['return']})")->fetch_assoc()['fines'];

    if($daysOverdued > 0){

        $fines = $fines + $penalty;

        $conn->query("UPDATE members SET fines={$fines} WHERE reg_no=(SELECT reg_no FROM lending_records WHERE record_id={$_POST['return']})");

        $_SESSION['message'] = "<p>Days overdue : {$daysOverdued}</p><p>Penalty : {$penalty} LKR</p><p>Total fine : {$fines}</p>";

    }else{
        $_SESSION['message'] = "<p>Days overdue : 0</p><p>Penalty : 0 LKR</p><p>Total fine : {$fines}</p>";
    }
}


?>

    <body>

    <?php navbar(); ?>

    <div class="container mt-3">
        <h2>Return Books</h2>

        <?php
        if($_SESSION['message'] != "") {
            echo "<div class='alert alert-warning'>{$_SESSION['message']}</div>";
        }
            ?>

        <form class="form-inline" action="return_books.php" method="post">

            <input type="search" class="form-control m-3" placeholder="Registration no" name="regno" <?php if($_SESSION['regno'] != ""){ echo "value='".$_SESSION['regno']."'";} ?>>

            <button type="submit" class="btn btn-success"  name="search">Search</button>
        </form>

        <form  action="return_books.php" method="post">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>ISBN</th>
                    <th>Date issued</th>
                    <th>Due date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php

                if($_SESSION['regno'] != ""){


                    $conn = getConnection();
                    $sql = "SELECT *  FROM lending_records WHERE reg_no='{$_SESSION['regno']}' AND returned='no';";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['isbn'] . "</td>";
                            echo "<td>" . $row['date_issued'] . "</td>";
                            echo "<td>" . $row['due_date'] . "</td>";
                            echo "<td><button type='submit' class='btn btn-primary' name='return' value='{$row['record_id']}'>Mark Returned</button></td>";
                            echo "</tr>";
                        }
                    }
                    $conn->close();

                }


                ?>
                </tbody>
            </table>
        </form>
    </div>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>



    </body>

<?php templateFooter(); ?>