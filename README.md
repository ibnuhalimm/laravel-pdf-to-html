# Laravel - PDF to HTML

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibnuhalimm/laravel-pdf-to-html.svg?style=flat-square)](https://packagist.org/packages/ibnuhalimm/laravel-pdf-to-html)
[![Total Downloads](https://img.shields.io/packagist/dt/ibnuhalimm/laravel-pdf-to-html.svg?style=flat-square)](https://packagist.org/packages/ibnuhalimm/laravel-pdf-to-html)

Convert PDF to HTML by using [pdftohtml](https://linux.die.net/man/1/pdftohtml) on Your Laravel Apps.
Special thanks to [pdf-to-text](https://github.com/spatie/pdf-to-text) ([Spatie](https://github.com/spatie)) package
for inspiring this package. 

## Contents
- [Requirements](#requirements)
- [Installation](#installation)
- [Setting Up](#setting-up)
- [Usage](#usage)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

## Requirements
Behind the scene this package leverages [pdftohtml](https://linux.die.net/man/1/pdftohtml).
You can verify if the binary installed on your system by executing this command.
```bash
which pdftohtml
```
If it doesn't return the installed path of the binary, you can install the binary using
the following command.
- Ubuntu and Debian family
```bash
apt-get install poppler-utils
```
- CentOS, Fedora, and RedHat family
```bash
yum install poppler-utils
```
- Mac using brew
```bash
brew install poppler
```


## Installation

You can install the package via composer:

```bash
composer require ibnuhalimm/laravel-pdf-to-html
```

## Setting Up
Optionally, you can set the config in your `.env` file:
```
PDF_TO_HTML_PATH="/usr/bin/pdftohtml"
PDF_TO_HTML_OUTPUT_DIR="/var/www/html/app/public"
PDF_TO_HTML_INLINE_IMAGES=true
```

## Usage

```php
// Usage description here
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email **ibnuhalim@pm.me** instead of using the issue tracker.

## Credits

- [Ibnu Halim Mustofa](https://github.com/ibnuhalimm)
- [Spatie](https://github.com/spatie)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
