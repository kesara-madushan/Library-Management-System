<?php
include "navbar_librarian.php";
include "template.php";
include "../connectdb.php";

$_SESSION['regno'] = "";

templateHeader();

if(isset($_POST['search_isbn'])){
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['isbn'] = $_POST['isbn'];
}
?>

<body>
<?php navbar() ?>
<div class="container mt-3">
<h2>Search books</h2>
<br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-inline p-3" >

        <select class="form-control m-3" id="category" name="category">
            <option><?php echo $_SESSION['category'] ;?></option>
            <option>All</option>
            <?php
            $conn = getConnection();
            $sql = "SELECT DISTINCT category FROM books;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option>" . $row['category'] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select>

        <input type="search" class="form-control m-3 ml-5" id="isbn"  name="isbn" placeholder="ISBN" <?php if($_SESSION['isbn'] != ""){ echo "value='".$_SESSION['isbn']."'";} ?>>

        <input type="submit" class="btn btn-success m-3" name="search_isbn" value="Search">

    </form>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th>ISBN</th>
        <th>Name</th>
        <th>Author</th>
        <th>Copies</th>
        <th>Category</th>
        <th>Available</th>
    </tr>
    </thead>
    <tbody>


<?php

$conn = getConnection();
$sql = "SELECT * FROM books";

if($_SESSION['category'] != "All"){
    $sql = "SELECT * FROM books WHERE category='{$_SESSION['category']}'";
    //$_SESSION['isbn'] = "";
}

if($_SESSION['isbn'] != ""){
    $sql = "SELECT * FROM books WHERE isbn='{$_SESSION['isbn']}'";
    //$_SESSION['category'] = "All";
}

if($_SESSION['category'] != "All" && $_SESSION['isbn'] != ""){
    $sql = "SELECT * FROM books WHERE isbn='{$_SESSION['isbn']}' AND category='{$_SESSION['category']}'";
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['isbn'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>" . $row['copies'] . "</td>";
        echo "<td>" . $row['available'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();



?>

    </tbody>

</table>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>

<?php templateFooter(); ?>
