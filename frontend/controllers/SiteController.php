<?php
namespace frontend\controllers;

use yii\web\Controller;
use post\entities\Slider;
use post\readModels\SliderReadRepository;
/**
 * Site controller
 */
class SiteController extends Controller
{
    private $sliders;

    public function __construct($id, $module, SliderReadRepository $sliders, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->sliders = $sliders;
    }

    /**
     * {@inheritdoc}
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
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'home';
        return $this->render('index');
    }

    public function actionSlider()
    {

    }





}
