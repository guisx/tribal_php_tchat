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
<h1>Bienvenue sur Tribal tchat : <i><?php echo $_SESSION['pseudo']; ?></i></h1>

<!-- Affichages des messages -->

<section>
    <?php
        // Récupération des 10 derniers messages
        $reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_message, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM tchat ORDER BY date_message DESC LIMIT 20');

        // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
        while ($donnees = $reponse->fetch()){
            echo '<p>[<i>' . $donnees['date_creation_fr'] . ' </i>] <strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
        }
        $reponse->closeCursor();

    ?>
</section>

<!-- Boite pour l'envoi du message -->

<div class="tchatForm" style="position:fixed;bottom:20px;width:100%;">
    <form action="tchat_post.php" method="post">
        <div style="margin-right:110px;">
            <textarea name="message" id="message" style="width:100%;"></textarea>
        </div>
        <div style="position:absolute;top:12px;right:0;">
            <input type="submit" name="tchat-submit" value="Envoyer un message" />
        </div>
    </form> 
</div>

<!-- Le pied de page -->

<?php include("footer.php"); ?>  