# wordpress-guzzle-wrapper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Simple helper for working with Guzzle and wordpress rest API


## Install

Via Composer

``` bash
$ composer require maciekpaprocki/wordpress-guzzle-wrapper
```
 
## Usage
### Repositories

Repositories are de facto your query builders. 

Provided with query information they need to return async promise (or whatever wrapped in promise).

### Transformers 

Transformers are responsible for converting data received from async calls. 
All the data is transformed using json_decode then if data is object transformers are run on whole data set. 
If data is array transformers are run on each of the array values. 

### Pool
Pool is responsible for aggregating three services. 
1. Transformers
2. Cache
3. 
``` php

    use BureauVA\WordpressGuzzle\Pool;
    $pool = new Pool();
    $pool->setTransformers(...Transformer Array);
    $pool->setCachePool(...External Cache Pool);
    $pool->setPromises(...Promises array);
    
```



## Contributing

Yope, so you need to have those ones installed globaly:
1. [Composer][link-composer]
2. [PHP CS Fixer][link-fixer]
3. [PHPUNIT][link-phpunit]

then run those lines in empty folder of your choice
``` bash
git clone git@github.com:bureau-va/wordpress-guzzle-wrapper.git .
touch .git/hooks/pre-commit
sudo chmod 777 .git/hooks/pre-commit
echo "composer pre-commit" >> .git/hooks/pre-commit
```

this will set up base repo and make sure that before each commit your local tests and cs fixer are used. 


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Credits

- [BureauVA][link-author]
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
[link-downloads]: https://packagist.org/packages/maciekpaprocki/wordpress-guzzle-wrapper
[link-author]: https://github.com/bureau-va
[link-contributors]: ../../contributors
[link-composer]: https://getcomposer.org
[link-fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer
[link-phpunit]: https://phpunit.de/