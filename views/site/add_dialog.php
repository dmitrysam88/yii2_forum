<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 18.10.2017
 * Time: 23:25
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="record-form">

    <? $form = ActiveForm::begin(); ?>

    <?=$form->field($dialog,'name')->textInput()?>

    <?=$form->field($dialog,'description')->textarea()?>

    <div class="form-group">
        <?=Html::submitButton('Create',['class' => 'btn btn-success'])?>
    </div>

    <? ActiveForm::end(); ?>

</div>