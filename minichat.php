<?php
require_once ("header.php");
?>

<?php
session_start();


try{
    $db = new PDO('mysql:host=localhost;dbname=minichat_php', 'MinichatPHP', 'minichat76');

} catch (PDOException $e){
    die("Erreur !: " . $e->getMessage());
}

if(!empty($_GET)){
    $position = ($_GET["id"]-1)*10;
    $messagesAffiches = [$position];
}
else {
    $position=0;
}

// send the query to mysql
$query = $db -> query("SELECT * FROM Messages ORDER BY id DESC LIMIT $position,10");
// Extract data from query as an associative array (fetch quand 1 seul, renvoi un tableau associatif et non pas un tableau dans un tableau)
$messages = $query -> fetchAll(PDO::FETCH_ASSOC);

?>
<form class="container text-center bg-dark" action="minichat_post.php" method="post">
    <div>
        <p>Pseudo</p>
        <input type="text" name="pseudo" value="<?php echo $_SESSION['pseudo'] ?>">
    </div>
    <div>
        <p>Message</p>
        <textarea type="text" class="form-control"  name="message" id="message"></textarea>
    </div>
    <div>
        <input class="btn btn-primary" type="submit" name="new_message" valeur="envoyer">
        <a class="btn btn-primary" href="minichat.php" >Rafraichir</a>
    </div>
</form>

<div class="container text-center border border-dark bg-secondary">
    <?php
    foreach ($messages as $key => $message) {
        echo "<p>" .  htmlspecialchars($message["pseudo"]) . " : " . htmlspecialchars($message["message"]) . "</p>";
    }
    ?>
</div>

<div class="container text-center">
    <?php 
    $nbrMessageQuery = $db ->query("SELECT count(id) FROM Messages");
    $nbrMessage = $nbrMessageQuery -> fetch(PDO::FETCH_ASSOC);
    $_GET['nombreDePage'] = intval(ceil(intval($nbrMessage["count(id)"])/10));
    for ($i=1; $i<=$_GET['nombreDePage'];$i++){
            $numColor="";
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                if (intval($_GET['id'])=== $i){
                    $numColor = "text-warning";
                }
            }
        ?>
        <a class="<?php echo $numColor ?>" href="minichat.php<?php echo "?id=$i"; ?>"><?php echo $i ?></a>
        <?php 
    }
    ?>
</div>


<?php require_once ("footer.php");?>