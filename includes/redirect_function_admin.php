<?php

session_start();
require '../includes/config.php';

if (isset($_POST['del_subm_btn']))
{
    if(isset($_POST['id']))
    {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE id='$id'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header("Location: ../includes/admin.php");
        }
    else
    {
        echo "Du har glömt att kryssa i vilken rad du vill ta bort";
        header("Redirect:5 admin.php");
    }
}
else if (isset($_POST['cre_subm_btn'])){
	?>
       	<form action="create_user_admin.php" method="POST">

		<label>Name:<input type="text" name="name"></label><br>
		<label>Email:<input type="text" name="email"></label><br>
		<label>Roll:<input type="text" name="role"></label><br>
		<label>Password:<input type="text" name="password"></label><br>
		<label>Adress:<input type="text" name="adress"></label><br>
		<label>Postnummer:<input type="text" name="zipcode"></label><br>
		<label>Stad:<input type="text" name="city"></label><br>
		<label>Telefonnummer:<input type="text" name="phonenr"></label><br>
		<input type="submit" name="cre_user_btn" value="create">
		</form>
		<?php 


}
else if (isset($_POST['upd_subm_btn']))
{
    if (isset($_POST['id']))
    {    
		require '../includes/config.php';

		$id = $_POST['id'];
		$sql = "SELECT * FROM users WHERE id='$id'";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		?>

		<form action="update_user_admin.php" method="POST">

		<label>Id:<input type="text" name="id" value=<?php echo $result['id'];?>></label><br>
		<label>Name:<input type="text" name="name" value=<?php echo $result['name'];?>></label><br>
		<label>Email:<input type="text" name="email" value=<?php echo $result['email'];?>></label><br>
		<label>Roll:<input type="text" name="role" value=<?php echo $result['role'];?>></label><br>
		<label>HashedPw:<input type="text" name="hashedPw" value=<?php echo $result['hashedPw'];?>></label><br>
		<label>Adress:<input type="text" name="adress" value=<?php echo $result['adress'];?>></label><br>
		<label>Postnummer:<input type="text" name="zipcode" value=<?php echo $result['zipcode'];?>></label><br>
		<label>Stad:<input type="text" name="city" value=<?php echo $result['city'];?>></label><br>
		<label>Telefonnummer:<input type="text" name="phonenr" value=<?php echo $result['phoneNumber'];?>></label><br>
		<input type="submit" name="upd_user_btn" value="uppdatera">
		</form>
		<?php
    }
    else
    {
        echo "Du har glömt att kryssa i vilken rad du vill uppdatera";
        header("Redirect:5 admin.php");
    }
}
else
{
    header("Location: admin.php");
}   
?>  