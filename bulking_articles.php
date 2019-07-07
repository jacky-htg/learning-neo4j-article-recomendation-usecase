<?php
require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:1234@localhost:7687')
    ->build();

$con = mysqli_connect("localhost", "jacky", "1234", "articles");

if ($result = mysqli_query($con, "SELECT * FROM articles")) {
    while($row = mysqli_fetch_assoc($result)) {
      $query = 'CREATE (:Article {id: '.$row['article_id'].', title: "'.$row['title'].'", slug: "'.$row['slug'].'", publish_date: "'.$row['publish_date'].'"})';
      $client->run($query);
    }
}

mysqli_close($con);

// set index
$query = 'CREATE INDEX ON :Article(id)';
$client->run($query);