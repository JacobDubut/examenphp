<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Gluten Free | Bienvenue</title>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link href="<?= Yii::app()->theme->baseUrl; ?>/img/favicon.png" type="image/x-icon" rel="shortcut icon" />

    <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/css/reset.css" />
    <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/css/style.css" />


    <script type="text/javascript" src="<?= Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>

    <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl; ?>/js/jui/css/ui-lightness/jui.min.css" />
    <script type="text/javascript" src="<?= Yii::app()->theme->baseUrl; ?>/js/jui/js/jui.min.js"></script>

</head>

<?
$id = 'index';
if(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'login') {
    $id = 'connexion';
} elseif(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'register') {
    $id = 'inscription';
} elseif(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'profil') {
    $id = 'profil';
} elseif(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'journal') {
    $id = 'jdb';
} elseif(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'consultation') {
    $id = 'consultation';
} elseif(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'patient') {
    $id = 'patients';
} /*elseif(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'apropos') {
    $id = 'apropos';
} elseif(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'credits') {
    $id = 'credits';
}*/
?>
<body id="<?= $id; ?>">

<header>
    <h1><a href="<?= Yii::app()->createUrl('site/index'); ?>">gluten free</a></h1>
    <nav>
        <ul class="menu">
            <? if(!Yii::app()->user->isGuest): ?>
                <? $user = User::model()->findByAttributes(array(
                    'email' => Yii::app()->user->id,
                )); ?>
                <? if($user->is_doctor == 1): ?>
                    <li><a href="<?= Yii::app()->createUrl('site/patient'); ?>">patients</a></li>
                <? else: ?>
                    <li><a href="<?= Yii::app()->createUrl('site/profil'); ?>">profil</a></li>
                    <li><a href="<?= Yii::app()->createUrl('site/journal'); ?>">journal</a></li>
                <? endif; ?>
                <li><a href="<?= Yii::app()->createUrl('site/logout'); ?>">déconnexion</a></li>
            <? else: ?>
                <li><a href="<?= Yii::app()->createUrl('site/login'); ?>">connexion</a></li>
            <? endif; ?>
        </ul>
    </nav><!--end menu-->
</header>

<?= $content; ?>

<footer>
    <span id="center-box">
    <ul class="info-footer">
        <li class="">Navigation</li>
        <? if(!Yii::app()->user->isGuest): ?>
            <? $user = User::model()->findByAttributes(array(
                'email' => Yii::app()->user->id,
            )); ?>
            <? if($user->is_doctor == 1): ?>
                <li><a href="<?= Yii::app()->createUrl('site/patient'); ?>">patients</a></li>
            <? else: ?>
                <li><a href="<?= Yii::app()->createUrl('site/profil'); ?>">profil</a></li>
                <li><a href="<?= Yii::app()->createUrl('site/journal'); ?>">journal</a></li>
            <? endif; ?>
            <li><a href="<?= Yii::app()->createUrl('site/logout'); ?>">déconnexion</a></li>
        <? else: ?>
            <li><a href="<?= Yii::app()->createUrl('site/login'); ?>">connexion</a></li>
        <? endif; ?>
    </ul>
    <ul class="info-footer">
        <li class="">Ressources</li>
        <li class=""><a href="apropos.php">A propos</a></li>
        <li class=""><a href="credits.php">Crédits</a></li>
    </ul>
    <ul class="info-footer">
        <li class="">Réseaux sociaux</li>
        <li class=""><a href="https://twitter.com/GlutenFreejdb" target="_blank" >Twitter</a></li>
        <li class=""><a href="https://www.facebook.com/profile.php?id=100008311488535" target="_blank" >Facebook</a></li>
    </ul>
    </span>

    <p class="copyright">© copyright 2013.2014 - fait à Namur, Belgique par Jacob Dubut</p>

</footer>

</body>
</html>
