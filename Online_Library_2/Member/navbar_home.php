<?php

function navbar(){

    ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">
            <h1 style="color: dodgerblue">Library Management System</h1>
            <h4 style="color: floralwhite">Abc State University</h4>
        </a>

        <!-- Links -->
        <ul class="navbar-nav justify-content-end" >
            <li class="nav-item">
                <a class="nav-link" href="./index.php" style="float: right">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="float: right">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="float: right">Contact</a>
            </li>
        </ul>
    </nav>
    <?php
}

?>