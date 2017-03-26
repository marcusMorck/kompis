<?php
    session_start();
    if(isset($_SESSION['admin']))
    {
        require '../includes/config.php';

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $roll = $_POST['role'];
        $hashedPw = $_POST['hashedPw'];
        $adress = $_POST['adress'];
        $postnr = $_POST['zipCode'];
        $city = $_POST['city'];
        $tel = $_POST['phonenr'];

        $sql = "UPDATE users SET `id` = :id, `name` = :name, `email` = :email, `role` = :roll, `hashedPw` = :hashedpw, `adress` = :adress, `zipCode` = :zipcode, 
        `city` = :city, `phoneNumber` = :phonenr WHERE `id` = :user_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":roll", $roll);
        $stmt->bindValue(":hashedpw", $hashedPw);
        $stmt->bindValue(":adress", $adress);
        $stmt->bindValue(":zipcode", $postnr);
        $stmt->bindValue(":city", $city);
        $stmt->bindValue(":phonenr", $tel);
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();

        header("Location: ../includes/admin.php");
    }
    else
    {
        echo "Du har ingen behörighet till denna sidan!";
        header("Redirect:5 ../index.html");
    }
?>
