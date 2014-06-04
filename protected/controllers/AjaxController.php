<?php

class AjaxController extends Controller {

	public function actionUpdateProfil() {
        $type = $_POST['type'];
        $value = $_POST['value'];
        $userId = $_POST['user_id'];

        $user = User::model()->findByPk($userId);

        if($user) {
            switch($type) {
                case 'lastname':
                    $user->lastname = $value;
                    $user->save();
                    break;
                case 'firstname':
                    $user->firstname = $value;
                    $user->save();
                    break;
                case 'email':
                    $user->email = $value;
                    $user->save();
                    break;
                case 'address_1':
                    $user->address_1 = $value;
                    $user->save();
                    break;
                case 'address_2':
                    $user->address_2 = $value;
                    $user->save();
                    break;
                case 'phone_number':
                    $user->phone_number = $value;
                    $user->save();
                    break;
                case 'weight':
                    $patient = $user->patient;
                    $patient->weight = $value;
                    $patient->save();
                case 'size':
                    $patient = $user->patient;
                    $patient->size = $value;
                    $patient->save();
                case 'intolerances':
                    $patient = $user->patient;
                    $patient->intolerances = $value;
                    $patient->save();
                    break;
                case 'birthday':
                    $patient = $user->patient;
                    $patient->birthday = $value;
                    $patient->save();
                    break;
                default:
                    break;
            }
        }
	}

    public function actionAddTest() {
        $userId = $_POST['user_id'];
        $value = $_POST['value'];
        $user = User::model()->findByPk($userId);
        if($user) {
            $todo = new Todo();
            $todo->user_id = $userId;
            $todo->content = $value;
            $todo->save();
        }
    }

    public function actionAddNote() {
        $userId = $_POST['user_id'];
        $value = $_POST['value'];
        $type = $_POST['type'];
        $date = $_POST['date'];

        $user = User::model()->findByPk($userId);

        if($user) {
            $note = new Note();
            $note->user_id = $userId;
            $note->content = $value;
            $note->date = date_format(new DateTime($date), 'Y-m-d H:i:s');
            $note->type = $type;
            $note->save();
            return true;
        } else {
            return false;
        }
    }

    public function actionAddDoctorNote() {
        $userId = $_POST['user_id'];
        $value = $_POST['value'];
        $type = $_POST['type'];
        $date = $_POST['date'];

        $user1 = User::model()->findByAttributes(array(
            'email' => Yii::app()->user->id
        ));
        $doctorId = $user1->doctor->doctor_id;

        $user = User::model()->findByPk($userId);

        if($user) {
            $note = new Note();
            $note->user_id = $userId;
            $note->doctor_id = $doctorId;
            $note->content = $value;
            $note->date = $date;
            $note->type = $type;
            $note->is_checked = NULL;
            $note->save();
            return true;
        } else {
            return false;
        }
    }

    public function actionGetPatients() {
        $value = $_POST['value'];

        $criteria = new CDbCriteria();

        $patients = Patient::model()->findAll($criteria);

        $response = array();
        foreach($patients as $patient) {
            $response[$patient->patient_id] = $patient->user->email;
        }

        echo CJSON::encode($response);
    }

    public function actionAddPatient() {
        $email = $_POST['email'];
        $doctorId = $_POST['doctor_id'];

        $user = User::model()->findByAttributes(array(
            'email' => $email
        ));

        $patient = $user->patient;
        $patient->doctor_id = $doctorId;
        $patient->save();

        echo CJSON::encode(true);
    }

    public function actionAddCount() {
        $noteId = $_POST['note_id'];
        $patient = $_POST['patient_id'];
        $date = $_POST['date'];

        $month = date_format(new DateTime($date), 'm');

        $treatment = Treatment::model()->findByAttributes(array(
            'patient_id' => $patient,
            'month' => $month
        ));

        $treatment->count = $treatment->count + 1;
        $treatment->save();

        $note  = Note::model()->findByPk($noteId);
        $note->is_checked = 1;
        $note->save();
    }

    public function actionRemoveCount() {
        $noteId = $_POST['note_id'];

        $note  = Note::model()->findByPk($noteId);
        $note->is_checked = 1;
        $note->save();
    }

    public function actionGood() {
        $todoId = $_POST['todo_id'];
        $todo = Todo::model()->findByPk($todoId);
        $todo->good = 1;
        $todo->save();
    }
    public function actionBad() {
        $todoId = $_POST['todo_id'];
        $todo = Todo::model()->findByPk($todoId);
        $todo->good = 0;
        $todo->save();
    }

}