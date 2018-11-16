# hiqdev/omnipay-interkassa

## [2.0] - 2017-03-02

- Changed default algorithm to `md5`
    - [98d80e8] 2017-03-01 changed default algorithm to `md5` [@hiqsol]
- Added check for purse(checkout ID) not cheated
    - [20ad913] 2017-03-01 added check for checkout ID not cheated, returning time in ISO [@hiqsol]
- Added tests
    - [5a22178] 2017-03-01 fixed tests [@hiqsol]
    - [af323ee] 2017-03-01 csfixed [@hiqsol]
    - [6fe2d5f] 2017-03-01 added get/set unified secret in Gateway [@hiqsol]
    - [c932754] 2017-03-01 made signKey NOT required for purchase request [@hiqsol]
    - [19ad484] 2017-03-01 added getting both GET and POST vars into CompletePurchaseRequest [@hiqsol]
    - [9fbca51] 2016-03-11 Enhanced tests design [@SilverFire]
    - [1b7afa5] 2016-03-10 Merge pull request #3 from dercoder/master [@SilverFire]
    - [394d0ee] 2016-03-10 Merge remote-tracking branch 'origin/master' [@dercoder]
    - [abe3c6d] 2016-03-10 Test mode feature added [@dercoder]
    - [50bc536] 2016-03-10 Test mode feature added [@dercoder]
    - [1368089] 2016-03-10 CompletePurchaseResponse::getTransactionReference() returns `ik_inv_id` istead of `ik_trn_id` [@SilverFire]
    - [058bbc5] 2016-03-10 Adjusted tests [@SilverFire]
    - [de874bd] 2016-03-10 OldCompletePurchaseResponse::getTransactionId() returns `ik_payment_id` instead of `ik_trans_id` getTransactionReference() returns `ik_trans_id` instead of `ik_payment_id` [@SilverFire]
    - [6731ed2] 2016-03-10 CompletePurchaseResponse::getTransactionId() returns `ik_pm_no` istead of `ik_inv_id` [@SilverFire]
    - [e315fa3] 2016-01-21 rehideved [@hiqsol]
    - [876ecb8] 2015-12-24 fixed build [@hiqsol]
    - [5a94e11] 2015-12-24 php-cs-fixed [@hiqsol]
    - [09b7ef1] 2015-12-22 Added tests [@SilverFire]
    - [c389031] 2015-12-21 Added dev-dependency to omnipay/tests [@SilverFire]
    - [d183b37] 2015-12-19 Added payment method in CompletePurchase [@SilverFire]
    - [8dc2fcc] 2015-12-18 APIv1 support implemented [@SilverFire]
    - [b2fc919] 2015-12-18 ScretKey -> Secret, other minor [@SilverFire]
    - [5462d53] 2015-12-17 Implemeted CompletePurchase [@SilverFire]
    - [817dd80] 2015-12-16 API v1 and API v2 separated [@SilverFire]
    - [8d2dceb] 2015-12-15 Purchase request implemented [@SilverFire]
- Redone to `omnipay-interkassa`
    - [fd2482a] 2015-12-10 removed assets, now in `payment-icons` [@hiqsol]
    - [a05fd52] 2015-11-11 php-cs-fixed [@hiqsol]
    - [c61f3f6] 2015-11-11 - Omnipay/interkassa namespace [@hiqsol]
    - [d18d6ea] 2015-11-11 + Omnipay\interkassa namespace [@hiqsol]
    - [3756a75] 2015-11-06 changed license to MIT [@hiqsol]
    - [ef0ecc6] 2015-11-06 redoing to omnipay-interkassa [@hiqsol]
- Added basics
    - [b075280] 2015-10-31 fixed `_secret` <- `secret` [@hiqsol]
    - [81c5893] 2015-10-30 changed: redone to `system` <- `name` [@hiqsol]
    - [1e71fd1] 2015-10-30 fixed typo [@hiqsol]
    - [6074b54] 2015-10-23 php-cs-fixed [@hiqsol]
    - [7d34119] 2015-10-23 hideved [@hiqsol]
    - [b6b4c95] 2015-10-23 inited [@hiqsol]

## [Development started] - 2015-10-23

## [0.1.1] - 2017-08-08

    - [870c101] 2017-08-08 csfixed [@hiqsol]
    - [d725a3c] 2017-08-08 csfixed [@hiqsol]
    - [7177a58] 2017-08-08 renamed `hidev.yml` [@hiqsol]
    - [c96a270] 2017-04-05 Merge pull request #6 from bladeroot/omnipay-interkassa-is-old [@hiqsol]
    - [f5d12dc] 2017-04-05 fix statement [@BladeRoot]

