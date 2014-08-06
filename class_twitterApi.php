<?php
class twitterApi {
	private $ConsumerKey = '____';
	private $ConsumerSecret = '____';

	private $connection = null;
	private $accessTokens = null;

	private function connect($oauth_token, $oauth_token_secret) {
		if(func_num_args() == 0) 
			$this->connection = new TwitterOAuth($this->ConsumerKey, $this->ConsumerSecret);
		else
			$this->connection = new TwitterOAuth($this->ConsumerKey, $this->ConsumerSecret, $oauth_token, $oauth_token_secret);
	}

	public function oauthRedirect($loginWithTwitter) {
		if (session_status() == PHP_SESSION_NONE) session_start();

		connect();
		$request_token = $this->connection->getRequestToken();

		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

		$url = $connection->getAuthorizeURL($request_token['oauth_token'], $loginWithTwitter);

		header('Location: '.$url);
	}

	public function oauthProcessCallback($oauth_verifier) {
		if (session_status() == PHP_SESSION_NONE) session_start();

		connect($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

		$accessTokens = $this->$connection->getAccessToken($oauth_verifier);

		return $connection->http_code;
	}

	public function getAccessToken() {
		return $accessTokens;
	}

	public function get($apiUrl, $parameters) {
		return $this->connection->get($apiUrl, $parameters);
	}

	public function post($apiUrl, $parameters) {
		return $this->connection->post($apiUrl, $parameters);
	}
}
?>
