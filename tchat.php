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
            echo '<p>[<i>' . $donnees['date_creation_fr'] . ' </i>] <strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> :';
            $mess_prepa = str_replace(':)', '<img src="smileys/icon_smile.gif" />', htmlspecialchars($donnees['message']));
            $mess_prepa = str_replace(';)', '<img src="smileys/icon_wink.gif" />', $mess_prepa);
            $mess_prepa = str_replace('camping', '<img src="smileys/icon_camping.gif" />', $mess_prepa);
            $mess_prepa = str_replace('cook', '<img src="smileys/icon_cook.gif" />', $mess_prepa);
            $mess_prepa = str_replace('fish', '<img src="smileys/icon_fish.gif" />', $mess_prepa);
            $mess_final = str_replace('rip', '<img src="smileys/icon_rip.gif" />', $mess_prepa);
            echo ' ' . $mess_final . '</p>';
        }
        $reponse->closeCursor();
    ?>

<!-- Affichage si erreur -->

<?php if(isset($_SESSION['msg-admin']) && $_SESSION['msg-admin'] != '') : ?>
<div class="notify notify-red"> <?php echo htmlspecialchars($_SESSION['msg-admin']); ?></div>
<?php endif;?>

<!-- Boite pour l'envoi du message -->

<div class="tchatForm" style="top:20px;width:100%;">
    <form action="tchat_post.php" method="post" name="tchat">
        <div style="margin-right:8px;">
            <!-- Ajout de smileys -->
            <script type="text/javascript">
            function addText(instext) {
                var mess = document.tchat.message;
                //IE support
                if (document.selection)   {
                        mess.focus();
                        sel = document.selection.createRange();
                        sel.text = instext;
                        document.guestbook.focus();
                }

                //MOZILLA/NETSCAPE support
                else if (mess.selectionStart || mess.selectionStart == "0")   {
                       var startPos = mess.selectionStart;
                       var endPos = mess.selectionEnd;
                       var chaine = mess.value;
                       mess.value = chaine.substring(0, startPos) + instext + chaine.substring(endPos, chaine.length);
                       //mess.selectionStart = startPos + instext.length;
                       //mess.selectionEnd = endPos + instext.length;
                       mess.focus();
                 } else {
                       mess.value += instext;
                       mess.focus();
                }
            }
            </script>

            <a href="#" onclick="addText(' :) ');return(false)"><img src="smileys/icon_smile.gif" ></a> 
            <a href="#" onclick="addText(' ;) ');return(false)"><img src="smileys/icon_wink.gif" ></a>
            <a href="#" onclick="addText(' camping ');return(false)"><img src="smileys/icon_camping.gif" ></a> 
            <a href="#" onclick="addText(' cook ');return(false)"><img src="smileys/icon_cook.gif" ></a>            
            <a href="#" onclick="addText(' fish ');return(false)"><img src="smileys/icon_fish.gif" ></a> 
            <a href="#" onclick="addText(' rip ');return(false)"><img src="smileys/icon_rip.gif" ></a>   

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