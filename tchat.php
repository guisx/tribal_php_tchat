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
<section>
    <?php
        // Récupération des 10 derniers messages
        $reponse = $bdd->query('SELECT pseudo, message, DAY(date_message) AS jour, MONTH(date_message) AS mois, YEAR(date_message) AS annee, HOUR(date_message) AS heure, MINUTE(date_message) AS minute, SECOND(date_message) AS seconde FROM minichat ORDER BY date_message DESC LIMIT 10');

        // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
        while ($donnees = $reponse->fetch()){
            echo '<p>[' . $donnees['jour'] . '/' . $donnees['mois'] . '/' . $donnees['annee'] . ' ' . $donnees['heure'] . 'h' . $donnees['minute'] . 'm' . $donnees['seconde'] . 's] <strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
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