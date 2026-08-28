# hiqdev/omnipay-interkassa

## [3.1.0] - 2026-08-28

- Added `UnityFinanceGateway`, for UnityFinance, an Interkassa subcompany serving the
  same Checkout Protocol on a different domain ([@SilverFire])
- Fixed `ik_pnd_u` (pending payment redirect URL) always mirroring `ik_suc_u` instead of
  being independently settable, via `setPendingUrl()` ([@SilverFire])
- Dropped `ik_pnd_m`, an undocumented parameter absent from both providers' specs ([@SilverFire])
- Added support for `ik_result_url` via `setRedirectUrl()`/`getRedirectUrl()` ([@SilverFire])
- **Changed the default `signAlgorithm` from `md5` to `sha256`**, matching both
  providers' documented checkout default. If your checkout is still configured for MD5
  and you rely on the Gateway default, set `signAlgorithm` explicitly before upgrading ([@SilverFire])
- Switched notification timestamp parsing from a hardcoded `Europe/Moscow` timezone to
  `Europe/Kyiv` ([@SilverFire])
- Fixed `getPayer()` to fall back to `ik_payment_method` when `ik_pw_via` is absent —
  confirmed via real UnityFinance production notifications, which don't send `ik_pw_via` ([@SilverFire])
- Upgraded to PHPUnit `^9.6 || ^10.5 || ^11.5` (via `omnipay/tests` `^4.2`) and added a
  GitHub Actions CI matrix for PHP 7.4, 8.3, 8.4, 8.5 ([@SilverFire])

## [3.0] - 2018-11-15

- Upgraded to OmniPay v.3 ([@SilverFire])

## [0.1.1] - 2018-11-15

- Minor changes

## [0.1.0] - 2017-03-02

- Changed default algorithm to `md5` ([@hiqsol])
- Added check for purse(checkout ID) not cheated ([@hiqsol])
- Added tests ([@hiqsol], [@SilverFire], [@dercoder])
- Redone to `omnipay-interkassa` ([@hiqsol])
- Added basics ([@hiqsol])

## [Development started] - 2015-10-23

[@dercoder]: https://github.com/dercoder
[alexander.fedra@gmail.com]: https://github.com/dercoder
[@hiqsol]: https://github.com/hiqsol
[sol@hiqdev.com]: https://github.com/hiqsol
[@SilverFire]: https://github.com/SilverFire
[d.naumenko.a@gmail.com]: https://github.com/SilverFire
[@tafid]: https://github.com/tafid
[andreyklochok@gmail.com]: https://github.com/tafid
[@BladeRoot]: https://github.com/BladeRoot
[bladeroot@gmail.com]: https://github.com/BladeRoot
[Under development]: https://github.com/hiqdev/omnipay-interkassa/compare/3.1.0...HEAD
[0.1.0]: https://github.com/hiqdev/omnipay-interkassa/releases/tag/0.1.0
[Development started]: https://github.com/hiqdev/omnipay-interkassa/compare/0.1.1...Development started
[0.1.1]: https://github.com/hiqdev/omnipay-interkassa/compare/0.1.0...0.1.1
[3.0]: https://github.com/hiqdev/omnipay-interkassa/compare/0.1.1...3.0
[3.1.0]: https://github.com/hiqdev/omnipay-interkassa/compare/3.0...3.1.0
