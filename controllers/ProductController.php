<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */

//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
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
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /* Заводим пользователей в базу  */

  public function actionRole()
   {
               //1 Настройка Role и Permission
//        $admin = Yii::$app->authManager->createRole('admin');
//        $admin->description = 'Администратор';
//        Yii::$app->authManager->add($admin);
//
//        $manager = Yii::$app->authManager->createRole('manager');
//        $manager->description = 'Контент-менеджер';
//        Yii::$app->authManager->add($manager);
//
//        $user = Yii::$app->authManager->createRole('user');
//        $user->description = 'Пользователь';
//        Yii::$app->authManager->add($user);
//
//        $ban = Yii::$app->authManager->createRole('ban');
//        $ban->description = 'Тварь';
//        Yii::$app->authManager->add($ban);
//
//        return 12345;
//                    //2
//              -----------------
//      $permit = Yii::$app->authManager->createPermission('canAdmin');
//      $permit->description = 'Право входа в админку';
//      Yii::$app->authManager->add($permit);
//               ----------------
//                     //3 Наследования ролей и прав
//     // $role_a = Yii::$app->authManager->getRole('admin');
//      $role_c = Yii::$app->authManager->getRole('manager');
//      $permit = Yii::$app->authManager->getPermission('canAdmin');
//     // Yii::$app->authManager->addChild($role_a, $permit);
//      Yii::$app->authManager->addChild($role_c, $permit);

      //4 Привязка ролей к пользователю
//      $userRole = Yii::$app->authManager->getRole('admin');
//      Yii::$app->authManager->assign($userRole, 1);



      return 12345;
    }

    /* Заводим пользователей в базу  */

}
