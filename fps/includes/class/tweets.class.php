<?php

namespace Redwire;

require_once RW_LIB . '/twitteroauth/autoload.php';

class Tweets
{
    /** Twitter widget IDs **/
    public $consumer_key = 'QnrSgl5E7JuQu1FkrmxN1BrJ4';
    public $consumer_secret = 'aclfS3PVrX86QZG5uFod4y7B5eFP21qHYvA4edU9sbVdPNR6dv';
    public $access_token = '1377265315-4dSbIxSnZMvtKYgGKL4Sgc14DlpEtva94TnAr5a';
    public $access_token_secret = 'fbXABPC3p9Wio9MXNVo6SEdRzHkliJHdcre1dB8BYz8wt';

    /**
	***	Get the last tweet
	**/
	public function format_tweet( $tweet )
    {
		$tweet = preg_replace("/[[:alpha:]]+:\/\/[^<>[:space:]]+[[:alnum:]\/]/","<a target='_blank' href=\"\\0\">\\0</a>",  $tweet->text);
        $tweet = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1<a target="_blank" href="https://twitter.com/search?q=%23\2&src=hash">#\2</a>', $tweet);
        $tweet = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a target="_blank" href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet );

        return $tweet;
	}

    /*
    *   Get latest tweets
    */
	public function get_tweet( $quantity )
    {

        $connection = new \Abraham\TwitterOAuth\TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);

		$tweets = $connection->get('statuses/user_timeline', array('count' => $quantity, 'require_once_rts' => false, 'exclude_replies' => true ));

        //PING TWITTER
        $url = 'https://twitter.com/';
        if($url == NULL) return false;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpcode>=200 && $httpcode<300)
        {
    		$final_tweet = array();
    		foreach($tweets as $tweet)
            {
                $final = $this->format_tweet( $tweet );
                $date = strtotime($tweet->created_at);
                $time = date('G', $date) . 'h';

    			array_push( $final_tweet, array('time' => $time, 'tweet' => $final) );
    		}
        } else {
            $final_tweet = '<p>No tweets. Twitter is currently down.</p>';
        }

		return $final_tweet;
	}
}
