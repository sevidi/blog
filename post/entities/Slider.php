<?php


namespace post\entities;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property int $id
 * @property string $photo
 * @property string $alt
 * @property string $description
 *
 * * @mixin ImageUploadBehavior
 */

class Slider extends ActiveRecord
{



    public static function create($alt, $description):self
    {
        $slider = new static();
        $slider->alt = $alt;
        $slider->description = $description;
        return $slider;
    }

    public function setPhoto(UploadedFile $photo):void
    {
        $this->photo = $photo;
    }

    public function edit($alt, $description):void
    {
        $this->alt = $alt;
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    public function rules():array
    {
        return [
            [['alt', 'description'], 'string', 'max' => 255],
            [['photo'],'image'],
        ];
    }

    public function behaviors(): array
    {
        return [

            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/slider/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/slider/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/slider/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/slider/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'slider' => ['width' => 1980, 'height' => 478],
                    'photo' => ['width' => 70, 'height' => 70],
                ],
            ],
        ];
    }

}