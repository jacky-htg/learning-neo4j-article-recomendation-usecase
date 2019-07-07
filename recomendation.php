<?php

require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:1234@localhost:7687')
    ->build();

$articleID = 1;
$userID = 1;

// if userID 1 was reading articleID 1, so here article recomendations
$query = "MATCH (:Article {id:$articleID})<-[:Read]-(u:User)-[r:Read]->(a:Article)
          WHERE u.id<>$userID AND NOT (a)<-[:Read]-(:User {id: $userID})
          RETURN DISTINCT a, COUNT(r) as strength
          ORDER BY COUNT(r) DESC, a.publish_date DESC";
$result = $client->run($query);

foreach ($result->getRecords() as $record) {
    print_r([
        'article' => $record->value("a"),
        'strength' => $record->value("strength")
    ]); 
    echo "\n";
}