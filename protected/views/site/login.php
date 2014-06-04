<?php $this->pageTitle = 'Je me connecte'; ?>
<div id="banner-connexion" class="banner">
    <h2>Le journal de bord de vos habitudes<br />alimentaires</h2>
    <hr />
    <p class="startjdb">Connectez-vous dés maintenant</p>
</div><!--end banner-->

<div class="content">

    <?= CHtml::beginForm(); ?>
        <?= CHtml::errorSummary($model); ?>
        <?= CHtml::activeTextField($model, 'username', array(
            'id' => 'email',
            'class' => 'log-field',
            'placeholder' => 'Email'
        )); ?>
        <?= CHtml::activePasswordField($model, 'password', array(
            'id' => 'password',
            'class' => 'log-field',
            'placeholder' => 'Mot de passe'
        )); ?>
        <?= CHtml::submitButton('Je me connecte', array('class' => 'submit')); ?>
    <?= CHtml::endForm(); ?>

    <p>Pas encore membre ? <a href="<?= Yii::app()->createUrl('site/register'); ?>">Inscrivez-vous</a> !</p>

</div><!--end content-->

