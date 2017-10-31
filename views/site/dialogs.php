<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 04.10.2017
 * Time: 23:29
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

?>

<br>

<ul>
    <? foreach ($dialogs as $dialog) { ?>
        <li><b><a href="<?=Yii::$app->urlManager->createUrl(['site/records','id' => $dialog->id])?>"><?=$dialog->name?></a></b><br><p><?=$dialog->description?>  &nbsp
                <?=Html::a(Html::img('@web/images/users.png',['alt' => 'users']),['site/members','id' => $dialog->id])?>
            </p></li>
    <? } ?>
</ul>

<br>

<?=Html::a('Добавить',['site/add_dialog'],['class' => 'btn btn-success'])?>

<?=LinkPager::widget(['pagination' => $pages])?>
