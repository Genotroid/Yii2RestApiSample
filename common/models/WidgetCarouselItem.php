<?php

namespace common\models;

use common\behaviors\CacheInvalidateBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "widget_carousel_item".
 *
 * @property integer $id
 * @property integer $carousel_id
 * @property string $base_url
 * @property string $path
 * @property string $asset_url
 * @property string $type
 * @property string $image
 * @property string $url
 * @property string $caption
 * @property integer $status
 * @property integer $order
 *
 * @property WidgetCarousel $carousel
 * @property string $assetUrl
 */
class WidgetCarouselItem extends ActiveRecord
{
    /**
     * @var array|null
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_carousel_item}}';
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $key = array_search('carousel_id', $scenarios[self::SCENARIO_DEFAULT], true);
        $scenarios[self::SCENARIO_DEFAULT][$key] = '!carousel_id';
        return $scenarios;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => UploadBehavior::class,
                'attribute' => 'image',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'typeAttribute' => 'type'
            ],
            'cacheInvalidate' => [
                'class' => CacheInvalidateBehavior::class,
                'cacheComponent' => 'frontendCache',
                'keys' => [
                    function ($model) {
                        return [
                            WidgetCarousel::class,
                            $model->carousel->key
                        ];
                    }
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carousel_id'], 'required'],
            [['carousel_id', 'status', 'order'], 'integer'],
            [['url', 'caption', 'base_url', 'path'], 'string', 'max' => 1024],
            [['type'], 'string', 'max' => 255],
            ['image', 'required', 'when' => function($model) { return $model->getIsNewRecord(); }],
            ['image', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carousel_id' => 'ID карусели',
            'image' => 'Изображение',
            'base_url' => 'Базовый URL',
            'path' => 'Путь',
            'type' => 'Тип файла',
            'url' => 'Url',
            'caption' => 'Текст',
            'status' => 'Активно',
            'order' => 'Порядок'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(WidgetCarousel::class, ['id' => 'carousel_id']);
    }
}
