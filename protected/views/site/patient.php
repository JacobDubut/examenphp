<div class="content">
    <div class="sidebar">
        <input id="user_id" type="hidden" value="<?= $model->user_id; ?>">
        <section id="box-photo-profil" class="box-pp clearfix">
            <form>
                <label for="btn-box-pp"></label>
                <? //if($model->picture_src): ?>
                <input id="btn-box-pp" type="image" src="<?= Yii::app()->theme->baseUrl; ?>/img/photo-medecin-profil.png" alt="photodeprofil" />
                <? //endif; ?>
            </form>
        </section>

        <h3>Informations</h3>

        <ul id="informations-patient">
            <li><label for="is-tel" class="libelle"></label><input id="is-tel" type="text" value="<?= $model->phone_number; ?>" /></li>
            <li><label for="is-mail" class="libelle"></label><input id="is-mail" type="text" value="<?= $model->email; ?>" /></li>
            <li><label for="is-adresse" class="libelle"></label><input id="is-adresse" type="text" value="<?= $model->address_1; ?>" /></li>
            <li><label for="is-localite" class="libelle"></label><input id="is-localite" type="text" value="<?= $model->address_2; ?>" /></li>
        </ul><!--end informations-patient-->

        <!-- je tape son mail, il est invité ? -->
        <label for="nouveaupatient" class="addpatient" id="btn-add-patient"></label>
        <input id="nouveaupatient" class="addpatient" type="text" placeholder="ajouter un patient" />

        <!-- je créée avec lui le profil -->

        <!-- <a href="inscription.html" id="inscristoi" >Ajouter un patient</a> -->


    </div><!--end sidebar-->

    <div class="inner-content">

        <h3>Patients</h3>

        <ul>
            <? foreach($patients as $patient): ?>
                <li class="note-patient">
                    <a href="<?= Yii::app()->createUrl('site/consultation', array('id' => $patient->patient_id)); ?>">
                        <span class="photo-profil-jdb pp-patient"></span>
                        <p class="nometprenom"><?= $patient->user->lastname; ?> <?= $patient->user->firstname; ?></p>
                        <p class="intolérances"><?= $patient->intolerances; ?></p>
                        <p class="informations-utiles">
                            <span class="telephone"></span><span class="telnumber"><?= $patient->user->phone_number; ?></span>
                            <span class="email"></span><span class="email-text"><?= $patient->user->email; ?></span>
                        </p>
                    </a>
                </li>
            <? endforeach; ?>
        </ul><!--end souper-->

    </div><!--end inner-content-->

</div><!--end content-->

<input id="doctor" type="hidden" value="<?= $model->doctor->doctor_id; ?>">

<script>
    $(function(){
        var user_id = $('#user_id').val();

        $('#btn-add-patient').click(function(){
            var data = {
                email: $('#nouveaupatient').val(),
                doctor_id: $('#doctor').val()
            };
            $.post('<?= Yii::app()->createUrl('ajax/addPatient'); ?>', data, function(data) {
                $(location).attr('href', 'patient');
            });
        });
/*
        $('#nouveaupatient').autocomplete({
            source: function(request, response){
                var data = {
                    value: $('#nouveaupatient').val()
                };
                $.post('<?= Yii::app()->createUrl('ajax/getPatients'); ?>', data, function(data) {
                    response($.parseJSON(data));
                });
            }
        });
*/
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
    });
</script>