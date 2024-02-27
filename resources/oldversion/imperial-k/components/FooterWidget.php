<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 29.03.15
 * Time: 23:13
 */

namespace app\components;


use yii\base\Widget;

class FooterWidget extends Widget
{
    public $type = 1;

    public function run()
    {

        return $this->render('footerWidget',['type'=>$this->type]);
    }

} 