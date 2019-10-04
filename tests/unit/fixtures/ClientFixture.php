<?php declare(strict_types=1);

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class ClientFixture extends ActiveFixture
{
    public $modelClass = \app\models\Client::class;
}