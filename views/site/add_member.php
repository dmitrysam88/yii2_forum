<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 19.10.2017
 * Time: 21:43
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="active-form">

    <? $form = ActiveForm::begin(); ?>

    <?=$form->field($member,'user')->dropDownList($itemsUs)?>

    <?=$form->field($member,'dialog')->hiddenInput(['value'=>$dialogId])->label(false)?>

    <div class="form-group">
        <?=Html::submitButton('Create',['class' => 'btn btn-success'])?>
    </div>

    <? ActiveForm::end(); ?>

</div>
