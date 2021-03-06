<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile as UploadedFile;

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
 * @property Logo $logo
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $logo_file;

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
            [['name', 'phone', 'city_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['vat', 'city_id', 'logo_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['phone'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['logo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Logo::className(), 'targetAttribute' => ['logo_id' => 'id']],
            [['logo_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['phone'], \kartik\validators\PhoneValidator::class, 'countryValue' => 'RU']
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
            'logo_file' => Yii::t('app', 'Logo'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getLogo()
    {
        return $this->hasOne(Logo::className(), ['id' => 'logo_id']);
    }

    /**
     * {@inheritdoc}
     * @return ClientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientQuery(get_called_class());
    }

    public function beforeValidate(): bool
    {
        if ($this->phone) {
            $this->phone = $this->preparePhone($this->phone);
        }
        return parent::beforeValidate();
    }

    public function afterDelete(): bool
    {
        parent::afterDelete();

        if ($this->logo instanceof Logo) {
            $this->logo->delete();
        }

        return true;
    }

    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->uploadLogo(UploadedFile::getInstance($this, 'logo_file'));

        $this->phone = $this->preparePhone($this->phone);
        $currentDateAndTime = (new \DateTime())->format('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->created_at = $currentDateAndTime;
        }
        $this->updated_at = $currentDateAndTime;

        return true;
    }

    public function uploadLogo(?UploadedFile $file): void
    {
        if (!$file instanceof UploadedFile) {
            return;
        }

        $logo = (new Logo())->uploadNewLogo($file);
        $this->logo_id = $logo->id;
    }

    /**
     * @param string $phone
     * @return string
     */
    private function preparePhone(string $phone): string
    {
        return preg_replace('/\D/', '', $phone);
    }

    public function deleteLogo(): bool
    {
        if ($this->logo instanceof Logo) {
            $logo = $this->logo;
            $this->logo_id = null;
            $this->update();
            $logo->delete();
        }

        return true;
    }
}
