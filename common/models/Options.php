<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property int $auto_id
 * @property int|null $air_conditioning
 * @property int|null $airbags
 * @property int|null $multimedia
 * @property int|null $cruise_control
 *
 * @property Auto $auto
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auto_id'], 'required'],
            [['auto_id', 'air_conditioning', 'airbags', 'multimedia', 'cruise_control'], 'default', 'value' => null],
            [['auto_id', 'air_conditioning', 'airbags', 'multimedia', 'cruise_control'], 'integer'],
            [['auto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Auto::className(), 'targetAttribute' => ['auto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auto_id' => 'Auto ID',
            'air_conditioning' => 'Air Conditioning',
            'airbags' => 'Airbags',
            'multimedia' => 'Multimedia',
            'cruise_control' => 'Cruise Control',
        ];
    }

    /**
     * Gets query for [[Auto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuto()
    {
        return $this->hasOne(Auto::className(), ['id' => 'auto_id']);
    }
}
