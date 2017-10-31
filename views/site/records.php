<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 10.10.2017
 * Time: 20:31
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<h2><?=$dialog->name?></h2>
<p><?=$dialog->description?></p>

<hr>

<style>
    li {
        list-style-type: none; /* Убираем маркеры */
    }
</style>

<ul>
    <? foreach ($records as $record) {?>
        <li><p><?=$record->text?><br><b><?=$mapUser[$record->autor]?></b>
                <?if(Yii::$app->getUser()->getId()==$record->autor){?>
                    <?=Html::a(Html::img('@web/images/pencil.png',['alt' => 'update']),['site/update_record','id' => $record->id])?>
                    <?=Html::a(Html::img('@web/images/basket.png',['alt' => 'delete']),['site/delete_record','id' => $record->id])?>
                <?}?>
            </p></li>
    <?}?>
</ul>

<br>

<?=Html::a('Добавить',['site/create_record','dialog' => $dialog->id],['class' => 'btn btn-success'])?>

<?=LinkPager::widget(['pagination' => $pages])?>
