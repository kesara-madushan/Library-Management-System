<?php

include "navbar_librarian.php";
include "template.php";
include "../connectdb.php";

templateHeader();

if(isset($_POST['search_isbn_btn'])){
    $_SESSION['isbn'] = $_POST['search_isbn_t'];
}

if(isset($_POST['update'])){

    $isbn = $_POST['isbn'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $copies = $_POST['copies'];
    $category = $_POST['category'];

    $sql = "UPDATE books SET isbn='{$isbn}', name='{$name}', author='{$author}', category='{$category}', copies={$copies} WHERE isbn='{$isbn}'";

    $conn = getConnection();
    if ($conn->query($sql) === TRUE) {
        echo "Book catalogue updated successfully";
        header("Location: book_catalogues.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

if(isset($_POST['delete'])){

    $sql = "DELETE FROM books WHERE isbn='{$_POST['isbn']}'";

    $conn = getConnection();
    if ($conn->query($sql) === TRUE) {
        echo "Book catalogue deleted successfully";
        header("Location: book_catalogues.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}



?>

<body>
<?php navbar(); ?>

<div class="container mt-3">
    <h2>Book catalogues</h2>
    <br>
    <a href="create_new_catalogue.php">Add new book catalogue</a><br>

    <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input class="form-control m-3" type="search" name="search_isbn_t" placeholder="Search ISBN">
        <input class="btn btn-success m-3" type="submit" name="search_isbn_btn" value="Search">
    </form>

    <?php
    $conn = getConnection();
    $sql = "SELECT * FROM books WHERE isbn='{$_SESSION['isbn']}'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
    ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="needs-validation" novalidate>

                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" id="isbn" placeholder="Enter Username" name="isbn" value="<?php echo $row['isbn'] ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter the name of the book" name="name" value="<?php echo $row['name'] ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" placeholder="Enter Author" name="author" value="<?php echo $row['author'] ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" placeholder="Enter Category" name="category" value="<?php echo $row['category'] ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="form-group">
                    <label for="copies">Number of copies:</label>
                    <input type="number" class="form-control" id="copies" placeholder="0" name="copies" value="<?php echo $row['copies'] ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>


                <button type="submit"  name="delete" class="btn btn-danger">Delete</button>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>

    <?php

    } else {
        echo "0 results";
    }
    $conn->close();

    ?>



</div>


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>

<?php templateFooter(); ?>