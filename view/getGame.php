<?php $gameSlug = $gameSlug['gameslug'];?>
<?php $title = 'JEU' ;?>
<?php ob_start() ;?>

<div id="app">
<h2>{{game.name}}</h2>
<p> Sortie: {{game.released}}</p>
    <div class="game-page-img">
        <img v-bind:src="game.background_image">
    </div>
    <div class="game-page-infos">

        <div id="note">
            <form method="post" action="index.php?action=noteGame&game=<?=$gameSlug;?>">
            <div class="form-group">
                <label for="noteGraphismes"> Graphismes :</label>
                <input type="range" name="noteGraphismes" id="noteGraphismes" min="0" max="5" value="3">
            </div>
                <div class="form-group">
                <label for="noteGameplay"> Gameplay :</label>
                <input type="range" name="noteGameplay" id="noteGameplay" min="0" max="5" value="0">
            </div>
            <div class="form-group">
                <label for="noteAmbiance"> Ambiance :</label>
                <input type="range" name="noteAmbiance" id="noteAmbiance" min="0" max="5" value="0">
            </div>
            <div class="form-group">
                <label for="notePerso"> Note perso :</label>
                <input type="range" name="notePerso" id="notePerso" min="0" max="5" value="0">
            </div>
            <input type="hidden" name="userId" value="<?= $_SESSION['pseudo'];?>">
            <button type="submit" class="btn btn-danger">Noter</button>
            </form>

        </div>
        <div class="platforms">
            <ul>
                <li v-for="platform in game.parent_platforms" class="platformIcons">
                    <img v-bind:src="'public/img/'+platform.platform.name+'.png'" alt="" v-bind:title="platform.platform.name">
                </li>
            </ul>
        </div>
        <p> Description du jeu</p>
    </div>
    <div>
        <button class="btn" data-toggle="modal" data-target="#commentPopUp"> Ecrire un commentaire </button>
    </div>
    <div class="game-page-comments">
        <div class="comment">
            <p class="comment-user-name">Pseudo</p>
            <p class="comment-content">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi esse ab quod officia dolor ducimus enim odit reprehenderit hic consequuntur. Perspiciatis earum amet similique voluptatibus minus ab tenetur reiciendis ipsa.</p>
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
                            <input type="hidden" value="<?= $gameSlug;?>" name="game">
                            <input type="hidden" value="<?= $_SESSION['pseudo'];?>" name="pseudo">
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script> apiUrl = "https://api.rawg.io/api/games?search=<?=$gameSlug;?>"</script>
<?php $content = ob_get_clean();?>
<?php include "view/template.php";?>
<script src="public/js/getGame.js"></script>
