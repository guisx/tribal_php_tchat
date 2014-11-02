<!-- L'en-tête -->

<?php include("header.php"); ?>

<?php 
    session_start();
    //On redirige si le pseudo n'existe pas ou est vide 
	if(!isset($_SESSION['pseudo']) || empty($_SESSION['pseudo'])){
		header("location:index.php");
	}
?>

<section>
	<h1>Bienvenue sur Tribal tchat : <i><?php echo $_SESSION['pseudo']; ?></i></h1>

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