# Artisan Maker
A simple package that can help you create a boilerplate of a service, action, interface and facade class with artisan command.

## Installation

```bash
composer require mazecodec/artisan-maker
```

## Usage
### Create a service class:
Run the following command:

```bash
php artisan make:service {ServiceName}
```

The service will be created and can be found at **app/Services/{ServiceName}.php** \
For example: ```php artisan make:service UserService```
#### Additionally, you can create a service that implements an interface class and action class:

```bash
php artisan make:service {ServiceName} --interface={InterfaceName}
```

```bash
php artisan make:service {ServiceName} --interface={InterfaceName} --action={ActionName}
```

or

```bash
php artisan make:service {ServiceName} -i {InterfaceName}
```

```bash
php artisan make:service {ServiceName} -i {InterfaceName} -a {ActionName}
```

### Create an action class:
Run the following command:

```bash
php artisan make:action {ActionName}
```

The action will be created and can be found at **app/Actions/{ActionName}.php** \
For example: ```php artisan make:action FooStoreAction```

### Create an interface class:
Run the following command:

```bash
php artisan make:interface {InterfaceName}
```

The interface will be created and can be found at **app/Contracts/{InterfaceName}.php** \
For example: ```php artisan make:interface FooServiceInterface```

### Create a facade class:
Run the following command:

```bash
php artisan make:facade {FacadeName}
```

The facade will be created and can be found at **app/Facades/{FacadeName}.php** \
For example: ```php artisan make:facade FooFacade```
