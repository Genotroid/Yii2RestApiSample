<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "advert".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $price
 * @property string $contacts
 * @property int $created_at
 * @property int $created_by
 * @property int $status
 *
 * @property Auto[] $autos
 */
class Advert extends \yii\db\ActiveRecord
{
    const STATUS_BLOCKED   = 2;
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ]
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'price', 'contacts'], 'required'],
            [['description'], 'string'],
            [['price', 'created_at', 'created_by', 'status'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 0],
            [['price', 'created_at', 'created_by', 'status'], 'integer'],
            [['title', 'contacts'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Ссылка',
            'title' => 'Название',
            'description' => 'Описание',
            'price' => 'Цена',
            'contacts' => 'Контакты',
            'created_at' => 'Создана',
            'created_by' => 'Пользователь',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Autos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutos()
    {
        return $this->hasOne(Auto::className(), ['advert_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public static function draftAdvertsCount(){
        return Advert::find()->where(['status' => Advert::STATUS_DRAFT])->count();
    }

    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'Черновик',
            self::STATUS_PUBLISHED => 'Опубликовано',
            self::STATUS_BLOCKED => 'Заблокировано'
        ];
    }
}
