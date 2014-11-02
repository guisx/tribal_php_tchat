<!-- L'en-tête -->

<?php include("header.php"); ?>

<?php 
	if(!empty($_POST) && isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
		session_start();
		$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
		header("tchat.php");
	}
?>

<section>
	<h1>Bienvenue sur mon tchat</h1>
    <form action="index.php" method="post">
        <p>
        <label for="pseudo">Indiquez votre pseudo</label> : <input type="text" name="pseudo" id="pseudo" />
        <br /><br />

        <input type="submit" name="pseudo-submit" value="Entrer dans le tchat" />
    </p>
    </form>	
</section>

<!-- Le pied de page -->

<?php include("footer.php"); ?>  