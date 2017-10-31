<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="members-form">

    <?
    $itemsUs  = ArrayHelper::map($users,'id','username');
    $itemsDi  = ArrayHelper::map($dialogs,'id','name');
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'dialog')->textInput() ?>

    <?= $form->field($model,'dialog')->dropDownList($itemsDi) ?>

    <?//= $form->field($model, 'user')->textInput() ?>

    <?= $form->field($model,'user')->dropDownList($itemsUs)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
