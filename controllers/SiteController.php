<?php

namespace app\controllers;

use app\models\Dialog;
use app\models\Members;
use app\models\MyForm;
use app\models\Record;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
//use app\models\ContactForm;
use yii\data\Pagination;

class SiteController extends Controller
{

    public $pageCount = 10;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */

    public function actionRecords(){

        $id = Yii::$app->request->get('id',1);
        $dialog = Dialog::findOne($id);
        $query = Record::find()->where(['dialog' => $id])->orderBy('id');
        $records = $query->all();
        $idAutors = ArrayHelper::getColumn($records,'autor');
        $idAutors = array_unique($idAutors);
        $users = User::findAll($idAutors);
        $mapUser = ArrayHelper::map($users,'id','username');

        $pages = new Pagination(['totalCount' => $query->count(),'pageSize' => $this->pageCount]);
        $pages->pageSizeParam = false;
        $records = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('records',[
            'dialog'    => $dialog,
            'records'   => $records,
            'mapUser'   => $mapUser,
            'pages'     => $pages,
            ]);
    }

    public function actionDialogs()
    {
        if (Yii::$app->user->isGuest){
            Yii::$app->response->redirect(['site/login']);
        }

        $members = Members::find()->where(['user' => Yii::$app->user->id])->all();

        $arrDi = ArrayHelper::getColumn($members,'dialog');

        $query = Dialog::find($arrDi);

        $pages = new Pagination(['totalCount' => $query->count(),'pageSize' => $this->pageCount]);
        $pages->pageSizeParam = false;
        $dialogs = $query->offset($pages->offset)->limit($pages->limit)->all();

        //$dialogs = Dialog::findAll($arrDi);

        $users = User::find()->all();
        return $this->render('dialogs',
            ['users' => $users,
                'dialogs' => $dialogs,
                'pages' => $pages,
            ]);
    }

    public function actionCreate_record($dialog){

        $record     = new Record();

        if ($record->load(Yii::$app->request->post()) && $record->save()){
            return $this->redirect(['site/records','id' => $record->dialog]);
        } else {
            return $this->render('create_record',[
                'model'    => $record,
                'dialogId'  => $dialog,
            ]);
        }

    }

    public function actionUpdate_record($id){

        $record     = Record::findOne($id);

        if ($record->load(Yii::$app->request->post()) && $record->save()){
            return $this->redirect(['site/records','id' => $record->dialog]);
        } else {
            return $this->render('update_record',[
                'model'     => $record,
                'dialogId'  => $record->dialog,
            ]);
        }

    }

    public function actionDelete_record($id){
        $record     = Record::findOne($id);
        $dialog     = $record->dialog;
        $record->delete();

        return $this->redirect(['site/records','id' => $dialog]);
    }

    public function actionAdd_dialog(){

        $dialog = new Dialog();

        if ($dialog->load(Yii::$app->request->post()) && $dialog->save()){
            $member = new Members();
            $member->dialog = $dialog->id;
            $member->user = Yii::$app->getUser()->getId();
            $member->save();
            return $this->redirect(['site/dialogs']);
        } else {
            return $this->render('add_dialog',[
                'dialog' => $dialog,
            ]);
        }

    }

    public function actionMembers($id){

        $dialog     = Dialog::findOne($id);
        $members    = Members::find()->where(['dialog' => $id])->all();
        $query      = User::find(ArrayHelper::getColumn($members,'user'));
        $pages      = new Pagination(['totalCount' => $query->count(),'pageSize' => $this->pageCount]);
        $pages->pageSizeParam = false;
        $users = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('members',[
            'dialog'    => $dialog,
            'users'     => $users,
            'pages'     => $pages,
        ]);
    }

    public function actionAdd_member($dialogId){

        $member = new Members();
        $members = Members::find()->where(['dialog' => $dialogId])->all();
        $itemsMe = ArrayHelper::getColumn($members,'user');
        $users = User::find()->where(['NOT IN','id',$itemsMe])->all();
        $itemsUs = ArrayHelper::map($users,'id','username');

        if ($member->load(Yii::$app->request->post()) && $member->save()){
            return $this->redirect(['site/members', 'id' => $dialogId]);
        } else {
            return $this->render('add_member',[
                'member' => $member,
                'dialogId' => $dialogId,
                'itemsUs' => $itemsUs,
            ]);
        }
    }

    public function actionMy_page(){

        $query = Record::find();

        $pages = new Pagination(['totalCount' => $query->count(),'pageSize'=>$this->pageCount]);

        $pages->pageSizeParam = false;

        $records = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('my_page',[
            'records'   => $records,
            'pages'     => $pages,
        ]);

    }

}
