<?php

namespace Jerrkill\Twgetter\Traits;

trait SearchTrait
{
    public function getAdvanceSearch(string $q, int $count, string $format = 'array')
    {
        $path = '2/search/adaptive.json';
        $params = [
            'include_profile_interstitial_type' => false,
            'include_blocking' => false,
            'include_blocked_by' => false,
            'include_followed_by' => false,
            'include_want_retweets' => false,
            'include_mute_edge' => false,
            'include_can_dm' => false,
            'include_can_media_tag' => false,
            'include_ext_has_nft_avatar' => false,
            'skip_status' => 1,
            'cards_platform' => 'Web-12',
            'include_cards' => 0,
            'include_ext_alt_text' => true,
            'include_quote_count' => true,
            'include_reply_count' => 1,
            'tweet_mode' => 'extended',
            'include_entities' => false,
            'include_user_entities' => false,
            'include_ext_media_color' => false,
            'include_ext_media_availability' => false,
            'include_ext_sensitive_media_warning' => false,
            'include_ext_trusted_friends_metadata' => false,
            'send_error_codes' => false,
            'simple_quoted_tweet' => false,
            'count' => $count,
            'query_source' => 'typed_query',
            // 'pc' => 1,
            // 'spelling_corrections' => 1,
            // 'ext' => 'mediaStats%2ChighlightedLabel%2ChasNftAvatar%2CvoiceInfo%2Cenrichments%2CsuperFollowMetadata%2CunmentionInfo',
            'q' => $q,
        ];

        return $this->parseAdvanceSearchResponse($this->get($path, $params, $format));
    }

    public function parseAdvanceSearchResponse($response)
    {
        $tws = [];
        $tweets = $response['globalObjects']['tweets'];
        $users = $response['globalObjects']['users'];
        foreach ($tweets as $tweet) {
            $tw = [
                'id' => $tweet['id_str'],
                'author_id' => $tweet['user_id_str'],
                'author_name' => $users[$tweet['user_id_str']]['name'],
                'author_username' => $users[$tweet['user_id_str']]['screen_name'],
                'text' => $tweet['full_text'],
                'created_at' => $tweet['created_at'],
                'retweet_count' => $tweet['retweet_count'],
                'reply_count' => $tweet['reply_count'],
                'like_count' => $tweet['favorite_count'],
                'quote_count' => $tweet['quote_count'],

                'lang' => $tweet['lang'],
            ];
            array_push($tws, $tw);
        }
        
        return $tws;
    }
}