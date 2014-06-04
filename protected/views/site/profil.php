<?
setlocale (LC_TIME, 'fr_FR.utf8','fra');
?>
<div class="content">
    <div class="sidebar">
        <input id="user_id" type="hidden" value="<?= $model->user_id; ?>">
        <section id="box-photo-profil" class="box-pp clearfix">
            <form>
                <label for="btn-box-pp"></label>
                <? //if($model->picture_src): ?>
                    <input id="btn-box-pp" type="image" src="<?= Yii::app()->theme->baseUrl; ?>/img/photo-patient-profil.png" alt="photodeprofil" />
                <? //endif; ?>
            </form>
        </section>

        <h3>Informations générales</h3>

        <ul id="informations-generales">
            <li>
                <label for="ig-nom" class="libelle">Nom:</label>
                <input id="ig-nom" type="text" value="<?= $model->lastname; ?>" />
            </li>
            <li>
                <label for="ig-prenom" class="libelle">Prénom:</label>
                <input id="ig-prenom" type="text" value="<?= $model->firstname; ?>" />
            </li>
            <li>
                <label for="ig-age" class="libelle">Date de naissance:</label>
                <input id="ig-age" type="text" value="<?= (!$model->patient->birthday) ? '' : date_format(new DateTime($model->patient->birthday), 'Y-m-d'); ?>" />
            </li>
        </ul><!--end informations-generales-->

        <h3>Caractéristiques physiques</h3>

        <ul id="informations-patient">
            <li>
                <label for="ip-poids" class="libelle">Poids:</label>
                <input id="ip-poids" type="text" value="<?= (!$model->patient->weight) ? '' : $model->patient->weight . ' kg'; ?>" />
            </li>
            <li>
                <label for="ip-taille" class="libelle">Taille:</label>
                <input id="ip-taille" type="text" value="<?= (!$model->patient->size) ? '' : $model->patient->size; ?> " />
            </li>
            <li>
                <label for="ip-intolerance" class="libelle">Intolérances:</label>
                <input id="ip-intolerance" type="text" value="<?= $model->patient->intolerances; ?>" />
            </li>
        </ul><!--end informations-patient-->

        <h3>Informations supplémentaires</h3>

        <ul id="informations-supp">
            <li><label for="is-tel" class="libelle"></label><input id="is-tel" type="text" value="<?= $model->phone_number; ?>" /></li>
            <li><label for="is-mail" class="libelle"></label><input id="is-mail" type="text" value="<?= $model->email; ?>" /></li>
            <li><label for="is-adresse" class="libelle"></label><input id="is-adresse" type="text" value="<?= $model->address_1; ?>" /></li>
            <li><label for="is-localite" class="libelle"></label><input id="is-localite" type="text" value="<?= $model->address_2; ?>" /></li>
        </ul><!--end informations-patient-->

    </div><!--end sidebar-->

    <div class="inner-content">
        <h3>Evolution du traitement</h3>

        <ul class="evolution-traitement-graph clearfix">
            <? foreach($model->patient->treatments as $treatment): ?>
                <li>
                    <?
                    $css = '';
                    if($treatment->count == 0) {
                        $css = 'background: #969fa8;bottom: 10px';
                    } else {
                        $css = 'bottom: ' . $treatment->count * 20 . 'px';
                    }
                    ?>
                    <span class="frequence-evo" style="<?= $css; ?>"><?= $treatment->count; ?></span>
                    <span class="month-evo"><?= Treatment::getMonth($treatment->month); ?></span>
                </li>
            <? endforeach; ?>
        </ul><!--end evolution-traitement-->

        <h3>Particularités</h3>

        <ul class="particularite-traitement">
            <li><input type="text" value="Intolérant à la gliadine (gluten, maladie de cœliaque)" /></li>
            <li><input type="text" value="Eviter les fromages à base de lait de vache" /></li>
            <li><input type="text" value="Préférer le lait de soja, de chèvre et/ou sans lactose" /></li>
        </ul>

        <ul class="particularite-traitement">
            <li><input type="text" value="Intolérant au lactose bovidé" /></li>
            <li><input type="text" value="Eviter les fromages à base de lait de vache" /></li>
            <li><input type="text" value="Préférer le lait de soja, de chèvre et/ou sans lactose" /></li>
        </ul>

        <ul class="particularite-traitement">
            <li><input type="text" value="Ultrasensibilité à la fermentation végétale" /></li>
            <li><input type="text" value="Eviter les bières et boissons alcoolisées fermentées" /></li>
            <li><input type="text" value="Lait et autres aliments obtenues par fermentation" /></li>
        </ul>

        <h3>Améliorations</h3>

        <ul class="amelioration-traitement">
            <li><input type="text" value="Forte diminution de l’intolérance à la gliadine" /></li>
            <li><input type="text" value="Supporte jusqu’à 2 repas contenant du gluten par jour" /></li>
        </ul>

        <ul class="amelioration-traitement">
            <li><input type="text" value="Amélioration de sa condition quant au lactose bovidé" /></li>
            <li><input type="text" value="Ce n’est pas la cible première du traitement mais nous avons améliorés sa tolérance au lactose bovidé." /></li>
        </ul>

        <ul class="amelioration-traitement">
            <li><input type="text" value="Stabilisation de la sensibilité" /></li>
            <li><input type="text" value="Nous n’avons pas encore travaillé sur ça." /></li>
        </ul>

    </div><!--end inner-content-->

</div><!--end content-->

<script>
    $(function(){
        var user_id = $('#user_id').val();

        $('#ig-age').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('#ig-age').change(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'birthday'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#ig-nom').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'lastname'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#ig-nom').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'lastname'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#ig-prenom').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'firstname'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#is-tel').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'phone_number'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#is-mail').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'email'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#is-adresse').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'address_1'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#is-localite').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'address_2'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#ip-taille').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'size'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#ip-intolerance').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'intolerances'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });

        $('#ip-poids').blur(function(){
            var data = {
                user_id: user_id,
                value: $(this).val(),
                type: 'weight'
            };
            $.post('<?= Yii::app()->createUrl('ajax/updateProfil'); ?>', data, function(){});
        });
    });
</script>