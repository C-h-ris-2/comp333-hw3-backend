<?php
    session_destroy();
    echo 'Logout successful';
    header("Location: form.html");   
           //do other things... like redirect to a deafault/login page

?>