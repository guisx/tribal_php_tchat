<!-- L'en-tête -->

<?php include("header.php"); ?>
<?php
    //on recupere les fichiers pour se connecte a la BDD
    require_once 'config.php';
    require_once 'functions.php';
?>

<?php 
    session_start();
    //On redirige si le pseudo n'existe pas ou est vide 
	if(!isset($_SESSION['pseudo']) || empty($_SESSION['pseudo'])){
		header("location:index.php");
	}
?>

<h1>Bienvenue sur le tchat : <i><?php echo $_SESSION['pseudo']; ?></i></h1>


<!-- Affichage des messages -->

<section>
    <?php
        // Récupération des 30 derniers messages
        $reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM tchat ORDER BY date_message ASC LIMIT 30');

        // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
        while ($donnees = $reponse->fetch()){
            echo '<p>[<i>' . $donnees['date_creation_fr'] . ' </i>] <strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
        }
        $reponse->closeCursor();
    ?>

<!-- Affichage si erreur -->

<?php if(isset($_SESSION['msg-admin']) && $_SESSION['msg-admin'] != '') : ?>
<div class="notify notify-red"> <?php echo htmlspecialchars($_SESSION['msg-admin']); ?></div>
<?php endif;?>

<!-- Boite pour l'envoi du message -->

<div class="tchatForm" style="top:20px;width:100%;">
    <form action="tchat_post.php" method="post">
        <div style="margin-right:8px;">
            <textarea name="message" id="message" placeholder="Votre message ici" style="width:100%;"></textarea>
        </div>
        <div style="top:5px;right:15px;text-align:center;">
            <input type="submit" class="boutonstyle" name="tchat-submit" value=" Envoyer votre message " />
        </div>
    </form> 
</div>

</section>



<!-- Le pied de page -->

<?php include("footer.php"); ?>  