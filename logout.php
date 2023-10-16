<?php
    session_destroy();
    echo 'Logout successful';
    header("Location: form.html");   
?>