<?php

include "template.php";
include "navbar_member.php";
include "../connectdb.php";

templateHeader();

?>

<body>

<?php navbar() ?>

<div class="container mt-5">
    <h2>Borrowed books</h2>
    <br>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>ISBN</th>
            <th>Name</th>
            <th>Borrowed date</th>
            <th>Return date</th>
        </tr>
        </thead>
        <tbody>


        <?php

        $conn = getConnection();
        $sql = "SELECT * FROM lending_records WHERE reg_no='{$_SESSION['regno']}' AND returned='no'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $name = $conn->query("SELECT name FROM books WHERE isbn='{$row['isbn']}'")->fetch_assoc()['name'];
                echo "<tr>";
                echo "<td>" . $row['isbn'] . "</td>";
                echo "<td>" . $name . "</td>";
                echo "<td>" . $row['date_issued'] . "</td>";
                echo "<td>" . $row['due_date'] . "</td>";
                echo "</tr>";
            }
        }
        $conn->close();



        ?>

        </tbody>

    </table>
</div>

</body>


<?php
templateFooter();
?>