## [0.1.0] - 2017-03-02

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
[e315fa3]: https://github.com/hiqdev/omnipay-interkassa/commit/e315fa3
[876ecb8]: https://github.com/hiqdev/omnipay-interkassa/commit/876ecb8
[5a94e11]: https://github.com/hiqdev/omnipay-interkassa/commit/5a94e11
[09b7ef1]: https://github.com/hiqdev/omnipay-interkassa/commit/09b7ef1
[c389031]: https://github.com/hiqdev/omnipay-interkassa/commit/c389031
[d183b37]: https://github.com/hiqdev/omnipay-interkassa/commit/d183b37
[8dc2fcc]: https://github.com/hiqdev/omnipay-interkassa/commit/8dc2fcc
[b2fc919]: https://github.com/hiqdev/omnipay-interkassa/commit/b2fc919
[5462d53]: https://github.com/hiqdev/omnipay-interkassa/commit/5462d53
[817dd80]: https://github.com/hiqdev/omnipay-interkassa/commit/817dd80
[8d2dceb]: https://github.com/hiqdev/omnipay-interkassa/commit/8d2dceb
[fd2482a]: https://github.com/hiqdev/omnipay-interkassa/commit/fd2482a
[a05fd52]: https://github.com/hiqdev/omnipay-interkassa/commit/a05fd52
[c61f3f6]: https://github.com/hiqdev/omnipay-interkassa/commit/c61f3f6
[d18d6ea]: https://github.com/hiqdev/omnipay-interkassa/commit/d18d6ea
[3756a75]: https://github.com/hiqdev/omnipay-interkassa/commit/3756a75
[ef0ecc6]: https://github.com/hiqdev/omnipay-interkassa/commit/ef0ecc6
[b075280]: https://github.com/hiqdev/omnipay-interkassa/commit/b075280
[81c5893]: https://github.com/hiqdev/omnipay-interkassa/commit/81c5893
[1e71fd1]: https://github.com/hiqdev/omnipay-interkassa/commit/1e71fd1
[6074b54]: https://github.com/hiqdev/omnipay-interkassa/commit/6074b54
[7d34119]: https://github.com/hiqdev/omnipay-interkassa/commit/7d34119
[b6b4c95]: https://github.com/hiqdev/omnipay-interkassa/commit/b6b4c95
[5a22178]: https://github.com/hiqdev/omnipay-interkassa/commit/5a22178
[af323ee]: https://github.com/hiqdev/omnipay-interkassa/commit/af323ee
[6fe2d5f]: https://github.com/hiqdev/omnipay-interkassa/commit/6fe2d5f
[c932754]: https://github.com/hiqdev/omnipay-interkassa/commit/c932754
[20ad913]: https://github.com/hiqdev/omnipay-interkassa/commit/20ad913
[98d80e8]: https://github.com/hiqdev/omnipay-interkassa/commit/98d80e8
[19ad484]: https://github.com/hiqdev/omnipay-interkassa/commit/19ad484
[9fbca51]: https://github.com/hiqdev/omnipay-interkassa/commit/9fbca51
[1b7afa5]: https://github.com/hiqdev/omnipay-interkassa/commit/1b7afa5
[394d0ee]: https://github.com/hiqdev/omnipay-interkassa/commit/394d0ee
[abe3c6d]: https://github.com/hiqdev/omnipay-interkassa/commit/abe3c6d
[50bc536]: https://github.com/hiqdev/omnipay-interkassa/commit/50bc536
[1368089]: https://github.com/hiqdev/omnipay-interkassa/commit/1368089
[058bbc5]: https://github.com/hiqdev/omnipay-interkassa/commit/058bbc5
[de874bd]: https://github.com/hiqdev/omnipay-interkassa/commit/de874bd
[6731ed2]: https://github.com/hiqdev/omnipay-interkassa/commit/6731ed2
[Under development]: https://github.com/hiqdev/omnipay-interkassa/releases
[0.1.0]: https://github.com/hiqdev/omnipay-interkassa/releases/tag/0.1.0
[870c101]: https://github.com/hiqdev/omnipay-interkassa/commit/870c101
[d725a3c]: https://github.com/hiqdev/omnipay-interkassa/commit/d725a3c
[7177a58]: https://github.com/hiqdev/omnipay-interkassa/commit/7177a58
[c96a270]: https://github.com/hiqdev/omnipay-interkassa/commit/c96a270
[f5d12dc]: https://github.com/hiqdev/omnipay-interkassa/commit/f5d12dc
[Development started]: https://github.com/hiqdev/omnipay-interkassa/compare/0.1.1...Development started
[2.0]: https://github.com/hiqdev/omnipay-interkassa/releases/tag/2.0
[0.1.1]: https://github.com/hiqdev/omnipay-interkassa/compare/0.1.0...0.1.1
