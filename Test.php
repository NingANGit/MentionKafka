<?php
/**
 * Created by PhpStorm.
 * User: ning
 * Date: 2017/5/30
 * Time: 22:24
 */

use MentionKafka\Component\Broker;
use MentionKafka\Component\Consumer;
use MentionKafka\Component\Producer;
use MentionKafka\Component\Topic\TopicConfig;
use MentionKafka\Component\Message;


/**
 * Besoin : L'utilisateur peut définir quels topics il veut consommer (et dans chaque topic, quelles partitions).
 */

// instancier le consommateur
$consumer = new Consumer\Consumer();
// ajouter un broker au consommateur
$consumer->addBroker(new Broker\Broker());
// informer le consommateur le topic qui veut
$topic = $consumer->getTopic('Twitter_mot_cle_toto');
// consommer le topic à partir de début de la patition 1
$topic->consume('patition_1');


/**
 * Besoin : L'utilisateur peut définir quel offset de départ utiliser (offset sauvegardé ou fin du topic).
 */
// si le consommateur veut mettre offset à la fin du topic
$topic->consume('patition_1', $topic::OFFSET_END);

// si le consommateur veut mettre offset à un offset donné / sauvegardé
// on spécifie la config du topic afin de désactiver auto committing offsets
$topicConfig = new TopicConfig\TopicConfig();
$topicConfig->set('auto.commit.enable', 'false');
// créer topic en passant une config
$topic = $consumer->getTopic('Twitter_mot_cle_toto', $topicConfig);
// on consomme
$message = $topic->consume('patition1', 100);
// Je traite ici le message !!!
// on met à jour offset
$topic->offsetStore($message->partition, $message->offset);

/**
 * Besoin : L'utilisateur peut définir un callback pour chaque topic. Le callback est appelé quand le topic reçoit un nouveau message.
 */
// on instancie un producer
$producer = new Producer\Producer();
// on relie un/des broker au producer
$producer->addBroker(new Broker\Broker());
// on définit le type de ressources à pusher
$topic = $producer->getTopic('Twitter_mot_cle_toto');
// on définit la fonction callback
$topic->setCallBack('Fonction_call_back');
// on push
$topic->produce('patition1', 0, new Message\Message());


/**
 * Besoin : L'utilisateur peut définir comment réagir lorsque la consommation d'un message échoue. Certains consumers veullent ignorer, d'autres veulent lancer une exception. On veut aussi définir dans quels cas on sauvegarde l'offset.
 */
// instancier le consommateur
$consumer = new Consumer\Consumer();
// ajouter un broker au consommateur
$consumer->addBroker(new Broker\Broker());
// informer le consommateur le topic qui veut
$topic = $consumer->getTopic('Twitter_mot_cle_toto');
// consommer le topic à partir de début de la patition 1
$message = $topic->consume('patition_1');
if($message->status == 'KO') {
    //...
}
?>
