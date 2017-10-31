<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->module->user->isGuest || $this->module->user->identity->administrator!==1){
            $this->module->response->redirect(['site/index']);
            return;
        }

        parent::init();

        // custom initialization code goes here
    }
}
