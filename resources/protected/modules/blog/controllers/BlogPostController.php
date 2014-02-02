<?php

class BlogPostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
    public function filters() {
        return array(
            'rights'
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BlogPost;
        $term=new BlogTermRelationships;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['BlogPost']))
		{
			$model->attributes=$_POST['BlogPost'];
            //$term->attributes=$_POST['BlogTermRelationships'];

            if (empty($model->slug)) {
                $model->post_name  = $model->post_title;
            }
            $model->post_date = date("Y-m-d H:i:s");
            $model->post_modified = date("Y-m-d H:i:s");
            //$term->post_id = $model->id;
            //$term->term_id = implode(',', $term->term_id);
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
            'term'=>$term,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $term=new BlogTermRelationships;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['BlogPost']))
		{
			$model->attributes=$_POST['BlogPost'];
            //$term->attributes=$_POST['BlogTermRelationships'];

            if (empty($model->slug)) {
                $model->post_name  = $model->post_title;
            }
            $model->post_modified = date("Y-m-d H:i:s");
            //$term->term_id = implode(',', $term->term_id);

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        //$term->term_id = explode(',', $term->term_id);
		$this->render('update',array(
			'model'=>$model,
            'term'=>$term,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BlogPost');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BlogPost('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BlogPost']))
			$model->attributes=$_GET['BlogPost'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BlogPost the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BlogPost::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BlogPost $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}