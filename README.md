# Export interface with a CSV implementation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/madewithlove/export.svg?style=flat-square)](https://packagist.org/packages/madewithlove/export)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/madewithlove/export/master.svg?style=flat-square)](https://travis-ci.org/madewithlove/export)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/madewithlove/export.svg?style=flat-square)](https://scrutinizer-ci.com/g/madewithlove/export)
[![Quality Score](https://img.shields.io/scrutinizer/g/madewithlove/export.svg?style=flat-square)](https://scrutinizer-ci.com/g/madewithlove/export)

## Usage

What it does in one code sample:

```php
// A list of users to export.
$users = [
    [
        'username' => 'John Doe',
        'email' => 'john.doe@gmail.com',
    ],
    [
        'username' => 'Jane Doe',
        'email' => 'jane.doe@gmail.com',
    ],
];

// Create a new CSV exporter object.
$exporter = new Madewithlove\Export\Csv\Exporter();

// Create a new custom Transformer object (an anonymous class, only in PHP 7)
$transformer = new class implements Madewithlove\Export\Csv\Transformer, Madewithlove\Export\Csv\WithHeaders {
    public function getHeaders()
    {
        return ['username', 'email'];
    }

    public function transform(array $user)
    {
        return [
            $user['username'],
            $user['email'],
        ];
    }
};

$exporter->setItems($users);
$exporter->setTransformer($transformer);

// New controller being (an anonymous class, only in PHP 7)
$controller = new class {
    use Madewithlove\Export\Http\Psr7Response;

    /**
     * @param Madewithlove\Export\Exporter $exporter
     */
    public function index(Exporter $exporter)
    {
         return $this->fileDownload($exporter->getContent(), 'users.csv');
    }
};

$psrResponse = $controller->index($exporter);
```

### CSV exporter

The included CSV exporter (`Madewithlove\Export\Csv\Exporter`) will create the file contents for a CSV export file. For that it uses the Writer class of the `league/csv` package, but that's just an implementation detail. It adheres to the `Madewithlove\Export\Exporter` interface (feel free to make an XML or any other exporter implementation) and returns the file content when you call the `getContent()` method on it. You can define which items it should export by passing an array or an `Iterator` (like a [`Generator`](http://php.net/manual/en/language.generators.overview.php)) to the `setItems($items)` method. You can also optionally set a Transformer to apply a transformation on each row of the given items. This `Transformer` is used by the `League\Csv\Writer` class, and may implement the `Madewithlove\Export\Csv\WithHeaders` contract to let the writer know which headers the CSV file should have.

### Transformers

A Transformer object has a method `transform(array $row) : array` which allows you to do transformations on each row. The interface `Madewithlove\Export\Csv\WithHeaders` defines a `getHeaders() : array` method that returns the headers to be used in the CSV file.

This package also includes some transformer implementations for general usage:

#### Callable transformer

This allows you to use any callable (function) without having to create a class that implements the Transformer interface. Create one by using the factory method, or use the setter method:

```php
use Madewithlove\Export\Csv\Transformers\CallableTransformer;

$transformer = (new CallableTransformer())->setTransformer(function (array $row) {...});

$transformer = CallableTransformer::fromCallable(function (array $row) {...});
```

#### Null transformer, just headers

When you don't really need to do a transformation on the row, but you do want to insert headers in the CSV file, use the `JustHeaders` transformer class:

```php
use Madewithlove\Export\Csv\Transformers\JustHeaders;

$transformer = (new JustHeaders())->setHeaders(['username', 'email']);

$transformer = JustHeaders::fromHeaders(['username', 'email']);
```

#### Headers decorator

When you have an existing Transformers object but you want it to add headers to the CSV file too, you don't need to extend it. Just wrap it with the `WithHeadersDecorator` like this:

```php
use Madewithlove\Export\Csv\Transformers\JustHeaders;

$transformer = new WithHeadersDecorator($reusedTransformer, $headers);

$transformer = (new WithHeadersDecorator($reusedTransformer))->setHeaders($headers);
```

### HTTP Response objects

Both Symfony and PSR-7 reponse objects are supported. Use the trait `Madewithlove\Export\Http\SymfonyResponse` or `Madewithlove\Export\Http\Psr7Response` in your controller to make a file download response object with the `fileDownload($content, $filename)` method. This requires you to install the `symfony/http-foundation` package or `zendframework/zend-diactoros` package respectively.

## Install

In order to install it via composer you should run this command:

```bash
composer require madewithlove/export
```

## Testing

``` bash
$ vendor/bin/phpunit
```

## Credits

[All Contributors](https://github.com/madewithlove/export/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
