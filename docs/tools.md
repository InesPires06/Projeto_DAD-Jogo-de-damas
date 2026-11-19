# Tools

These are the tools we will need to deploy our project to production:

- `kubectl`: the [Kubernetes CLI](https://kubernetes.io/docs/tasks/tools/#kubectl) we need to define our project state and run commands against the cluster.
- `docker`: the [container management tool](https://www.docker.com/products/docker-desktop/) that we will use to create the container images (locally) and push them to the container registry

There are some other tools we might find useful, but are not mandatory, such as:

- [Lens](https://lenshq.io/products/lens-k8s-ide/): the UI tool to connect to our Kubernetes cluster. This can do most of the tasks we will do with `kubectl` but in a UI application
- [just](https://github.com/casey/just): a simpler Makefile, used to run commands and in our case has the added benefit of documenting the commands in our repository

Our cluster runs Kubernetes 1.36, and `kubectl` must be within one minor version of the cluster, so we need `kubectl` 1.35, 1.36 or 1.37.

## Installation - Windows

For `kubectl` follow the instructions in the [official documentation page](https://kubernetes.io/docs/tasks/tools/install-kubectl-windows/). The simplest way is to use `winget`, or [Chocolatey](https://chocolatey.org/) if we already have it:

```powershell
winget install -e --id Kubernetes.kubectl

# or
choco install kubernetes-cli
```

Docker Desktop adds its own `kubectl` to the `PATH`, so we should check the version we are getting with `kubectl version --client`.

For docker, the default virtualization environment is WSL 2 (version 2.1.5 or later), which works for most of us and is the one we recommend. Hyper-V is only available on the all-users installation. See our [WSL tutorial](./wsl.md) and the [docker documentation](https://docs.docker.com/desktop/setup/install/windows-install/) for the requirements.

## Installation - Linux

For `kubectl` don't use your distribution's package manager, unless you are comfortable with checking and managing package versions. The simplest way to get a version compatible with our cluster is to install the tool manually with the following commands:

```bash
# download the latest 1.36 release
curl -LO "https://dl.k8s.io/release/$(curl -L -s https://dl.k8s.io/release/stable-1.36.txt)/bin/linux/amd64/kubectl"

# validate the download (optional)
curl -LO "https://dl.k8s.io/release/$(curl -L -s https://dl.k8s.io/release/stable-1.36.txt)/bin/linux/amd64/kubectl.sha256"
echo "$(cat kubectl.sha256)  kubectl" | sha256sum --check

# install
sudo install -o root -g root -m 0755 kubectl /usr/local/bin/kubectl
```

Check the [official documentation](https://kubernetes.io/docs/tasks/tools/install-kubectl-linux) for more details.

For docker, the [official documentation](https://docs.docker.com/desktop/setup/install/linux/) has instructions for several of the major distributions. It's important to follow these to make sure we have the latest repositories added to our package management system.

## Installation - MacOs

For `kubectl` follow the instructions in the [official documentation page](https://kubernetes.io/docs/tasks/tools/install-kubectl-macos/#install-with-homebrew-on-macos). We recommend using [Homebrew](https://brew.sh/) by running:

```bash
brew install kubernetes-cli
```

For docker, the [official documentation](https://docs.docker.com/desktop/setup/install/mac-install/) points to simple installers (depending on our hardware platform, Intel or Apple silicon)

## Installation - just

`just` is optional, these are the simplest ways of installing it (see the [full list](https://just.systems/man/en/packages.html)):

```bash
# Windows
winget install --id Casey.Just --exact

# MacOs
brew install just

# Debian 13, Ubuntu 24.04 and newer
sudo apt install just
```

## Checking the tools

After the installation we can check our tools by running:

```
kubectl version --client

docker --version
```

## Running the project locally

To run the provided code on our own machine we need:

- PHP 8.5 and Composer
- Node.js 24 (24.12 or newer)

If we don't have PHP and Composer the [Laravel installation guide](https://laravel.com/docs/13.x/installation) has a single command for each operating system, for example on Linux:

```bash
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

On Windows and MacOs we can also use [Laravel Herd](https://herd.laravel.com), which installs both.

Each application runs on its own terminal, starting from the base of the project.

Laravel, available at `http://localhost:8000`:

```bash
cd api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Vue, using the URL shown on the terminal:

```bash
cd frontend
npm install
npm run dev
```

WebSockets, available at `http://localhost:3000`:

```bash
cd websockets
npm install
npm run dev
```

The seeded users can log in with the password `password`, for example `test@example.com`.
