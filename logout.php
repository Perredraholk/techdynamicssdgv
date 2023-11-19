<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <script>
        if (confirm("Você deseja fazer logout?")) {
            <?php session_destroy(); ?>

            window.location.href = "index.html";
        } else {
            window.history.back();
        }
    </script>
</body>
</html>
