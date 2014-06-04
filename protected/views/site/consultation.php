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

    </div><!--end sidebar-->

    <div class="inner-content">

        <h3>Nouvelles notes</h3>

        <ul>
            <? foreach($notes as $note): ?>
                <? if($note->doctor == null): ?>
                    <li class="note-patient">
                        <span class="photo-profil-jdb pp-patient"></span>
                        <p><?= $note->content; ?></p>
                            <span class="digestion">
                                <!-- PROB ID --><label id="good-digestion-souper" for="good-d-souper"></label>
                                <label id="bad-digestion-souper" for="bad-d-souper"></label>
                                    <input type="radio" id="good-d-souper" class="good-digestion" name="digestion-souper" />
                                    <input type="radio" id="bad-d-souper" class="bad-digestion" name="digestion-souper" />
                            </span><!--end digestion-->


                        <?
                        $doctorNote = Note::model()->findByAttributes(array(
                            'user_id' => $note->user_id,
                            'doctor_id' => $model->doctor->doctor_id,
                            'date' => $note->date,
                            'type' => $note->type
                        ));
                        if(!empty($doctorNote)):
                        ?>
                            <span class="photo-profil-jdb pp-medecin"></span>
                            <p><?= $doctorNote->content; ?></p>
                        <? else: ?>
                        <section class="note-ajout">
                            <label data-date="<?= $note->date; ?>" data-type="<?= $note->type; ?>" data-id="<?= $note->user_id; ?>" data-patient-id="<?= $note->user->patient->patient_id; ?>" class="photo-profil-jdb pp-ajout btn-add-note"></label>
                            <form><input type="text" placeholder="Ajouter une note" class="text-add"/></form>
                        </section><!--end note-ajout-->
                        <? endif; ?>
                    </li>
                <? endif; ?>
            <? endforeach; ?>
        </ul><!--end note-patient-->

    </div><!--end inner-content-->

</div><!--end content-->
<script>
    $(function(){
        var user_id = $('#user_id').val();

        $('.btn-add-note').click(function(){
            patient_id = $(this).attr('data-patient-id');
            var data = {
                user_id: $(this).attr('data-id'),
                type: $(this).attr('data-type'),
                value: $(this).parent('section').find('.text-add').val(),
                date: $(this).attr('data-date')
            };
            $.post('<?= Yii::app()->createUrl('ajax/addDoctorNote'); ?>', data, function(){
                $(location).attr('href', 'consultation?id=' + patient_id);
            });
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
    });
</script>