<?php

include "navbar_librarian.php";
include "template.php";
include "../connectdb.php";

templateHeader();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $isbn = $_POST['isbn'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $copies = $_POST['copies'];
    $category = $_POST['category'];

    $sql = "INSERT INTO books (isbn, name, author, category, copies, available) VALUES ('{$isbn}', '{$name}', '{$author}', '{$category}', {$copies}, {$copies})";

    $conn = getConnection();
    if ($conn->query($sql) === TRUE) {
        echo "New book catalogue created successfully";
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
        <h2>Create new book catalogue</h2>
        <br>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="needs-validation" novalidate>

            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" placeholder="Enter ISBN" name="isbn" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter the name of the book" name="name" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" placeholder="Enter Author" name="author" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" placeholder="Enter Category" name="category" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="form-group">
                <label for="copies">Number of copies:</label>
                <input type="number" class="form-control" id="copies" placeholder="0" name="copies" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>


            <button type="reset"  class="btn btn-warning">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>

    </body>

<?php templateFooter(); ?>