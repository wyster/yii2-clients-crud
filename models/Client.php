<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $phone
 * @property int $vat
 * @property int $city_id
 * @property string $description
 * @property int $logo_id
 *
 * @property City $city
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'city_id', 'description', 'logo_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['vat', 'city_id', 'logo_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 11],
            [['phone'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'vat' => Yii::t('app', 'Vat'),
            'city_id' => Yii::t('app', 'City ID'),
            'description' => Yii::t('app', 'Description'),
            'logo_id' => Yii::t('app', 'Logo ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * {@inheritdoc}
     * @return ClientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientQuery(get_called_class());
    }

    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $currentDateAndTime = (new \DateTime())->format('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->created_at = $currentDateAndTime;
        }
        $this->updated_at = $currentDateAndTime;

        return true;
    }
}
