<?php
require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:1234@localhost:7687')
    ->build();

$con = mysqli_connect("localhost", "jacky", "1234", "articles");

if ($result = mysqli_query($con, "SELECT * FROM article_reads")) {
    while($row = mysqli_fetch_assoc($result)) {
      $query = 'MATCH (u:User {id: '.$row['user_id'].'}), (a:Article {id: '.$row['article_id'].'}) CREATE (u)-[:Read {date: "'.$row['date'].'"}]->(a)';
      $client->run($query);
    }
}

mysqli_close($con);

