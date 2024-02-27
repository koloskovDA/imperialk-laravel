<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 23.02.15
 * Time: 0:54
 */

namespace app\components;


use yii\web\Controller;

class AdminController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = '@app/modules/admin/views/layouts/main.php';
    }

} 