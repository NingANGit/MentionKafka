<?php

/**
 * Created by PhpStorm.
 * User: ning
 * Date: 2017/5/29
 * Time: 23:35
 */

namespace MentionKafka\Component\Topic;

use MentionKafka\Component\Message\Message;
use MentionKafka\Component\Topic\CallBack;


class Topic
{

    const OFFSET_BEGINNING = '';
    const OFFSET_END = '';

    private $nameCallBackFunction;
    private $errorLevel;


    public function __construct()
    {

    }

    public function setErrorLevel($errorLevel)
    {
        $this->errorLevel = $errorLevel;
    }

    public function consume($partition, $offset = NULL): Message
    {
        // si consume KO
        switch ($this->errorLevel) {
            case 0 :
                throw new \KafkaException();
                break;
            case 1 :
                return new Message(); // avec $offset actuel
                break;
            default :
                // TODO


        }
    }

    public function produce(Message $message, $partition, $offset = NULL)
    {
        // do something
        // if done & OK
        call_user_func(array(new CallBack\CallBack(), $this->nameCallBackFunction));
    }

    public function offsetStore($partition, $offset)
    {

    }

    public function setCallBack($nameCallBackFunction)
    {
        $this->nameCallBackFunction = $nameCallBackFunction;
    }
}