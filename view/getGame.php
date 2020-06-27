
<?php $title = $gameData['gameslug'] ;?>
<?php ob_start() ;?>

<div id="app">
    <div id="entete">
    <h1> {{game.name}}</h1>
    <div id="game-presentation">
        <div class="game-page-img">
            <img v-bind:src="game.background_image">
        </div>
        <div id="sidePanel">
        <div id="displayNote">
            <h3>Note : <?=bcdiv($noteData['moyTotale'],1,1);?>/20</h3>
            <div class="moyGraphismes">
            <p> Graphismes:</p>
            <meter value="<?=$noteData['moyGraphismes'];?>" min="0" max="5">
            </div>
            <div class="moyGameplay">
            <p>Gameplay:</p>
            <meter value="<?=$noteData['moyGameplay'];?>" min="0" max="5">
            </div>
            <div class="moyAmbiance">
                <p> Ambiance:</p>
            <meter value="<?=$noteData['moyAmbiance'];?>" min="0" max="5">
            </div>
            <div class="moyPerso">
                <p> Avis perso:</p>
            <meter value="<?=$noteData['moyPerso'];?>" min="0" max="5">
            </div>
        </div>
        <span class="ligne-sep"></span>
        <div id="plateformesSidePanel">
            <h3>Disponible sur :</h3>
            <div class="platforms">
            <ul>
                <li v-for="platform in game.parent_platforms" class="platformIcons">
                    <img v-bind:src="'public/img/'+platform.platform.name+'.png'" alt="" v-bind:title="platform.platform.name">
                </li>
            </ul>
            </div>
        </div>
        <div id="dateSortie">
            <h3> Sortie:</h3>
            <h4>  {{game.released}}</h4>
        </div>
        </div>
        </div>
    </div>
    <div class="container">
        <div id="game-description">
        <h3> Synopsis : </h3>
        <p class="description" v-html="game.description"></p>
        </div>
    <?php if(isset($_SESSION['userId'])){
    echo"
    <div>
        <button class='btn' data-toggle='modal' data-target='#commentPopUp'> Ecrire un commentaire </button>
        <button class='btn btn-danger' data-toggle='modal' data-target='#noteGameModal'>Noter</button>
    </div>";};?>
    <div class="game-page-comments">
        <h3> Commentaires :</h3>
    <?php foreach($commentsData as $comment){
        ;?>
        <div class="comment">
            <p class="comment-user-name"><?=$comment['pseudo'];?> a écrit :</p>
            <p class="comment-content"><?=$comment['content'];?></p>
            <?php if($comment['isReported'] == 0){
        echo "<a href=\"index.php?action=reportComment&commentId=".$comment['commentId']."\"> Signaler...</a>";
    } else {
            echo "<p> Ce commentaire a déja été signalé </p>";
        } ?>
    </div>
        </div>
        <?php
    }
    ;?>
    </div>
    </div>
    <div class="modal fade" id="commentPopUp" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Votre Commentaire:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-comment" action="index.php?action=addComment" method="post">
                        <div class="form-group">
                            <textarea class="form-control" name="commentaire" id="inputCommentaire" placeholder="Tapez votre commentaire..."></textarea>
                            <input type="hidden" value="<?= $gameData['gameId'];?>" name="gameId">
                            <input type="hidden" value="<?= $_SESSION['pseudo'];?>" name="pseudo">
                            <input type="hidden" value="<?= $gameData['gameslug'];?>" name="gameSlug">
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="noteGameModal" tabindex="-1" role="dialog" aria-labelledby="noteGameLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Noter <?=$gameData['gameName'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="note">
            <form method="post" action="index.php?action=noteGame&gameId=<?=$gameData['gameId'];?>">
            <div class="form-group">
                <label for="noteGraphismes"> Graphismes :</label>
                <input type="number" name="noteGraphismes" id="noteGraphismes" min="0" max="5" value="3">
                <span>/5</span>
            </div>
                <div class="form-group">
                <label for="noteGameplay"> Gameplay :</label>
                <input type="number" name="noteGameplay" id="noteGameplay" min="0" max="5" value="3">
                <span>/5</span>
            </div>
            <div class="form-group">
                <label for="noteAmbiance"> Ambiance :</label>
                <input type="number" name="noteAmbiance" id="noteAmbiance" min="0" max="5" value="3">
                <span>/5</span>
            </div>
            <div class="form-group">
                <label for="notePerso"> Note perso :</label>
                <input type="number" name="notePerso" id="notePerso" min="0" max="5" value="3">
                <span>/5</span>
            </div>
            <input type="hidden" name="userId" value="<?= $_SESSION['userId'];?>">
            <input type="hidden" name="gameSlug" value="<?= $gameData['gameslug'];?>">
            <button type="submit" class="btn btn-danger">Envoyer</button>
            </form>

        </div>
      </div>
    </div>
  </div>
</div>

</div>
<script> apiUrl = "https://api.rawg.io/api/games/<?=$gameData['gameslug'];?>"</script>
<?php $content = ob_get_clean();?>
<?php include "view/template.php";?>
<script src="public/js/getGame.js"></script>

