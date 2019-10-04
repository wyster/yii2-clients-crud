<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Client'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            'name',
            'phone',
            [
                'attribute' => 'vat',
                'value' => function (\app\models\Client $model) {
                    return $model->vat ? 'Да' : 'Нет';
                },
                'filter' => Select2::widget([
                    'data' => [0 => 'Нет', 1 => 'Да'],
                    'model' => $searchModel,
                    'attribute' => 'vat',
                    'hideSearch' => true
                ])
            ],
            [
                'attribute' => 'city_id',
                'label' => Yii::t('app', 'City'),
                'value' => function (\app\models\Client $model) {
                    return $model->city->getNameWithRegion();
                },
                'filter' => Select2::widget([
                    'data' => $searchFilterCities,
                    'model' => $searchModel,
                    'attribute' => 'city_id',
                    'options' => ['placeholder' => Yii::t('app', 'Search for a city...')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 1,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                        ],
                        'ajax' => [
                            'url' => \yii\helpers\Url::to(['city-list']),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ]
                    ],

                ]),
            ],
            'description:ntext',
            [
                'attribute' => 'logo.src',
                'label' => Yii::t('app', 'Logo'),
                'format' => ['image', ['style' => 'max-height:100px']],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
