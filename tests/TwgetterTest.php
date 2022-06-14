<?php

/*
 * This file is part of the overtrue/weather.
 *
 * (c) jerrkill <jerrkill123@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jerrkill\Twgetter\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Jerrkill\Twgetter\Twgetter;
use PHPUnit\Framework\TestCase;

class TwgetterTest extends TestCase
{
    public function testGetGetHttpClient()
    {
    }

    public function testSetGuzzleOptions()
    {
    }

    public function testAdvanceSearch()
    {
        $response = new Response(200, [], '{"success": true}');

        $client = \Mockery::mock(Client::class);
        $params = [
            'include_profile_interstitial_type' => 1,
            'include_blocking' => 1,
            'include_blocked_by' => 1,
            'include_followed_by' => 1,
            'include_want_retweets' => 1,
            'include_mute_edge' => 1,
            'include_can_dm' => 1,
            'include_can_media_tag' => 1,
            'include_ext_has_nft_avatar' => 1,
            'skip_status' => 1,
            'cards_platform' => 'Web-12',
            'include_cards' => 1,
            'include_ext_alt_text' => true,
            'include_quote_count' => true,
            'include_reply_count' => 1,
            'tweet_mode' => 'extended',
            'include_entities' => true,
            'include_user_entities' => true,
            'include_ext_media_color' => true,
            'include_ext_media_availability' => true,
            'include_ext_sensitive_media_warning' => true,
            'include_ext_trusted_friends_metadata' => true,
            'send_error_codes' => true,
            'simple_quoted_tweet' => true,
            'count' => 20,
            'query_source' => 'typed_query',
            'pc' => 1,
            'spelling_corrections' => 1,
            'ext' => 'mediaStats%2ChighlightedLabel%2ChasNftAvatar%2CvoiceInfo%2Cenrichments%2CsuperFollowMetadata%2CunmentionInfo',
            'q' => 'btc',
        ];

        $w = \Mockery::mock(Twgetter::class)->makePartial();
        $client->allows()->get('https://twitter.com/i/api/2/search/adaptive.json', [
            'headers' => [
                'x-csrf-token' => $w->getXCsrfToken(),
                'cookie' => $w->getCookie(),
                'Authorization' => $w->getAuthorization(),
            ],
            'query' => $params,
        ])->andReturn($response);

        $w = \Mockery::mock(Twgetter::class)->makePartial();
        $w->allows()->getHttpClient()->andReturn($client);

        $this->assertSame(['success' => true], $w->advanceSearch('btc', 20, 'json'));
    }
}
