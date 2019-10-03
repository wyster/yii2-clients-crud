<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 * @property string $phone
 * @property int $vat
 * @property int $city
 * @property string $description
 * @property int $logo_id
 * @property int $status
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
            [['name', 'phone', 'city', 'description', 'logo_id'], 'required'],
            [['vat', 'city', 'logo_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'phone' => 'Phone',
            'vat' => 'Vat',
            'city' => 'City',
            'description' => 'Description',
            'logo_id' => 'Logo ID',
            'status' => 'Status',
        ];
    }

    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $currentDateAndTime = -(new \DateTime())->format('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->created_at = $currentDateAndTime;
        }
        $this->updated_at = $currentDateAndTime;

        return true;
    }
}
