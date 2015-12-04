<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
</head>
<body>
<?php
require_once ('phirehose/lib/Phirehose.php');
require_once ('phirehose/lib/OauthPhirehose.php');

/**
 * Example of using Phirehose to display a live filtered stream using track words
 */
class FilterTrackConsumer extends OauthPhirehose {
	private $tweet_count = 0;
	/**
	 * Enqueue each status
	 *
	 * @param string $status        	
	 */
	public function enqueueStatus($status) {
		/*
		 * In this simple example, we will just display to STDOUT rather than enqueue. NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being enqueued and processed asyncronously from the collection process.
		 */
		$data = json_decode ( $status, true );
		if (is_array ( $data ) && isset ( $data ['user'] ['screen_name'] )) {
			echo "<li>";
			$date = explode ( " ", $data ['created_at'] );
			$heure = explode ( ":", $date [3] );
			switch ($date [1]) {
				case "Jan" :
					$mois = "01";
					break;
				case "Feb" :
					$mois = "02";
					break;
				case "Mar" :
					$mois = "03";
					break;
				case "Apr" :
					$mois = "04";
					break;
				case "May" :
					$mois = "05";
					break;
				case "Jun" :
					$mois = "06";
					break;
				case "Jul" :
					$mois = "07";
					break;
				case "Aug" :
					$mois = "08";
					break;
				case "Sep" :
					$mois = "09";
					break;
				case "Oct" :
					$mois = "10";
					break;
				case "Nov" :
					$mois = "11";
					break;
				default :
					$mois = "12";
					break;
			}
			echo $date [2] . "/" . $mois . "/" . $date [5] . " " . $heure [0] . "h" . $heure [1] . " ";
			echo $data ['user'] ['screen_name'] . ': ';
			
			$text = $data ['text'];
			$substr = explode ( " ", $text );
			foreach ( $substr as $http ) {
				if (strstr ( $http, "http" )) {
					$link = "<a href=\"" . $http . "\">" . $http . "</a><BR/>";
					$text = str_replace ( $http, $link, $text );
				}
			}
			echo $text;
			
			if (! empty ( $data ['user'] ['location'] )) {
				echo "<BR/>" . $data ['user'] ['location'];
			}
			echo "</p><BR/>";
			$this->tweet_count += 1;
			echo "</li>";
		}
		if ($this->tweet_count >= 5) {
			echo "</ul></body></html>";
			exit ();
		}
	}
}

// The OAuth credentials you received when registering your app at Twitter
define ( "TWITTER_CONSUMER_KEY", "fxPiWdMXW0oHk9OLwIavMn3ns" );
define ( "TWITTER_CONSUMER_SECRET", "eCRPfxT3bRG490KWPcbpO6F1RX4FdXCW8c9HquFxOCsCTP2dPH" );

// The OAuth data for the twitter account
define ( "OAUTH_TOKEN", "763684332-g2P4tnD0xlXzwOc4cZFILrPkIUXOuU5PTiXMD2S6" );
define ( "OAUTH_SECRET", "sIFafoYoFchI8KF4i3QSOXPzvi4L63lvnv2HRTtnz8pQP" );

// Start streaming
$sc = new FilterTrackConsumer ( OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER );
$sc->setTrack ( array (
		'nuitinfo' 
) );
echo "<ul>";
$sc->consume ();
?>