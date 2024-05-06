
<h1 align="center">
  Library
</h1>

<p align="center">
  This is a simple repository I created to strengthen my knowledge of Hexagonal Architecture, DDD
  CQRS, and Event handling. At the same time, it can serve as a template for Symfony
  projects that want to apply these methodologies.
</p>

## Installation and configuration

### Clone repository

1. Clone this project into a machine with 
Docker installed

       git clone https://github.com/niladalia/library-symfony-ddd.git

2. Move to the project folder: 

        cd library-symfony-ddd

### Environment configuration

1. Create a local .env file 

        cp .env .env.local

### Project setup

1. Install all dependencies :  

        make build-project

2. Run migrations :  
 
        make run-migrations

3. Now you can access http://localhost:83/api/doc to see and try all available api routes.

###  Tests 

1. Execute Phpunit and Behat tests: 

        make run-tests

###  Project explanation

I created this project to have a boilerplate integrating Hexagonal Architecture, DDD, CQRS and
Event Driven arch implementing RabbitMQ.

It represents a simple library that just contains two Aggregates; Books and Authors. You can list, filter, create, 
delete  and update a book and associate it with an Author. Clearly, this is not about the functionality of the project
but about having a small repository to play with all those architectures and practices.

#### Book
In the book context I implemented Hexagonal Architecture with DDD. It also utilizes some asynchronous event-driven 
architecture using RabbitMQ.   

#### Author
In the Author context, I also used DDD but with the addition of CQRS, so I have implemented a synchronous CommandBus 
and QueryBus to handle commands and queries separately. Also, implementing CQRS will help promote cleaner 
code organization  by layers and easier maintenance.
 
### Hexagonal architecture and DDD
As said this project follows Hexagonal architecture as a base for the implementation of the Domain Driven Design. 
So we have our app structured over 3 different layers  Infrastructure, Application and Domain. Placing all the 
external dependencies and entry points in Infrastructure, all the use cases in Application, and the domain entities 
attributes and entities in the Domain layer.
This is the structure of the src folder :

```scala
$ tree -L 4 src

src
├── Authors
│   ├── Application
│   │   ├── Create
│   │   │   ├── AuthorCreator.php
│   │   │   ├── CreateAuthorCommandHandler.php
│   │   │   └── CreateAuthorCommand.php
│   │   ├── Delete
│   │   │   ├── CheckDeleteAuthorOnBookDelete.php
│   │   │   ├── DeleteAuthorCommandHandler.php
│   │   │   ├── DeleteAuthorCommand.php
│   │   │   └── DeleteAuthor.php
│   │   └── Find
│   │       ├── AuthorFinder.php
│   │       ├── AuthorsFinder.php
│   │       ├── FindAuthorQueryHandler.php
│   │       ├── FindAuthorQuery.php
│   │       └── FindAuthorResponse.php
│   ├── Domain
│   │   ├── AuthorNotFound.php
│   │   ├── Author.php
│   │   ├── Authors.php
│   │   ├── BookAssociatedException.php
│   │   └── ValueObject
│   │       ├── AuthorId.php
│   │       └── AuthorName.php
│   └── Infrastructure
│       ├── Controllers
│       │   ├── AuthorGetController.php
│       │   ├── AuthorsDeleteController.php
│       │   ├── AuthorsGetController.php
│       │   └── AuthorsPostController.php
│       └── Persistence
│           ├── Doctrine
│           └── DoctrineAuthorRepository.php
```

### Command and Query bus
In the Author context I did one implementation for Command Bus and another for Query bus, both of them Sync and using 
the Symfony Message Bus

### Event Bus
To send asynchronous Domain Events, I implemented and configured a RabbitMQ broker. I consume and handle those events 
using the Symfony Messenger
