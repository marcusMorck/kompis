<?php
session_start(); //needs to be included in all files
require "../includes/config.php";


if (!isset($_SESSION['session_id'])) //if the session already is set
{
    if (isset($_POST['submit'])) //checks if the user has clicked the submit button
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sqlquery = "SELECT * FROM users WHERE email='$email'";

        $statement = $pdo->prepare($sqlquery);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);

        if ($statement->rowCount() === 1) //check if we have a row with the user
        { 
            if (password_verify($password, $rows['hashedPw'])) // Check if the password that is typed in equals to the stored hash
            {
                // Correct password - create the session and set it equal to the user id in the database
                $_SESSION['session_id'] = $rows['id'];
                header('Location: ../html/index.html');
            } 
            else
            {
                // Wrong password - write out error message, redirect back to login page
                echo "felaktig lösenord eller användarnamn, var vänlig försök igen!";
                header('Refresh:5 url=../html/login.html');
            }
        }
        else
        {
            // The user doesn't exist - write out error message, redirect back to login page
            echo "felaktig lösenord eller användarnamn, var vänlig försök igen!";
            header('Refresh:5 url=../html/login.html');
        }
    }
    else
    {
        //The submit button hasn't been clicked - write out error message, redirect back to login page
        echo "du har ingen behörighet till denna sidan, var vänlig försök igen!";
        header('Refresh:5 url=../html/index.html');
    }
}
else
{
    header('Refresh:5 url=../html/index.html');
    echo "Du är redan inloggad";  
}
