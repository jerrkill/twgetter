<?php

/*
 * This file is part of the jerrkill/twgetter.
 *
 * (c) jerrkill <jerrkill123@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jerrkill\Twgetter\Traits;

use Jerrkill\Twgetter\Exceptions\ParseException;

trait ParseTrait
{
    public function parseScraperTweets($tws)
    {
        $tweets = [];
        try {
            foreach($tws as $tw) {
                $tweet = $this->parseScraperTweet($tw);
                array_push($tweets, $tweet);
            }
            return [
                'tweets' => $tweets,
                'meta' => [],
            ];
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function parseScraperTweet($remoteTw)
    {
        $tweet = [];
        try {
            if (empty($remoteTw)) {
                return [];
            }
            $tweet = [
                'id' => $remoteTw['tweetId'],
                'author_id' => $remoteTw['user_id'],
                'author_name' => $remoteTw['user_fullname'],
                'author_username' => $remoteTw['user_name'],
                'text' => $remoteTw['text'],
                'created_at' => $remoteTw['datetime']->format("Y-m-d\TH:i:s"),
                'retweet_count' => $remoteTw['retweets'],
                'reply_count' => $remoteTw['replies'],
                'like_count' => $remoteTw['likes'],
                'quote_count' => $remoteTw['quotes'],
                'self_thread' => $remoteTw['self_thread'],
                'reply_to' => $remoteTw['reply_to'],
                'reply_to_tweet_id' => $remoteTw['reply_to_tweet_id'],
                'images' => $remoteTw['images'],
                'hashtags' => $remoteTw['hashtags'],
                'mentions' => $remoteTw['mentions'],

                'lang' => $remoteTw['lang'],
            ];

            if (isset($remoteTw['retweeted_status_result']) && $remoteTw['retweeted_status_result']) {
                $tw['referenced_tweet_id'] = $remoteTw['retweeted_status_result']['result']['legacy']['id_str'];
            }

            if (isset($remoteTw['entities'])) {
                $tweet['entities'] = $remoteTw['entities'];
            }

            return $tweet;
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }
    public function parseTimeline($timeline)
    {
        $response = $lists = $tweets = $users = $meta = [];
        try {
            if (!(isset($timeline['instructions']) && $instructions = $timeline['instructions'])) {
                return [];
            }
            $instructions = [];
            foreach ($timeline['instructions'] as $instruction) {
                if ('TimelineAddEntries' !== $instruction['type']) {
                    continue;
                }
                foreach ($instruction['entries'] as $entry) {
                    $content = $entry['content'];
                    // cursor
                    if ('TimelineTimelineCursor' === $content['entryType']) {
                        if ('Bottom' === $content['cursorType']) {
                            $meta['next_page'] = $content['value'];
                        }
                        if ('Top' === $content['cursorType']) {
                            $meta['previous_page'] = $content['value'];
                        }
                    }
                    if ('TimelineTimelineItem' === $content['entryType']) {
                        // users
                        if ('TimelineUser' === $content['itemContent']['itemType']) {
                            $user = $this->parseUserResults($content['itemContent']['user_results']);
                            if ($user) {
                                array_push($users, $user);
                            }
                        }

                        // lists
                        if ('TimelineTwitterList' === $content['itemContent']['itemType']) {
                            $li = $ru = $content['itemContent']['list'];
                            $list = [
                                'id' => $li['id_str'],
                                'name' => $li['name'],
                                'description' => $li['description'],
                                'mode' => $li['mode'],
                                'created_at' => $li['created_at'],
                                'member_count' => $li['member_count'],
                                'follower_count' => $li['subscriber_count'],
                            ];
                            if ($list) {
                                array_push($lists, $list);
                            }
                        }

                        // tweets
                        if ('TimelineTweet' === $content['itemContent']['itemType']) {
                            $tweet = $this->parseTweetResults($content['itemContent']['tweet_results']);
                            if ($tweet) {
                                array_push($tweets, $tweet);
                            }
                        }
                    }
                }
            }

            return [
                'tweets' => $tweets,
                'users' => $users,
                'lists' => $lists,
                'meta' => $meta,
            ];
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function parseUserResults($results)
    {
        try {
            if (empty($results)) {
                return [];
            }
            $result = $results['result'];
            if ('User' !== $result['__typename']) {
                return [];
            }
            $ru = $result['legacy'];
            $ruId = $result['rest_id'];
            $user = [
                'id' => $ruId,
                'name' => $ru['name'],
                'username' => $ru['screen_name'],
                'description' => $ru['description'],
                'verified' => $ru['verified'],
                'location' => $ru['location'],
                'created_at' => $ru['created_at'],
                'profile_image_url' => $ru['profile_image_url_https'],
                'public_metrics' => [
                    'followers_count' => $ru['followers_count'],
                    'following_count' => $ru['friends_count'],
                    'tweet_count' => $ru['statuses_count'],
                    'listed_count' => $ru['listed_count'],
                    'like_count' => $ru['favourites_count'],
                ],
            ];

            return $user;
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function parseTweetResults($tweetResults)
    {
        try {
            if (empty($tweetResults)) {
                return [];
            }
            $result = $tweetResults['result'];
            if (empty($result)) {
                return [];
            }
            if ('Tweet' !== $result['__typename']) {
                return [];
            }
            $user = $this->parseUserResults($result['core']['user_results']);
            $remote = $result['legacy'];
            $tweet = [
                'id' => $remote['id_str'],
                'author_id' => $remote['user_id_str'],
                'author_name' => $user['name'],
                'author_username' => $user['username'],
                'text' => $remote['full_text'],
                'created_at' => $remote['created_at'],
                'retweet_count' => $remote['retweet_count'],
                'reply_count' => $remote['reply_count'],
                'like_count' => $remote['favorite_count'],
                'quote_count' => $remote['quote_count'],
                'self_thread' => (isset($remote['self_thread']['id_str']) && $remote['self_thread']['id_str']) ? $remote['self_thread']['id_str'] : 0,

                'lang' => $remote['lang'],
            ];

            if (isset($remote['retweeted_status_result']) && $remote['retweeted_status_result']) {
                $tw['referenced_tweet_id'] = $remote['retweeted_status_result']['result']['legacy']['id_str'];
            }

            if (isset($remote['entities'])) {
                $tweet['entities'] = $remote['entities'];
            }

            return $tweet;
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
