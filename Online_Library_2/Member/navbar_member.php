<?php
session_start();
function navbar(){

    ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">
            <h1 style="color: dodgerblue">Library Management System</h1>
            <h4 style="color: floralwhite">Abc State University</h4>
        </a>

        <!-- Links -->
        <ul class="navbar-nav" >
            <li class="nav-item">
                <a class="nav-link" href="home.php" style="float: right">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="float: right">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <i class="fas fa-id-card-alt"></i>
                    <?php echo $_SESSION['name'] . "(" . $_SESSION['regno'] . ")"?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="borrowed_books.php">Borrowed books</a>
                    <a class="dropdown-item" href="router_member.php?page=fines">Fines</a>
                    <a class="dropdown-item" href="update_account.php">Update Account</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <?php
}

?>