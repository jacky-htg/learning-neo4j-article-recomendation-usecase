<?php
require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:1234@localhost:7687')
    ->build();

$con = mysqli_connect("localhost", "jacky", "1234", "articles");

if ($result = mysqli_query($con, "SELECT * FROM users")) {
    while($row = mysqli_fetch_assoc($result)) {
      $query = 'CREATE (:User {id: '.$row['user_id'].', name: "'.$row['name'].'"})';
      $client->run($query);
    }
}

mysqli_close($con);

// set index
$query = 'CREATE INDEX ON :User(id)';
$client->run($query);