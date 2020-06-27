<?php $title = "Panneau d'administation";?>
<?php ob_start();?>
    <div class="container">
        <h2 class="text-center"> Bonjour <?= $_SESSION['pseudo'];?></h2>
        <div class="container">
        <h3> Commentaires signalés :</h3>
<?php foreach ($reportedComments as $commentaire)
{?>
    <div class="text-center">
    <p><?= $commentaire['pseudo'];?> a écrit:</p>
    <p> <?= $commentaire['content'];?> </p>
    <a role="button" class="btn btn-success" href="index.php?action=approveComment&commentId=<?= $commentaire['commentId'];?>">Autoriser</a>
    <a role="button" class="btn btn-danger" href="index.php?action=deleteComment&commentId=<?= $commentaire['commentId'];?>">Supprimer</a>
    </div>
<?php
}
?>
</div>
    </div>
<?php $content = ob_get_clean();?>
<?php require("view/template.php");?>
