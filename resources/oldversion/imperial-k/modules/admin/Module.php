<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $mainLayout = 'app/modules/admin/views/layouts/main.php';

    public function init()
    {
        parent::init();
        $this->layout = '@app/modules/admin/views/layouts/main.php';
    }
}
