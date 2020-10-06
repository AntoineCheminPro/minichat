<?php
session_start();
try{
    $db = new PDO('mysql:host=localhost;dbname=minichat_php', 'MinichatPHP', 'minichat76');

} catch (PDOException $e){
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

// Effectuer ici la requête qui insère le message
if (isset($_POST["new_message"]) && !empty($_POST)){
    $query = $db->prepare(
        "INSERT INTO Messages(pseudo,date,message)
        VALUES (:pseudo,  NOW(), :message)"
    );
    // execution de la requête avec les valeurs
    $result = $query->execute([
        "pseudo" => $_POST["pseudo"],
        "message" => $_POST["message"]
    ]);
    $_SESSION["pseudo"] = $_POST["pseudo"];
}

// Puis rediriger vers minichat.php comme ceci :
header('Location: minichat.php');
?>