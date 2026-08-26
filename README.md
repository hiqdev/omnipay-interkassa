# Omnipay: InterKassa

**InterKassa / UnityFinance driver for the Omnipay PHP payment processing library**

[![Latest Stable Version](https://poser.pugx.org/hiqdev/omnipay-interkassa/v/stable)](https://packagist.org/packages/hiqdev/omnipay-interkassa)
[![Total Downloads](https://poser.pugx.org/hiqdev/omnipay-interkassa/downloads)](https://packagist.org/packages/hiqdev/omnipay-interkassa)
[![Tests](https://github.com/hiqdev/omnipay-interkassa/actions/workflows/tests.yml/badge.svg)](https://github.com/hiqdev/omnipay-interkassa/actions/workflows/tests.yml)

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP.

This package implements [InterKassa](https://interkassa.com/) support for Omnipay, including its
UnityFinance subcompany, which serves the same Checkout Protocol on a different domain.

Requires PHP 7.4 or later.

## Installation

The preferred way to install this library is through [composer](http://getcomposer.org/download/).

Either run

```sh
composer require hiqdev/omnipay-interkassa
```

or add

```json
"hiqdev/omnipay-interkassa": "^3.0"
```

to the require section of your composer.json.

## Basic Usage

The following gateways are provided by this package:

* `InterKassa` ([`Omnipay\InterKassa\Gateway`](src/Gateway.php)) — the InterKassa Checkout
  Protocol, form-posting to `https://sci.interkassa.com/`.
* `UnityFinance` ([`Omnipay\InterKassa\UnityFinanceGateway`](src/UnityFinanceGateway.php)) — the
  same protocol for the UnityFinance subcompany, form-posting to
  `https://old-pay.unityfinance.com`.

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay) repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/hiqdev/omnipay-interkassa/issues),
or better yet, fork the library and submit a pull request.

## License

This project is released under the terms of the MIT [license](LICENSE).
Read more [here](http://choosealicense.com/licenses/mit).

Copyright © 2015-2026, HiQDev (http://hiqdev.com/)
