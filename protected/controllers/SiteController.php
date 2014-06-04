<?php

class SiteController extends Controller {

	public function actionIndex() {
		$this->render('index');
	}

    public function actionApropos() {
        $this->render('apropos');
    }

    public function actionCredits() {
        $this->render('credits');
    }

	public function actionError() {
		if($error = Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLogin()
	{
		$model = new LoginForm();

		if(isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
		}

		$this->render('login',array('model'=>$model));
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->createUrl('site/index'));
	}

    public function actionRegister() {
        $model = new User();

        if(isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->is_doctor = $_POST['User']['is_doctor'];
            if($model->validate()){
                $login = new LoginForm();
                $login->username = $model->email;
                $login->password = $model->password;

                $model->password = $this->crypt($model->password);
                $model->save();
                if($model->is_doctor == 0) {
                    $patient = new Patient();
                    $patient->user_id = $model->user_id;
                    $patient->save();

                    for($i = 1; $i <= 12 ; $i++){
                        $treatment = new Treatment();
                        $treatment->patient_id = $patient->patient_id;
                        $treatment->month = $i;
                        $treatment->count = 0;
                        $treatment->save();
                    }
                } else {
                    $doctor = new Doctor();
                    $doctor->user_id = $model->user_id;
                    $doctor->save();
                }

                $headers = 'Content-type: text/html; charset=UTF-8';
                $message = "Bonjour et Bienvenue sur GlutenFree,<br />Connectez-vous dés maintenant et commencez à remplir votre journal.
                <br /><a href=\"http://jacobdubut.be/tfe/gluten-free/index.php/site/login\">Cliquez ici</a>";
                mail($model->email, 'Bienvenue sur GlutenFree', $message, $headers);
                $login->login();
                $this->redirect(Yii::app()->createUrl('site/index'));
            }
        }

        $this->render('register', array(
            'model' => $model
        ));
    }

    public function actionProfil() {
        if(Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('site/login'));
        }

        $user = User::model()->findByAttributes(array(
            'email' => Yii::app()->user->id
        ));

        if($user->is_doctor == 1) {
            $this->redirect(Yii::app()->createUrl('site/index'));
        }

        $this->render('profil', array(
            'model' => $user
        ));
    }

    public function actionJournal() {
        if(Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('site/login'));
        }

        $user = User::model()->findByAttributes(array(
            'email' => Yii::app()->user->id
        ));

        if($user->is_doctor == 1) {
            $this->redirect(Yii::app()->createUrl('site/index'));
        }

        $todos = $user->todos;


        if(isset($_GET['date'])) {
            $today = new DateTime($_GET['date']);
            $today2 = new DateTime($_GET['date']);
            $today2->setTime(23, 59, 59);
        } else {
            $today = new DateTime();
            $today->setTime(0, 0, 0);
            $today2 = new DateTime();
            $today2->setTime(23, 59, 59);
        }

        if(isset($_GET['current_week'])) {
            $week = $_GET['current_week'];
        } else {
            $ddate = date_format($today, 'Y-m-d');
            $duedt = explode("-", $ddate);
            $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
            $week  = (int)date('W', $date);
        }

        if(isset($_GET['direction'])) {
            if($_GET['direction'] == 'left') {
                $week--;
            } else {
                $week++;
            }
        }


        $gendate = new DateTime();
        $m = $gendate->setISODate(2014, $week, 1);
        $gendate = new DateTime();
        $t = $gendate->setISODate(2014, $week, 2);
        $gendate = new DateTime();
        $th = $gendate->setISODate(2014, $week, 3);
        $gendate = new DateTime();
        $w = $gendate->setISODate(2014, $week, 4);
        $gendate = new DateTime();
        $f = $gendate->setISODate(2014, $week, 5);
        $gendate = new DateTime();
        $s = $gendate->setISODate(2014, $week, 6);
        $gendate = new DateTime();
        $su = $gendate->setISODate(2014, $week, 7);
        $weeks = array($m, $t, $th, $w, $f, $s, $su);

        $criteria = new CDbCriteria();
        $criteria->condition = "t.user_id = " . $user->user_id . " AND t.date >= '" . date_format($today, 'Y-m-d H:i:s') . "' AND t.date < '" . date_format($today2, 'Y-m-d H:i:s') . "'";

        $notes = Note::model()
            ->with(array('user', 'doctor'))
            ->findAll($criteria);

        $this->render('journal', array(
            'model' => $user,
            'todos' => $todos,
            'notes' => $notes,
            'weeks' => $weeks,
            'current' => $week,
            'date' => date_format($today, 'Y-m-d')
        ));
    }

    public function actionConsultation() {
        $id = $_GET['id'];

        $patient = Patient::model()->findByPk($id);

        $user = $patient->user;

        $criteria = new CDbCriteria();
        $criteria->order = 'date DESC';
        $criteria->condition = 'user_id = ' . $user->user_id;

        $notes = Note::model()->findAll($criteria);

        $model = User::model()->findByAttributes(array(
            'email' => Yii::app()->user->id
        ));

        $this->render('consultation', array(
            'user' => $user,
            'notes' => $notes,
            'model' => $model
        ));
    }

    public function actionPatient() {
        if(Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('site/login'));
        }

        $user = User::model()->findByAttributes(array(
            'email' => Yii::app()->user->id
        ));

        if($user->is_doctor == 0) {
            $this->redirect(Yii::app()->createUrl('site/index'));
        }

        $patients = Patient::model()->with('user')->findAllByAttributes(array(
            'doctor_id' => $user->doctor->doctor_id
        ));

        $this->render('patient', array(
            'patients' => $patients,
            'model' => $user
        ));
    }

    private function crypt($password) {
        return md5('rorokaka' . md5($password, 'rorokaka'));
    }
}