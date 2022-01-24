<?php
include "navbar_librarian.php";
include "template.php";
include "../connectdb.php";

templateHeader();
$copiesAvailable = -1;

if(isset($_POST['check'])){
    $_SESSION['isbn'] = $_POST['isbn'];
}

if(isset($_POST['check_validity'])){
    $_SESSION['regno'] = $_POST['regno'];
}

if(isset($_POST['issue'])){
    $isbn = $_POST['isbn'];
    $regno = $_POST['regno'];
    $dateIssued = date("Y-m-d");
    $dueDate = date('Y-m-d', strtotime($dateIssued. ' + 14 days'));

    $conn = getConnection();

    $sql1 = "INSERT INTO lending_records (isbn, reg_no, date_issued, due_date) VALUES ('{$isbn}', '{$regno}', '{$dateIssued}', '{$dueDate}')";

    $sql3 = "SELECT available FROM books WHERE isbn='{$isbn}'";
    $copiesAvailable = $conn->query($sql3)->fetch_assoc()['available'];


    if ($conn->query($sql1) === TRUE) {
        $copiesAvailable = $copiesAvailable - 1;
        $sql2 = "UPDATE books SET available={$copiesAvailable} WHERE isbn='{$isbn}'";
        if($conn->query($sql2) === TRUE){
            $_SESSION['isbn'] = "";
            $_SESSION['regno'] = "";
        }

    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<body>

<?php navbar(); ?>

<div class="container mt-3">
    <h2>Issue Books</h2><br>

    <form action="issue_books.php" method="post" class="needs-validation" novalidate>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="search" class="form-control" id="isbn" placeholder="Enter ISBN" name="isbn" <?php if($_SESSION['isbn'] != ""){ echo "value='".$_SESSION['isbn']."'";} ?> required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <button type="submit" class="btn btn-success mb-3" name="check">Check Availability</button>

        <?php
        if($_SESSION['isbn'] != ""){

            $conn = getConnection();
            $sql = "SELECT * FROM books WHERE isbn='{$_SESSION['isbn']}'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>Name : " . $row['name'] . "</p>";
                echo "<p>Author : " . $row['author'] ."</p>";
                echo "<p>Copies Available : " . $row['available'] . "</p>";

                $copiesAvailable = $row['available'];

            }
            $conn->close();
            }

        if($copiesAvailable > 0){

        ?>
        <br>
        <div class="form-group">
            <label for="regno">Member registration no:</label>
            <input type="search" class="form-control" id="regno" placeholder="Enter member's registration number" name="regno" <?php if($_SESSION['regno'] != ""){ echo "value='".$_SESSION['regno']."'";} ?> required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <button type="submit"  class="btn btn-success" name="check_validity">Check Validity</button>

        <?php
        if($_SESSION['regno'] != ""){
            $conn = getConnection();
            $sql1 = "SELECT reg_no FROM lending_records WHERE reg_no='{$_SESSION['regno']}' AND returned='no'";
            $sql2 = "SELECT reg_no FROM members WHERE reg_no='{$_SESSION['regno']}'";

            $result1 = $conn->query($sql1);
            $result2 = $conn->query($sql2);

            //$nbooks = $result->fetch_assoc();

            if($result1->num_rows < 2 && $result2->num_rows == 1){
                ?>
                <button type="reset"  class="btn btn-warning" name="reset">Reset</button>
                <button type="submit" class="btn btn-primary" name="issue">Issue Book</button>
                <?php
            }
        }
        ?>

</div>

<?php
}else if($copiesAvailable == 0){
            echo "<div class='alert alert-danger'>Not available at the moment!</div>";
}

 ?>


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>

<?php templateFooter(); ?>