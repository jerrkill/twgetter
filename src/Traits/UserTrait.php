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

trait UserTrait
{
    // use ParseTrait;

    public function getUserTweets(int $userId, int $count = 10, string $page = null)
    {
        $path = 'graphql/d5UzUAEWLvAi5HU8stUlXw/UserTweets';
        $variables = [
            'userId' => $userId,
            'count' => $count,
            'includePromotedContent' => true,
            'withQuickPromoteEligibilityTweetFields' => true,
            'withSuperFollowsUserFields' => true,
            'withDownvotePerspective' => false,
            'withReactionsMetadata' => false,
            'withReactionsPerspective' => false,
            'withSuperFollowsTweetFields' => true,
            'withVoice' => false,
            'withV2Timeline' => true,
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

        return $this->parseUserTweetsResponse($this->get($path, $params));
    }

    public function parseUserTweetsResponse($response)
    {
        try {
            return $this->parseTimeline($response['data']['user']['result']['timeline_v2']['timeline']);
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getUserFollowing(int $userId, int $count = 10, string $page = null)
    {
        $path = 'graphql/ih3I-XV0ogyWjqsHqFQ9eA/Following';
        $variables = [
            'userId' => $userId,
            'count' => $count,
            'includePromotedContent' => true,
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
            'standardized_nudges_misinfo' => false,
            'responsive_web_enhance_cards_enabled' => false,
        ];
        if (null !== $page) {
            $variables['cursor'] = $page;
        }
        $params = [
            'variables' => \json_encode($variables),
            'features' => \json_encode($features),
        ];

        return $this->parseUserFollowingResponse($this->get($path, $params));
    }

    public function parseUserFollowingResponse($response)
    {
        $users = [];
        try {
            $users = $this->parseTimeline($response['data']['user']['result']['timeline']['timeline']);

            return $users;
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getUserFollowers(int $userId, int $count = 20, string $page = null)
    {
        $path = 'graphql/ysj_6Bszzl-X7e4bmvYpBA/Followers';
        $variables = [
            'userId' => $userId,
            'count' => $count,
            'includePromotedContent' => false,
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
            'standardized_nudges_misinfo' => false,
            'responsive_web_enhance_cards_enabled' => false,
        ];
        if (null !== $page) {
            $variables['cursor'] = $page;
        }
        $params = [
            'variables' => \json_encode($variables),
            'features' => \json_encode($features),
        ];

        return $this->parseUserFollowersResponse($this->get($path, $params));
    }

    public function parseUserFollowersResponse($response)
    {
        $users = [];
        try {
            $users = $this->parseTimeline($response['data']['user']['result']['timeline']['timeline']);

            return $users;
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getUserLists(int $userId, int $count = 10, string $page = null)
    {
        $path = 'graphql/nzPbVEpjCRdwPadJw9IR8g/CombinedLists';

        $variables = [
            'userId' => $userId,
            'count' => $count,
            'includePromotedContent' => true,
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
            'standardized_nudges_misinfo' => false,
            'responsive_web_enhance_cards_enabled' => false,
        ];
        if (null !== $page) {
            $variables['cursor'] = $page;
        }
        $params = [
            'variables' => \json_encode($variables),
            'features' => \json_encode($features),
        ];

        return $this->parseUserListsResponse($this->get($path, $params));
    }

    public function parseUserListsResponse($response)
    {
        try {
            return $this->parseTimeline($response['data']['user']['result']['timeline']['timeline']);
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getUserByUsername($username)
    {
        $path = 'graphql/mCbpQvZAw6zu_4PvuAUVVQ/UserByScreenName';
        $variables = [
            'screen_name' => $username,
            'withSafetyModeUserFields' => true,
            'withSuperFollowsUserFields' => true,
        ];
        $params = [
            'variables' => \json_encode($variables),
        ];
        return $this->parseUserResponse($this->get($path, $params));
    }

    public function parseUserResponse($response)
    {
        try {
            $results['result'] = $response['data']['user']['result'];
            return $this->parseUserResults($results);
        } catch (\Exception $e) {
            throw new ParseException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
}
