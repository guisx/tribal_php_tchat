<!-- L'en-tête -->

<?php include("header.php"); ?>

<?php 
	if(!empty($_POST) && isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
		session_start();
		$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
		header("location:tchat.php");
	}
?>

<section>
	<h1>Bienvenue sur Tribal Tchat</h1>
    <form action="index.php" method="post">

        <div style="margin-right:8px;">
        	<input type="text" name="pseudo" id="pseudo" placeholder="Indiquez votre pseudo ici" />
        </div>
        <div style="right:15px;text-align:center;margin-top:15px;">
            <input type="submit" nclass="boutonstyle" ame="pseudo-submit" value="Entrer dans le tchat" />
        </div>

    </form>	
</section>

<!-- Le pied de page -->

<?php include("footer.php"); ?>  