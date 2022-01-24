<?php

include 'template.php';
include 'navbar_home.php';

templateHeader();
?>
<body>


<?php navbar() ?>


<div class="container mt-5 text-center">
    <div class="dropdown text-center">
        <button type="button" class="btn btn-success dropdown-toggle mt-5" data-toggle="dropdown" style="font-size: 40px; padding: 10px 50px; border-radius: 40px;">
            <b>Login</b>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="./Member/login.php">Member</a>
            <a class="dropdown-item" href="./Librarian/login.php">Librarian</a>
        </div>
    </div>
</div>

</body>

<?php
templateFooter();
?>
