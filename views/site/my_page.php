<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 20.10.2017
 * Time: 22:59
 */

use yii\widgets\LinkPager;

?>

<ul>
    <?foreach ($records as $record){?>
        <li><?=$record->text?></li>
    <?}?>
</ul>

<?=LinkPager::widget(['pagination' => $pages]);?>