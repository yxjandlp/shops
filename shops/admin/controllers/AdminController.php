<?php

class AdminController extends BaseController {

    public $layout="//layouts/frame";

    /**
     * the frame of admin
     */
	public function actionIndex() {
        $this->pageTitle = Yii::app()->name . ' | admin';

		$this->render('index' , array(

        ) );
	}

    /**
     * the left navigation of admin frame
     */
    public function actionHead() {
        $this->pageTitle = Yii::app()->name . ' | admin';

        $this->render('head' , array(

        ));
    }

    /**
     * the left navigation of admin frame
     */
    public function actionLeft() {
        $this->pageTitle = Yii::app()->name . ' | admin';

        $this->render('left' , array(

        ));
    }

    /**
     * the home page of admin
     */
	public function actionHome() {
        $this->pageTitle = Yii::app()->name . ' | admin';

        $this->render('home' , array(

        ));
    }
}