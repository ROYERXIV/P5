<?php $title = "Accueil" ;?>
<?php ob_start();?>

<div id="slider">
        <div class="slide">
            <img src="public/img/slide1.jpg">
        </div>
        <div class="slide">
            <img src="public/img/slide2.jpg">
        </div>
        <div class="slide">
            <img src="public/img/slide3.jpg">
        </div>

</div>

<?php $content = ob_get_clean();?>
<?php include "view/template.php";?>
