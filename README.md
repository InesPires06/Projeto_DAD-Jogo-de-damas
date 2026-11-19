# DAD-Project-Tutorials

Tutorials and example code for the project of the DAD course at IPLeiria (ESTG). The goal is to help students connect to the course Kubernetes cluster and deploy their project to it, which is what the intermediate submission checks.

## Repository contents

- [`docs/`](docs): the tutorials website, built with [VitePress](https://vitepress.dev/)
- [`code/`](code): the example code, a working project we can use as a base and deploy to the cluster
- [`rest_collections/`](rest_collections): Bruno and Postman collections to test the API

## Example code

The [`code/`](code) folder has everything needed for the intermediate submission:

- [`code/api`](code/api): Laravel 13 API (PHP 8.5) with token authentication
- [`code/frontend`](code/frontend): Vue application with pages to test the API and the WebSockets server
- [`code/websockets`](code/websockets): Node / Socket.IO server with a simple chat
- [`code/deployment`](code/deployment): Dockerfiles and Kubernetes resources
- [`code/justfile`](code/justfile): the build and deploy commands

See the [deploy tutorial](docs/deploy.md) for how to deploy it, and the [tools tutorial](docs/tools.md) for the tools we need and how to run it locally.


