
# About

Simple small PHP dependency injection container

## Install

### Composer

```bash
composer require ghosty/container
```

## Using

### Bind

Register a binding with the container.

```php
use Ghosty\Container\Container;

Container::getInstance()->bind(TestContract::class, Test::class);

```

### Bind Singleton

Register a singleton binding with the container.

```php
use Ghosty\Container\Container;

Container::getInstance()->singleton(TestContract::class, Test::class);
```

or

```php
use Ghosty\Container\Container;

Container::getInstance()->bind(TestContract::class, Test::class, true);
```

### Make

Resolve the binding from the container.

```php
use Ghosty\Container\Container;

Container::getInstance()->make(TestContract::class);
```

### Has

Сhecks if the container contains a binding

```php
use Ghosty\Container\Container;

Container::getInstance()->has(TestContract::class);
```

## Facades

You can also use facades. For example:

```php
use Ghosty\Container\Facades\Container;

Container::bind(TestContract::class, Test::class);

```

or

```php
use Ghosty\Container\Facades\Container;

Container::make(TestContract::class);

```
