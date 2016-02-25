# wordpress-guzzle-wrapper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Replace ```wordpress-guzzle-wrapper``` ```Wordpress guzzle wrapper ```

Simple helper for working with Guzzle and wordpress rest API


## Install

Via Composer

``` bash
$ composer require maciekpaprocki/wordpress-guzzle-wrapper
```
 
## Usage

### Transactions
``` php

    use BureauVA\WordpressGuzzle\Transaction\Transaction
    use GuzzleHttp\Client;
    $client = new Client();
    $transaction = new Transaction();
    $transaction->setClient($client);
    


```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email maciekpaprocki@gmail.com instead of using the issue tracker.

## Credits

- [Maciej Paprocki][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/maciekpaprocki/wordpress-guzzle-wrapper.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/bureau-va/wordpress-guzzle-wrapper/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/bureau-va/wordpress-guzzle-wrapper.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/bureau-va/wordpress-guzzle-wrapper.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/maciekpaprocki/wordpress-guzzle-wrapper.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/maciekpaprocki/wordpress-guzzle-wrapper
[link-travis]: https://travis-ci.org/bureau-va/wordpress-guzzle-wrapper
[link-scrutinizer]: https://scrutinizer-ci.com/g/bureau-va/wordpress-guzzle-wrapper/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/bureau-va/wordpress-guzzle-wrapper
[link-downloads]: https://packagist.org/packages/bureau-va/wordpress-guzzle-wrapper
[link-author]: https://github.com/bureau-va
[link-contributors]: ../../contributors
