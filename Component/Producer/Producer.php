<?php
/**
 * Created by PhpStorm.
 * User: ning
 * Date: 2017/5/30
 * Time: 23:42
 */

namespace MentionKafka\Component\Producer;

use MentionKafka\Component\Broker\Broker;
use MentionKafka\Component\Topic\TopicConfig\TopicConfig;

class Producer
{
    public function __construct()
    {

    }

    public function getTopic($nameTopic, TopicConfig $topicConfig = NULL): Topic
    {

    }

    public function addBroker(Broker $broker)
    {

    }
}