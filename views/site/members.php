<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 17.10.2017
 * Time: 22:50
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

<p>Members of dialog:</p>

<ul>

    <? foreach ($users as $user){?>
        <li><p><?=$user->username?></p></li>
    <?}?>

</ul>

<?=Html::a('Добавить',['site/add_member','dialogId' => $dialog->id],['class' => 'btn btn-success'])?>

<?=LinkPager::widget(['pagination' => $pages])?>