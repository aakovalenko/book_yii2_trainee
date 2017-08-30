<?php

namespace app\modules\post\controllers;

use Yii;
use app\modules\post\models\Post;
use app\modules\post\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'creation_date',
                'updatedAtAttribute' => 'modified_date'
            ]
        ];
    }

    public function actionPush()
    {
        return '<h1>123 turtles</h1>';
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }

/* 30 post
    public function actionFff()
    {
        for ($i=0; $i<30; $i++) {

            $model = new Post();
            $model->title = 'Zagolovok # '.$i;
            $model->text = 'Some text';
            $model->sort = 50;
            $model->status_id = 1;
            $model->url = 'url_'.$i;
            $model->save();
        }
        return 12345;
    }
*/

    public function actionAll()
    {
        $posts = Post::find()->with('author')->andWhere(['status_id' => 1])->orderBy('sort')->all();//with жадная загрузка
        return $this->render('all',['posts' => $posts]);
    }


    public function actionOne($url)
    {
        if ($post = Post::find()->andWhere(['url' => $url])->one() ){
            return $this->render('one',['post' => $post]);
    }
        throw new NotFoundHttpException('Нет такого поста!');

    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->sort = 50;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::find()->with('tags')->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
