<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'name',
            'phone',
            [
                'attribute' => 'var',
                'value' => function(\app\models\Client $model) {
                    return $model->vat ? 'Да' : 'Нет';
                }
            ],
            [
                'attribute' => 'city.NameWithRegion',
                'label' => Yii::t('app','City'),
            ],
            'description:ntext',
            [
                'attribute' => 'logo.src',
                'label' => Yii::t('app','Logo'),
                'format' => ['image', ['style' => 'max-height:100px']],
            ],
        ],
    ]) ?>

</div>
