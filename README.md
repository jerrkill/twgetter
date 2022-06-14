<h1 align="center"> Twgetter </h1>

<p align="center"> A Twitter Getter.</p>

![StyleCI build status](https://github.styleci.io/repos/503480302/shield) 


## Installing

```shell
$ composer require jerrkill/twgetter -vvv
```

## Config

.env

```shell
TWGETTER_X_CSRF_TOKEN=''
TWGETTER_COOKIE=''
TWGETTER_BEARER_TOKEN=''
```

## Usage

```php
use Jerrkill\Twgetter\Twgetter;

$twg = new Twgetter();

```

### getAdvanceSearch

```php

$response = $twg->getAdvanceSearch('(btc)', 5, 'json');

```

example

```json
[
    {
        "id": "1536664548043800576",
        "author_id": "1337780902680809474",
        "author_name": "Documenting Bitcoin 📄",
        "author_username": "DocumentingBTC",
        "text": "Notice a pattern? https:\/\/t.co\/4tp5T6Wf39",
        "created_at": "Tue Jun 14 10:59:12 +0000 2022",
        "retweet_count": 568,
        "reply_count": 142,
        "like_count": 2399,
        "quote_count": 45,
        "lang": "en"
    },
    {
        "id": "1536746316868595715",
        "author_id": "244647486",
        "author_name": "Michael Saylor⚡️",
        "author_username": "saylor",
        "text": "The sound ethical, economic &amp; technical foundation for DeFi is #Bitcoin. The next generation of DeFi will be built using the #Lightning⚡️ protocol and the #BTC token.\nhttps:\/\/t.co\/5LlNlXkLMt",
        "created_at": "Tue Jun 14 16:24:07 +0000 2022",
        "retweet_count": 620,
        "reply_count": 475,
        "like_count": 4480,
        "quote_count": 48,
        "lang": "en"
    },
    {
        "id": "1536528183494856704",
        "author_id": "18469669",
        "author_name": "Saifedean.com",
        "author_username": "saifedean",
        "text": "Even after this huge crash, bitcoin still beats all pretenders for long-term saving\n\nIf you spent the last 5 years saving $100 a month, here's what you would have today if you put it in:\n\nBitcoin: $29,212\nS&amp;P500: $7,743\nDow Jones: $7,654\nGold: $7,089\nPIMCO Active Bond ETF: $5,387",
        "created_at": "Tue Jun 14 01:57:20 +0000 2022",
        "retweet_count": 909,
        "reply_count": 288,
        "like_count": 3875,
        "quote_count": 108,
        "lang": "en"
    },
    {
        "id": "1536732038341984258",
        "author_id": "361289499",
        "author_name": "Bitcoin Magazine",
        "author_username": "BitcoinMagazine",
        "text": "BREAKING - Jack Dorsey’s TBD business unit to build #Bitcoin Lightning Network infrastructure 👏 https:\/\/t.co\/tha7mioKJK",
        "created_at": "Tue Jun 14 15:27:23 +0000 2022",
        "retweet_count": 189,
        "reply_count": 113,
        "like_count": 1239,
        "quote_count": 11,
        "lang": "en"
    },
    {
        "id": "1536521491763765248",
        "author_id": "1043168156",
        "author_name": "Lex Moskovski",
        "author_username": "mskvsk",
        "text": "Celsius has posted another 1501 BTC as collateral and pushed its liquidation price down to $17,211.",
        "created_at": "Tue Jun 14 01:30:45 +0000 2022",
        "retweet_count": 1043,
        "reply_count": 550,
        "like_count": 7889,
        "quote_count": 492,
        "lang": "en"
    }
```

### getUserTweets

```php

$response = $twg->getUserTweets(2893133450, 5, 'json');

```

### getListTweets

```php

$response = $twg->getListTweets(144748104, 5, 'json');

```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/jerrkill/twgetter/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/jerrkill/twgetter/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
