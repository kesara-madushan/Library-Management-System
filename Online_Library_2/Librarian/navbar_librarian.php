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
                <a class="nav-link" href="router_librarian.php?page=home" style="float: right">All books</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="router_librarian.php?page=issue_books" >Issue books</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="router_librarian.php?page=return_books" style="float: right">Return books</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="book_catalogues.php" style="float: right">Book catalogues</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <i class="fas fa-id-card-alt"></i>
                    <?php echo $_SESSION['name'] . "(" . $_SESSION['username'] . ")"?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="create_librarian.php">Add librarian</a>
                    <a class="dropdown-item" href="update_librarian.php">Update account</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <?php
}

?>