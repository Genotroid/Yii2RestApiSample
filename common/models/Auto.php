<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auto".
 *
 * @property int $id
 * @property int $advert_id
 * @property string $brand
 * @property string $model
 * @property int $year
 * @property int $body_type
 * @property int $mileage
 *
 * @property Advert $advert
 * @property Options[] $options
 */
class Auto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['advert_id', 'brand', 'model', 'year', 'body_type', 'mileage'], 'required'],
            [['advert_id', 'year', 'body_type', 'mileage'], 'default', 'value' => null],
            [['advert_id', 'year', 'body_type', 'mileage'], 'integer'],
            [['brand', 'model'], 'string', 'max' => 255],
            [['advert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Advert::className(), 'targetAttribute' => ['advert_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'advert_id' => 'Advert ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'year' => 'Year',
            'body_type' => 'Body Type',
            'mileage' => 'Mileage',
        ];
    }

    /**
     * Gets query for [[Advert]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advert_id']);
    }

    /**
     * Gets query for [[Options]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['auto_id' => 'id']);
    }
}
