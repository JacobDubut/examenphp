<div id="banner-inscription" class="banner">
    <h2>Le journal de bord de vos habitudes<br />alimentaires</h2>
    <hr />
    <p class="startjdb">Devenez membre dés maintenant</p>
</div><!--end banner-->

<div class="content">

    <?= CHtml::beginForm(); ?>
        <?= CHtml::errorSummary($model); ?>
        <?= CHtml::activeTextField($model, 'email', array(
            'id' => 'email',
            'class' => 'log-field',
            'placeholder' => 'Email'
        )); ?>
        <?= CHtml::activePasswordField($model, 'password', array(
            'id' => 'password',
            'class' => 'log-field',
            'placeholder' => 'Mot de passe'
        )); ?>
        <input id="medecin" class="log-field" type="radio" value="1" name="User[is_doctor]" />
        <label for="medecin" class="medecin">Je suis un médecin</label>
        <input id="patient"  class="log-field" type="radio" value="0" name="User[is_doctor]" />
        <label for="patient" class="patient">Je suis un patient</label>
        <?= CHtml::submitButton('Je m\'inscris', array('class' => 'submit')); ?>
    <?= CHtml::endForm(); ?>

</div><!--end content-->