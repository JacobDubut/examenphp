<?
setlocale (LC_TIME, 'fr_FR.utf8','fra');
?>
<div class="content">
    <div class="sidebar">
        <ul id="week-selector">
            <a href="<?= Yii::app()->createUrl('site/journal',
                array('date' => $date, 'current_week' => $current, 'direction' => 'left')); ?>">
                <li id="backto">par là</li>
            </a>
            <li id="week">Semaine <?= $current; ?></li>
            <a href="<?= Yii::app()->createUrl('site/journal',
                array('date' => $date, 'current_week' => $current, 'direction' => 'right')); ?>">
                <li id="goto">par ici</li>
            </a>
        </ul><!--end week-selector-->
        <ul id="calendar">
            <? foreach($weeks as $week): ?>
                <a href="<?= Yii::app()->createUrl('site/journal',
                    array('date' => date_format($week, 'Y-m-d'), 'current_week' => $current)); ?>">
                    <li id="day-one" class="days <?= ($date == date_format($week, 'Y-m-d'))?'selected':''; ?>">
                        <span class="blockacentrer">
                            <span id="number-date-one" class="number-date"><?= date_format($week, 'd.m'); ?></span>
                            <span class="alpha-date">- <?= strftime('%A', strtotime(date_format($week, 'Y-m-d'))); ?></span>
                        </span>
                    </li>
                </a>
            <? endforeach; ?>
        </ul><!--end calendar-->

        <h3>A tester</h3>

        <label for="nouveautest" data-id="<?= $model->user_id; ?>" class="addtest btn-test"></label>
        <input id="nouveautest" class="addtest" type="text" placeholder="ajouter un test" />

        <ul id="test-month">
            <? foreach($todos as $todo): ?>
                <li id="week-one" class="week">

                    <label class="atester good-test <?= ($todo->good != null && $todo->good == 1) ? 'active-test' : ''; ?>" data-id="<?= $todo->todo_id; ?>"></label>
                    <input class="hidden-input" name="choices-week-one" type="radio" />

                    <label class="atester bad-test <?= ($todo->good != null && $todo->good == 0) ? 'active-test' : ''; ?>" data-id="<?= $todo->todo_id; ?>"></label>
                    <input class="hidden-input" name="choices-week-one" type="radio" />

                    <input class="alimenttest" type="text" value="<?= $todo->content; ?>" />
                </li>
            <? endforeach; ?>
        </ul><!--end test-month-->

    </div><!--end sidebar-->

    <div class="inner-content">
        <h3>Déjeuner</h3>
        <ul>
            <? foreach($notes as $note): ?>
                <? if($note->type == 'Déjeuner'): ?>
                    <? if($note->doctor): ?>
                        <li class="note-medecin">
                            <span class="photo-profil-jdb pp-medecin"></span>
                            <p><?= $note->content; ?></p>
                        </li>
                    <? else: ?>
                        <li class="note-patient">
                            <span class="photo-profil-jdb pp-patient"></span>
                            <p><?= $note->content; ?></p>
                        <span class="digestion">
                            <? if($note->is_checked == 0): ?>
                                <label id="good-digestion-dejeuner" for="good-d-dejeuner"></label>
                                <label id="bad-digestion-dejeuner" for="bad-d-dejeuner"></label>
                                <input data-note-id="<?= $note->note_id; ?>" type="radio" id="good-d-dejeuner" class="good-digestion good" name="digestion-dejeuner" />
                                <input data-note-id="<?= $note->note_id; ?>" data-patient-id="<?= $model->patient->patient_id; ?>" data-date="<?= $note->date; ?>" type="radio" id="bad-d-dejeuner" class="bad-digestion bad" name="digestion-dejeuner" />
                            <? endif; ?>
                        </span>
                        </li>
                    <? endif; ?>
                <? endif; ?>
            <? endforeach; ?>
            <li class="note-ajout">
                <label data-type="Déjeuner" data-id="<?= $model->user_id; ?>" class="btn-add-note photo-profil-jdb pp-ajout"></label>
                <form><input class="text-add" type="text" placeholder="Ajouter une note"/></form>
            </li>
        </ul>
        <h3>Diner</h3>
        <ul>
            <? foreach($notes as $note): ?>
                <? if($note->type == 'Diner'): ?>
                    <? if($note->doctor): ?>
                        <li class="note-medecin">
                            <span class="photo-profil-jdb pp-medecin"></span>
                            <p><?= $note->content; ?></p>
                        </li>
                    <? else: ?>
                        <li class="note-patient">
                            <span class="photo-profil-jdb pp-patient"></span>
                            <p><?= $note->content; ?></p>
                        <span class="digestion">
                            <? if($note->is_checked == 0): ?>
                               <label id="good-digestion-diner" for="good-d-diner"></label>
                                <label id="bad-digestion-diner" for="bad-d-diner"></label>
                                <input data-note-id="<?= $note->note_id; ?>" type="radio" id="good-d-diner" class="good-digestion good" name="digestion-diner" />
                                <input data-note-id="<?= $note->note_id; ?>" data-patient-id="<?= $model->patient->patient_id; ?>" data-date="<?= $note->date; ?>" type="radio" id="bad-d-diner" class="bad-digestion bad" name="digestion-diner" />
                            <? endif; ?>
                        </span>
                        </li>
                    <? endif; ?>
                <? endif; ?>
            <? endforeach; ?>
            <li class="note-ajout">
                <label data-type="Diner" data-id="<?= $model->user_id; ?>" class="btn-add-note photo-profil-jdb pp-ajout"></label>
                <form><input class="text-add" type="text" placeholder="Ajouter une note"/></form>
            </li>
        </ul>
        <h3>Souper</h3>
        <ul>
            <? foreach($notes as $note): ?>
                <? if($note->type == 'Souper'): ?>
                    <? if($note->doctor): ?>
                        <li class="note-medecin">
                            <span class="photo-profil-jdb pp-medecin"></span>
                            <p><?= $note->content; ?></p>
                        </li>
                    <? else: ?>
                        <li class="note-patient">
                            <span class="photo-profil-jdb pp-patient"></span>
                            <p><?= $note->content; ?></p>
                        <span class="digestion">
                            <? if($note->is_checked == 0): ?>
                                <label id="good-digestion-souper" for="good-d-souper"></label>
                                <label id="bad-digestion-souper" for="bad-d-souper"></label>
                                <input data-note-id="<?= $note->note_id; ?>" type="radio" id="good-d-souper" class="good-digestion good" name="digestion-souper" />
                                <input data-note-id="<?= $note->note_id; ?>" data-patient-id="<?= $model->patient->patient_id; ?>" data-date="<?= $note->date; ?>" type="radio" id="bad-d-souper" class="bad-digestion bad" name="digestion-souper" />
                            <? endif; ?>
                        </span>
                        </li>
                    <? endif; ?>
                <? endif; ?>
            <? endforeach; ?>
            <li class="note-ajout">
                <label data-type="Souper" data-id="<?= $model->user_id; ?>" class="btn-add-note photo-profil-jdb pp-ajout"></label>
                <form><input class="text-add" type="text" placeholder="Ajouter une note"/></form>
            </li>
        </ul>

        <h3>Avis sur la journée</h3>
        <ul>
            <? foreach($notes as $note): ?>
                <? if($note->type == 'Avis sur la journée'): ?>
                    <? if($note->doctor): ?>
                        <li class="note-medecin">
                            <span class="photo-profil-jdb pp-medecin"></span>
                            <p><?= $note->content; ?></p>
                        </li>
                    <? else: ?>
                        <li class="note-patient">
                            <span class="photo-profil-jdb pp-patient"></span>
                            <p><?= $note->content; ?></p>
                        </li>
                    <? endif; ?>
                <? endif; ?>
            <? endforeach; ?>
            <li class="note-ajout">
                <label data-type="Avis sur la journée" data-id="<?= $model->user_id; ?>" class="btn-add-note photo-profil-jdb pp-ajout"></label>
                <form><input class="text-add" type="text" placeholder="Ajouter une note"/></form>
            </li>
        </ul>
    </div>
