<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'enableClientValidation' => true]); ?>

    <?= $form->field($model, 'created_at')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '+[7] (999) 999 99 99',
    ]) ?>

    <?= $form->field($model, 'vat')->checkbox() ?>

    <?php
    echo $form->field($model, 'city_id')->label(Yii::t('app', 'City'))->widget(Select2::class, [
        'initValueText' => $model->city instanceof \app\models\City ? $model->city->getNameWithRegion() : '',
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
    ]);
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'logo_file')->fileInput() ?>

    <?php if ($model->logo instanceof \app\models\Logo): ?>
    <div class="form-group ">
        <label class="control-label btn-block"><?=Yii::t('app', 'Current logo');?></label>
        <a href="<?=$model->logo->getSrc();?>" target="_blank" title="Открыть оригинал">
            <img src="<?=$model->logo->getSrc();?>" style="max-height: 200px"/>
        </a>
        <br />
        <a href="/client/delete-logo/?id=<?=$model->id;?>">Удалить</a>
    </div>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
