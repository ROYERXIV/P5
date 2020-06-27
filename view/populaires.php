<?php $title = "Populaires" ;?>
<?php ob_start();?>

<div class="container latest-games" id="app">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12" v-for="game in games">
            <div class="card">
                <div id="game-img-container">
                    <img class="card-img-top game-img" v-bind:src="game.gameImg" alt="Card image cap">
                </div> 
                <div class="card-body">
                    <h5 class="card-title game-title"><a :href="'index.php?action=getGame&game='+game.gameslug">{{game.gameName}}</a></h5>
                    <ul>
                        <li v-for="platform in game.plateformes" class="platformIcons">
                            <img v-bind:src="'public/img/'+platform.platformName+'.png'" alt="" v-bind:title="platform.platformName">
                        </li>
                    </ul>
                    <p v-html=game.gameDescription class="card-text gameDescription"></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="pages-nav">
        <a v-if="pageId > 1" @click="prevPage()" href="#top"> Page precedente </a>
        <a v-if="pageId > 4" @click="getPage(0, pageId= 1)" href="#top"> 1 </a>
        <a v-if="pageId > 3" @click="getPage(-3)" href="#top"> {{pageId - 3 }}</a>
        <a v-if="pageId > 2" @click="getPage(-2)" href="#top"> {{pageId - 2 }}</a>
        <a v-if="pageId > 1" @click="getPage(-1)" href="#top"> {{pageId - 1 }}</a>
        <a > {{pageId}}</a>
        <a @click="getPage(1)" href="#top"> {{pageId + 1 }}</a>
        <a @click="getPage(2)" href="#top"> {{pageId + 2 }}</a>
        <a @click="getPage(3)" href="#top"> {{pageId + 3 }}</a>
        <a @click="nextPage()" href="#top"> Page Suivante </a>    
    </div> -->
</div>
<?php $content = ob_get_clean();?>
<?php include "view/template.php";?>
<script>  var gamesData = <?= $games;?> </script>
<script src="public/js/getGames.js"></script>
