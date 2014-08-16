<?php

class SiteController extends Controller {

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogin() {
        $model = new LoginForm;


        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->render('login', array('model' => $model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionPopup() {
        $this->renderPartial('popup');
    }

    public function actionIndex() {


        //$model=new CActiveDataProvider('Vwexcel');
        $model = new Vwexcel('search');
        $model->unsetAttributes();
        if (isset($_GET['Vwexcel'])) {
            $model->attributes = $_GET['Vwexcel'];
        }

        $merge = new CDbCriteria;

        if (isset($_POST['submit'])) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];


            $merge->addBetweenCondition('date_ill', $date1, $date2);
        }

        if (isset($_GET['export'])) {
            $production = 'export';
        } else {
            $production = 'grid';
        }


        $this->render('v_excel', array(
            'dataProvider' => $model,
            'merge' => $merge,
            'production' => $production
        ));
    }

    public function actionIndex2() {

        $sql = "SELECT phs.prename,phs.name,phs.lname,phs.sex,phs.agey,phs.code506,phs.date_ill,phs.date_found
,phs.addr,SUBSTR(phs.moo,7) as moo,SUBSTR(phs.tmb,5) as tambon,substr(phs.amp,3) as amphur
,r.pcu_receive as hospcode,h.off_name as hospname,COUNT(phm.pcu_do) disease_control from patient_hos phs 
LEFT JOIN patient_home phm on phs.pid = phm.pid
LEFT JOIN receive r on r.pid = phs.pid
LEFT JOIN hospital h on h.off_id = r.pcu_receive
where phs.pid NOT in (select p.pid from patient_cut p)
GROUP BY phs.pid ";
        //ORDER BY phs.date_found desc

        $dataReader = Yii::app()->db->createCommand($sql)->queryAll();


        $dataProvider = new CSqlDataProvider($sql, array(// แบบ sql
            //$dataProvider = new CArrayDataProvider($dataReader, array(
            'totalItemCount' => count($dataReader),
            'pagination' => array(
                'pageSize' => 3
            ),
            'sort' => array(
                'attributes' => array(
                    'date_ill' => array(
                        'asc' => 'date_ill',
                        'desc' => 'date_ill DESC',
                    ),
                    'date_found' => array(
                        'asc' => 'date_found',
                        'desc' => 'date_found DESC',
                    ),
                    'name' => array(
                        'asc' => 'name',
                        'desc' => 'name DESC',
                    ),
                    'amphur' => array(
                        'asc' => 'amphur',
                        'desc' => 'amphur DESC',
                    ),
                    'disease_control' => array(
                        'asc' => 'disease_control',
                        'desc' => 'disease_control DESC',
                    ),
                    'hospcode' => array(
                        'asc' => 'hospcode',
                        'desc' => 'hospcode DESC',
                    ),
                    'code506' => array(
                        'asc' => 'code506',
                        'desc' => 'code506 DESC',
                    ),
                    'prename' => array(
                        'asc' => 'prename',
                        'desc' => 'prename DESC',
                    ),
                ),
            ),
        ));

        if (isset($_GET['export'])) {
            $production = 'export';
        } else {
            $production = 'grid';
        }

        $this->render('showpt', array(
            'dataProvider' => $dataProvider,
            'production' => $production
        ));
    }

    public function actionSql2Grid() {      
        $filtersForm = new FiltersForm;
        if (isset($_GET['FiltersForm']))
            $filtersForm->filters = $_GET['FiltersForm'];

        $sql = "SELECT phs.prename,phs.name,phs.lname,phs.sex,phs.agey,phs.code506,phs.date_ill,phs.date_found
,phs.addr,SUBSTR(phs.moo,7) as moo,SUBSTR(phs.tmb,5) as tambon,substr(phs.amp,3) as amphur
,r.pcu_receive as hospcode,h.off_name as hospname,COUNT(phm.pcu_do) disease_control from patient_hos phs 
LEFT JOIN patient_home phm on phs.pid = phm.pid
LEFT JOIN receive r on r.pid = phs.pid
LEFT JOIN hospital h on h.off_id = r.pcu_receive
where phs.pid NOT in (select p.pid from patient_cut p)
GROUP BY phs.pid ";

        $rawData = Yii::app()->db->createCommand($sql)->queryAll();

        $filteredData = $filtersForm->filter($rawData);
        
         
        $dataProvider = new CArrayDataProvider($filteredData, array(
            'id' => 'test',
            'totalItemCount' => count($rawData),
            'pagination' => array(
                'pageSize' => 8
            ),
            'sort' => array(
                'attributes' => array(
                    'date_ill' => array(
                        'asc' => 'date_ill',
                        'desc' => 'date_ill DESC',
                    ),
                    'date_found' => array(
                        'asc' => 'date_found',
                        'desc' => 'date_found DESC',
                    ),
                    'name' => array(
                        'asc' => 'name',
                        'desc' => 'name DESC',
                    ),
                    'amphur' => array(
                        'asc' => 'amphur',
                        'desc' => 'amphur DESC',
                    ),
                    'disease_control' => array(
                        'asc' => 'disease_control',
                        'desc' => 'disease_control DESC',
                    ),
                    'hospcode' => array(
                        'asc' => 'hospcode',
                        'desc' => 'hospcode DESC',
                    ),
                    'code506' => array(
                        'asc' => 'code506',
                        'desc' => 'code506 DESC',
                    ),
                    'prename' => array(
                        'asc' => 'prename',
                        'desc' => 'prename DESC',
                    ),
                ),
            ),
        ));

// Render
        $this->render('filter', array(
            'filtersForm' => $filtersForm,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionTestDb() {

        $model = new Occupat('search');
        //$model = $model[0];
        echo "<pre>";
        print_r(CJSON::encode($model));
        echo "</pre>";
        echo "<hr>";


        $criteria = new CDbCriteria;
        $criteria->select = 't.name,t.code';
        $model = Occupat::model()->findAll($criteria);
        echo "<pre>";
        print_r(CJSON::encode($model));
        echo "</pre>";
        echo "<hr>";


        $model = new CActiveDataProvider('Occupat', array());
        $model = $model->getData();
        echo "<pre>";
        //print_r($model);
        print_r(json_encode($model));
        echo "</pre>";
    }

}