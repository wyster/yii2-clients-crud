<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

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
    private const UPLOAD_DIR = 'uploads';

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
        return '/' . self::UPLOAD_DIR  .'/' . $this->name;
    }

    public function beforeDelete(): bool
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $filePath = self::UPLOAD_DIR . DIRECTORY_SEPARATOR . $this->name;
        if (file_exists($filePath)) {
            \yii\helpers\FileHelper::unlink($filePath);
        }

        return true;
    }

    /**
     * @param UploadedFile $file
     * @return Logo
     * @throws \Exception
     */
    public function uploadNewLogo(UploadedFile $file): Logo
    {
        \yii\helpers\FileHelper::createDirectory(self::UPLOAD_DIR);
        $fileName = md5($file->baseName) . '.' . $file->extension;
        move_uploaded_file(
            $file->tempName,
            self::UPLOAD_DIR . DIRECTORY_SEPARATOR .  $fileName
        );

        $logo = new Logo();
        $logo->name = $fileName;
        $logo->size = $file->size;
        $logo->created_at = (new \DateTime())->format('Y-m-d H:i:s');
        $logo->save();

        return $logo;
    }
}
