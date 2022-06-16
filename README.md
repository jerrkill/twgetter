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

$response = $twg->getUserTweets(2893133450, 5);

```

```json
{
    "tweets": [
        {
            "id": "1537419825592651781",
            "author_id": "2893133450",
            "author_name": "Tether",
            "author_username": "Tether_to",
            "text": "USD₮ – The Blueprint for Private Stablecoins \n\nhttps:\/\/t.co\/8WzUzUSNhq",
            "created_at": "Thu Jun 16 13:00:24 +0000 2022",
            "retweet_count": 12,
            "reply_count": 22,
            "like_count": 104,
            "quote_count": 7,
            "lang": "en"
        },
        {
            "id": "1537404080104083456",
            "author_id": "2893133450",
            "author_name": "Tether",
            "author_username": "Tether_to",
            "text": "RT @paoloardoino: When you remove \"producing returns\" as main goal from a project, you can build the most amazing libertarian products in t…",
            "created_at": "Thu Jun 16 11:57:50 +0000 2022",
            "retweet_count": 21,
            "reply_count": 0,
            "like_count": 0,
            "quote_count": 0,
            "lang": "en"
        },
        {
            "id": "1537404034994388993",
            "author_id": "2893133450",
            "author_name": "Tether",
            "author_username": "Tether_to",
            "text": "RT @paoloardoino: Peer to peer comms, private, no middlemen and no token required is coming.\nFreedom and privacy with better quality and no…",
            "created_at": "Thu Jun 16 11:57:40 +0000 2022",
            "retweet_count": 79,
            "reply_count": 0,
            "like_count": 0,
            "quote_count": 0,
            "lang": "en"
        },
        {
            "id": "1537004236034154496",
            "author_id": "2893133450",
            "author_name": "Tether",
            "author_username": "Tether_to",
            "text": "RT @paoloardoino: 1\/\nTether reduced almost 50% its CP holdings since 31st March 2022. By end of June only 8.4B CP left. CP exposure going t…",
            "created_at": "Wed Jun 15 09:29:00 +0000 2022",
            "retweet_count": 521,
            "reply_count": 0,
            "like_count": 0,
            "quote_count": 0,
            "lang": "en"
        }
    ],
    "users": [],
    "lists": [],
    "meta": {
        "previous_page": "HCaAgICk\/dq31ioAAA==",
        "next_page": "HBaAgLGxss3E1CoAAA=="
    }
}
```

### getListTweets

```php

$response = $twg->getListTweets(144748104, 3);

```

```json
{
    "tweets": [
        {
            "id": "1537530479661830144",
            "author_id": "24181760",
            "author_name": "Anish Acharya",
            "author_username": "illscience",
            "text": "It's always surprised me that founders who make the best products in the world have to use the worst products in the world to raise and close their round. \n\nPartyround changes all that, so if you're a founder who cares about the details of everything they do -&gt; 🦉 👀",
            "created_at": "Thu Jun 16 20:20:06 +0000 2022",
            "retweet_count": 0,
            "reply_count": 0,
            "like_count": 2,
            "quote_count": 0,
            "lang": "en"
        },
        {
            "id": "1537529784216915968",
            "author_id": "16005828",
            "author_name": "Jeff Jordan",
            "author_username": "jeff_jordan",
            "text": "BOOM!  Super excited to partner with these outstanding LP's.",
            "created_at": "Thu Jun 16 20:17:21 +0000 2022",
            "retweet_count": 0,
            "reply_count": 0,
            "like_count": 3,
            "quote_count": 0,
            "lang": "en"
        },
        {
            "id": "1537529194824970240",
            "author_id": "16242081",
            "author_name": "benahorowitz.eth",
            "author_username": "bhorowitz",
            "text": "I am so proud of @meghalexander and the CLF team. They continue to push tech and culture forward with Fund 3!!!",
            "created_at": "Thu Jun 16 20:15:00 +0000 2022",
            "retweet_count": 3,
            "reply_count": 1,
            "like_count": 18,
            "quote_count": 1,
            "lang": "en"
        }
    ],
    "users": [],
    "lists": [],
    "meta": {
        "previous_page": "HCaAwKL55vSz1ioAAA==",
        "next_page": "HBaAwK2Vgqqz1ioAAA=="
    }
}
```

### getUserLists

```php

$response = $twg->getUserLists(1127061095422672897,2, '1376636817089396750|1537537126084640764');

```

```json
{
    "tweets": [],
    "users": [],
    "lists": [
        {
            "id": "144748104",
            "name": "a16z partners",
            "description": "",
            "mode": "Public",
            "created_at": 1404867938000,
            "member_count": 99,
            "follower_count": 21853
        },
        {
            "id": "1312558574288007168",
            "name": "VCs",
            "description": "List of Venture Capital Folks",
            "mode": "Public",
            "created_at": 1601773324000,
            "member_count": 64,
            "follower_count": 2252
        }
    ],
    "meta": {
        "next_page": "0|1537537126084640760",
        "previous_page": "-1|1537537126084640765"
    }
}
```

### getUserFollowing

```php

$response = $twg->getUserLists(1127061095422672897, 20, '1376636817089396750|1537537126084640764');

```

### getUserFollowers

```php

$response = $twg->getUserLists(1127061095422672897, 20, '1376636817089396750|1537537126084640764');

```

```json
{
    "tweets": [],
    "users": [
        {
            "id": "2529971",
            "name": "cdixon.eth",
            "username": "cdixon",
            "description": "Programming, philosophy, history, internet, startups, web3 @ a16z",
            "verified": true,
            "location": "CA",
            "created_at": "Tue Mar 27 17:48:00 +0000 2007",
            "profile_image_url": "https:\/\/pbs.twimg.com\/profile_images\/1433529810681155587\/ACs86CsF_normal.png",
            "public_metrics": {
                "followers_count": 854824,
                "following_count": 4081,
                "tweet_count": 12524,
                "listed_count": 15114,
                "like_count": 22929
            }
        },
        {
            "id": "149763",
            "name": "Sriram Krishnan - sriramk.eth",
            "username": "sriramk",
            "description": "GP @a16z crypto.   Into web3\/crypto and communities. Host @GoodTimeShowAS with @aarthir.",
            "verified": true,
            "location": "San Francisco",
            "created_at": "Fri Dec 22 06:29:50 +0000 2006",
            "profile_image_url": "https:\/\/pbs.twimg.com\/profile_images\/1486656046990970880\/zfu-pvK__normal.jpg",
            "public_metrics": {
                "followers_count": 141363,
                "following_count": 1476,
                "tweet_count": 14488,
                "listed_count": 2387,
                "like_count": 110046
            }
        },
        .
        .
        .
        {
            "id": "16591288",
            "name": "martin_casado",
            "username": "martin_casado",
            "description": "GP @ a16z\n\n... questionable heuristics in a grossly underdetermined world",
            "verified": false,
            "location": "",
            "created_at": "Sat Oct 04 13:40:09 +0000 2008",
            "profile_image_url": "https:\/\/pbs.twimg.com\/profile_images\/1390121930812891141\/A9p_xJve_normal.jpg",
            "public_metrics": {
                "followers_count": 35995,
                "following_count": 1104,
                "tweet_count": 16334,
                "listed_count": 833,
                "like_count": 30939
            }
        },
    ],
    "lists": [],
    "meta": {
        "next_page": "1723820479658998759|1537543786677141486",
        "previous_page": "-1|1537543786677141505"
    }
}
```


## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/jerrkill/twgetter/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/jerrkill/twgetter/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
