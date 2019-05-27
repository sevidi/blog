<?php


namespace frontend\widgets;

use post\readModels\SliderReadRepository;
use yii\base\Widget;


class SlidersWidget extends Widget
{
    public $limit;

    private $repository;

    public function __construct(SliderReadRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public  function run():string
    {
        return $this->render('sliders', [
            'sliders' => $this->repository->getSlider($this->limit)
        ]);
    }


}