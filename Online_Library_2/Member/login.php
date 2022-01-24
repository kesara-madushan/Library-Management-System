<?php

session_start();
$_SESSION['login_error'] = "";
include "../template.php";
include "./navbar_home.php";
include "../connectdb.php";


templateHeader();
navbar();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn = getConnection();

    $sql = "SELECT reg_no, fname, lname FROM members WHERE reg_no='{$_POST['regno']}' AND password='{$_POST['pwd']}';";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        $_SESSION['regno'] = $row['reg_no'];
        $_SESSION['name'] = $row['fname'] . " " . $row['lname'];
        $_SESSION['login_error'] = "";
        header("Location: home.php");

    } else {
        $_SESSION['login_error'] = "Invalid registration no or password!";
    }
    $conn->close();
}


?>

<body>

<div class="container p-3 mt-5" style="width: 50%; border: solid gray 1px; border-radius: 10px;">
    <h3>Login as a Member</h3><br>

<?php

if($_SESSION['login_error'] != ""){
    ?>
    <div class="alert alert-danger">
        <strong>Login Error!</strong> <?php echo $_SESSION['login_error'] ?>
    </div>
        <?php
}

 ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="regno">Registration no:</label>
            <input type="text" class="form-control" id="regno" placeholder="Enter university registration number" name="regno" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <a href="register.php">Not a member? Create account here!</a>

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