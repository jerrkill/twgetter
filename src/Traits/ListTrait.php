<?php

/*
 * This file is part of the overtrue/weather.
 *
 * (c) jerrkill <jerrkill123@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jerrkill\Twgetter\Traits;

trait ListTrait
{
    public function getListTweets(int $listId, int $count = 20, string $format = 'array')
    {
        $path = 'graphql/vUME3Ko13lCWTSs-fEKPZQ/ListLatestTweetsTimeline';

        $variables = [
            'listId' => $listId,
            'count' => $count,
            'withSuperFollowsUserFields' => true,
            'withDownvotePerspective' => false,
            'withReactionsMetadata' => false,
            'withReactionsPerspective' => false,
            'withSuperFollowsTweetFields' => true,
        ];

        $features = [
            'dont_mention_me_view_api_enabled' => true,
            'interactive_text_enabled' => true,
            'responsive_web_uc_gql_enabled' => false,
            'vibe_tweet_context_enabled' => false,
            'responsive_web_edit_tweet_api_enabled' => false,
            'standardized_nudges_for_misinfo_nudges_enabled' => false,
            'responsive_web_enhance_cards_enabled' => false,
        ];

        $params = [
            'variables' => \json_encode($variables),
            'features' => \json_encode($features),
        ];

        return $this->parseListTweetsResponse($this->get($path, $params, $format));
    }

    public function parseListTweetsResponse($response)
    {
        $tws = [];
        $entries = $response['data']['list']['tweets_timeline']['timeline']['instructions'][0]['entries'];

        foreach ($entries as $entry) {
            if ('TimelineTimelineItem' == $entry['content']['entryType']) {
                $result = $entry['content']['itemContent']['tweet_results']['result'];
                $user = $result['core']['user_results']['result']['legacy'];
                $tweet = $result['legacy'];
                $tw = [
                    'id' => $tweet['id_str'],
                    'author_id' => $tweet['user_id_str'],
                    'author_name' => $user['name'],
                    'author_username' => $user['screen_name'],
                    'text' => $tweet['full_text'],
                    'created_at' => $tweet['created_at'],
                    'retweet_count' => $tweet['retweet_count'],
                    'reply_count' => $tweet['reply_count'],
                    'like_count' => $tweet['favorite_count'],
                    'quote_count' => $tweet['quote_count'],

                    'lang' => $tweet['lang'],
                ];

                if (isset($tweet['retweeted_status_result']) && $tweet['retweeted_status_result']) {
                    $tw['referenced_tweet_id'] = $tweet['retweeted_status_result']['result']['legacy']['id_str'];
                }
                array_push($tws, $tw);
            }
        }

        return $tws;
    }
}
