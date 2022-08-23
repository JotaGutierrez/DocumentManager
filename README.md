
## Tier 1: 
Next app querying an elastic search node running in a docker instance
## Tier 2: 
App posting to some sql database while elastic syncs through domain events
## Tier 3: 
Use a message queue (rabbitMQ) to sync databases asynchronously

### Set up 

```shell
$ docker compose up
```

Load fixtures (only on first launch or for testing new installations)
```shell
$ curl -s -H "Content-Type: application/x-ndjson" -XPOST localhost:9200/countries/_bulk --data-binary @./fixtures/countries.json
```

Install Search app dependencies
```shell
$ cd ./src/Apps/Search && yarn install
```

Start search client
```shell
$ cd ./src/Apps/Search && yarn dev
```
and open localhost:3000 on your browser
