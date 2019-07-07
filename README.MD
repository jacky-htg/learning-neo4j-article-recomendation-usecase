[PREPARATION]
- CREATE DATABASE articles;
- mysql -uroot -p articles < articles.sql
  
[MIGRASI : from MySql to neo4J with php script]
- start articles graph database 
- composer install
- php bulking_articles.php
- php bulking_users.php
- php bulking_reads.php

[OPTIONAL : Explore Chyper Query Language]
- MATCH (m) RETURN m
- MATCH (u:User)--(a:Article) RETURN u,a
- MATCH (u:User {id: 1})--(a:Article) RETURN u, a
- MATCH (u:User {id: 1})-->(a:Article) RETURN u, a
- MATCH (u:User {id: 1})-[:Read]-(a:Article) RETURN u, a
- MATCH (u:User {id: 1})-[:Read]->(a:Article) RETURN u, a
- MATCH (u:User)-[r:Read]->(a:Article) RETURN u.name, count(a) ORDER BY count(a) DESC
- MATCH (u:User {id: 1})-[r:Read]->(a:Article) RETURN u, a, COUNT(r) ORDER BY COUNT(r) DESC
- MATCH (a:Article)<--(u:User) RETURN a, u
- MATCH (a:Article {id:1})<--(u:User) RETURN a, u
- MATCH (:Article {id:1})<-[:Read]-(u:User)-[r:Read]->(a:Article) WHERE u.id<>1 AND NOT (a)<-[:Read]-(:User {id: 1}) RETURN DISTINCT a, COUNT(r) ORDER BY COUNT(r) DESC, a.publish_date DESC

[ARTICLE RECOMENDATION]
- php recomendation.php
