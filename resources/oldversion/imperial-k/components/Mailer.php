<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 07.03.15
 * Time: 23:38
 */

namespace app\components;


use yii\base\Component;
use yii\base\Event;

class MessageEvent extends Event
{
    public $message;
}

class Mailer extends Component
{
    const EVENT_MESSAGE_SENT = 'messageSent';

    public function send($message)
    {

    }

} 