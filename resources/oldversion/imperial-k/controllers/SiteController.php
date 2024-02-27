<?php

namespace app\controllers;

use app\components\ArrayHelper;
use app\components\Controller;
use app\models\NicknameHistory;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\modules\auctions\models\Lookup;
use app\modules\auctions\models\Lots;
use app\modules\auctions\models\ProfileLots;
use app\modules\auctions\models\Settings;
use app\modules\pages\models\Page;
use app\modules\shop\models\Product;
use Yii;
use yii\base\InvalidParamException;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\web\Response;
use yii\db\Expression;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    //   'logout' => ['post'],
                ],
            ],
        ];
    }

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


    public function actionIndex()
    {
        $this->layout = '@app/views/layouts/mainDefault.php';
        $lotsMain = Lookup::find()->select('value')->where(['type' => 'lots'])->asArray()->all();
        $lotsMainIds = ArrayHelper::getColumn($lotsMain, 'value');
        $lastLots = Lots::find()->where(['id' => $lotsMainIds])->orderBy('id DESC')->limit(8)->all();

        $productMain = Lookup::find()->select('value')->where(['type' => 'product'])->asArray()->all();
        $productMainIds = ArrayHelper::getColumn($productMain, 'value');
        $lastProducts = Product::find()->where(['id' => $productMainIds])->orderBy('id DESC')->limit(3)->all();

        return $this->render('index', [
            'lastLots' => $lastLots,
            'lastProducts' => $lastProducts,
        ]);
    }


    public function actionRule()
    {
        $page = Page::findOne(['url' => '/rule']);
        return $this->render('rule', [
            'page' => $page,
        ]);
    }

    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            if (Yii::$app->getUser()->getReturnUrl() == '/site/login') {
                return $this->goHome();
            }
            return $this->goBack();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->getUser()->getReturnUrl() == '/site/login') {
                return $this->goHome();
            }

            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        if (Yii::$app->request->referrer) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->goHome();
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();
//        if ($errors = $this->performAjax($model)) {
//            return $errors;
//        }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('registerSuccess');
                return $this->refresh();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Мы отправии вам письмо с инструкциями. Проверьте ваш email.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }


    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Новый пароль сохранен');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);

    }

    public function actionContact()
    {
        $model = new ContactForm();
        $settings = Settings::findOne(1);
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'settings' => $settings,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest()
    {
        $nhistory = NicknameHistory::find()->all();

        foreach ($nhistory as $nh) {
//            $user = User::findOne($nh->user_id);
//            $nh->start_time = $user->created_at;
//            $nh->save();
//            unset($user);
//            print $nh->user_id.'<br />';
        }


    }


    protected function performAjax($model)
    {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->charset = 'UTF-8';
            return ActiveForm::validate($model);
        }
    }
}
