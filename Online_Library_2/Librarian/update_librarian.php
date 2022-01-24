<?php

include "../template.php";
include "navbar_librarian.php";
include "../connectdb.php";

templateHeader();

$username = $fname = $lname = $email = $role = $password = "";

$conn = getConnection();

$sql = "SELECT username, fname, lname, email FROM librarians WHERE username='{$_SESSION['username']}';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $username = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $sql = "UPDATE librarians SET username='{$username}', fname='{$fname}', lname='{$lname}', email='{$email}', 
                  password='{$password}' WHERE username='{$_SESSION['username']}';";

    $conn = getConnection();
    if ($conn->query($sql) === TRUE) {
        echo "Account updated successfully";
        header("Location: home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<body>

<?php navbar(); ?>


<div class="container p-3 mt-5" style="width: 50%; border: solid gray 1px; border-radius: 10px;">
    <h3>Update Account</h3><br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter Registration No" name="username" value="<?php echo $username; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname" value="<?php echo $fname; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" value="<?php echo $lname; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter Email Address" name="email" value="<?php echo $email; ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>


        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <button type="reset"  class="btn btn-warning">Reset</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<script>
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
<?php

templateFooter();

?>
