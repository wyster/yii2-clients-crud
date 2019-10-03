<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logo".
 *
 * @property int $id
 * @property string $name
 * @property double $size
 * @property string $created_at
 */
class Logo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'size', 'created_at'], 'required'],
            [['size'], 'number'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'size' => Yii::t('app', 'Size'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LogoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogoQuery(get_called_class());
    }

    public function getSrc(): string
    {
        return '/uploads/' . $this->name;
    }
}
