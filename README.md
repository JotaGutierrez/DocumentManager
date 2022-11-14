# Document Manager
Document management and search app. This is an example monorepo of an application consisting on

* Backend API
* Backoffice UI
* Front UI
* Elasticsearch
* MySQL
* RabbitMQ

The purpose of this project is to create a simple application using a real world arquitecture that could be used in a complex application, testable, easy to extend and ready to scale.

Backend application follows Domain-Driven Design (DDD) principles, Hexagonal arquitecture and CQRS. It saves documents in MySQL and sends them asynchronously to ElasticSearch via RabbitMQ.

Backoffice uses backend api to create and edit documents.
Front UI queries ElasticSearch directly.

### Set up 

```shell
$ docker compose up
```

Go to localhost:3001 and create some documents

At this point, they exist only in MySQL 

Run
```shell
$ make consume
```
to sync ElasticSearch and

Go to localhost:3000 and search documents

### Next steps
* Author management
* Wysiwyg content editor
* Refactor API use in UIs
* Add document tags to filter documents
* User roles (Admin, Editor)
* Backoffice authentication
* ...