</div><!--end content-->

<input id="date-day" type="hidden" value="<?= (isset($_GET['date'])) ? $_GET['date'] : date_format(new DateTime(), 'Y-m-d'); ?>"/>

<script>
    $(function(){
        $('.btn-add-note').click(function(){
            var data = {
                user_id: $(this).attr('data-id'),
                type: $(this).attr('data-type'),
                value: $(this).parent('li').find('.text-add').val(),
                date: $('#date-day').val()
            };
            $.post('<?= Yii::app()->createUrl('ajax/addNote'); ?>', data, function(){
                $(location).attr('href', 'journal');
            });
        });

        $('.good-test').click(function(){
            data = {
                'todo_id': $(this).attr('data-id')
            };
            $.post('<?= Yii::app()->createUrl('ajax/good'); ?>', data, function(){
                $(location).attr('href', 'journal');
            });
        });
        $('.bad-test').click(function(){
            data = {
                'todo_id': $(this).attr('data-id')
            };
            $.post('<?= Yii::app()->createUrl('ajax/bad'); ?>', data, function(){
                $(location).attr('href', 'journal');
            });
        });

        $('.btn-test').click(function() {
            var data = {
                user_id: $(this).attr('data-id'),
                value: $('#nouveautest').val()
            };
            $.post('<?= Yii::app()->createUrl('ajax/addTest'); ?>', data, function(){
                $(location).attr('href', 'journal');
            });
        });

        $('.good').click(function(){
            var elem = $(this).parent('span');
            var data = {
                note_id: $(this).attr('data-note-id')
            };
            $.post('<?= Yii::app()->createUrl('ajax/removeCount'); ?>', data, function(){
                elem.hide();
            });
        });
        $('.bad').click(function(){
            var elem = $(this).parent('span');
            var data = {
                date: $(this).attr('data-date'),
                patient_id: $(this).attr('data-patient-id'),
                note_id: $(this).attr('data-note-id')
            };
            $.post('<?= Yii::app()->createUrl('ajax/addCount'); ?>', data, function(){
                elem.hide();
            });
        });
    });
</script>
