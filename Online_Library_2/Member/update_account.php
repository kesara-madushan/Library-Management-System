<?php

include "../template.php";
include "navbar_member.php";
include "../connectdb.php";

templateHeader();

$regno = $fname = $lname = $email = $role = $password = "";

$conn = getConnection();

$sql = "SELECT reg_no, fname, lname, email, role FROM members WHERE reg_no='{$_SESSION['regno']}';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $regno = $row['reg_no'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $role = $row['role'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['pwd'];

    $sql = "UPDATE members SET reg_no='{$regno}', fname='{$fname}', lname='{$lname}', email='{$email}', 
                  role='{$role}', password='{$password}' WHERE reg_no='{$_SESSION['regno']}';";

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
            <label for="regno">Registration No:</label>
            <input type="text" class="form-control" id="regno" placeholder="Enter Registration No" name="regno" value="<?php echo $regno; ?>" required>
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
            <label for="role">Role:</label>
            <select class="form-control" name="role" id="role">
                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <option value="Student">Student</option>
                <option value="Professor">Professor</option>
            </select>
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
