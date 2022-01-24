<?php

include "navbar_member.php";
include "template.php";
include "../connectdb.php";

templateHeader();

?>

<body>

<?php
navbar();

$conn = getConnection();
$sql = "SELECT fines FROM members WHERE reg_no='{$_SESSION['regno']}'";

$fines = $conn->query($sql)->fetch_assoc()['fines'];

if(isset($_POST['pay'])){

    $sql = "UPDATE fines SET fines=0 WHERE reg_no='{$_SESSION['regno']}'";

    $_SESSION['message'] = "All fines payed.";
}

?>

<div class="container mt-5">

    <h2>Fines</h2>

    <?php
    if($_SESSION['message'] != ""){
        echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
    }
    ?>

    <table class="table">
        <tbody>
        <tr>
            <td>Total fines overdue : </td>
            <td><?php echo $fines; ?> LKR </td>
        </tr>
        </tbody>
    </table>

    <form action="fines.php" method="post">
        <button class="btn btn-primary" type="submit" name="pay">Pay fines</button>
    </form>
</div>



</body>
