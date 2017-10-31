<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 15.10.2017
 * Time: 14:56
 */
use yii\helpers\Html;

$this->title = 'Create Record';

?>

<div class="record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_record_form', [
        'model'     => $model,
        'dialogId'  => $dialogId,
    ]) ?>

</div>


