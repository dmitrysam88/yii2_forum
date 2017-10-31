<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Record */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-form">

    <?
    //$itemsUs  = ArrayHelper::map($users,'id','username');
    //$itemsDi  = ArrayHelper::map($dialogs,'id','name');
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?//$model->dialog = $dialogId?>

    <?=$form->field($model, 'dialog')->hiddenInput(['value'=>$dialogId])->label(false)?>

    <?//$model->autor = ''.Yii::$app->getUser()->getId()?>

    <?=$form->field($model, 'autor')->hiddenInput(['value'=>''.Yii::$app->getUser()->getId()])->label(false)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
