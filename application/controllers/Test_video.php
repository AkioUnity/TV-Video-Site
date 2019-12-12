<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Vimeo\Vimeo;
class Test_video extends Frontend_Controller {
	public $client_id = '1d652a83b5a2c1e8572139a8911951c506e15667';
	public $client_secret = 'xjPeY0As6Y6BJbm4pfXumf4ptI5xAij7GPpXsII99bTUqP6cIAyHLUeaJvrlnn+Hde3foO2nVKLAyHqwokOYVaWGDpv5oY4nixINsLKMHZelLNxd2q+G7Mzn6smkwo35';
	public $token = '4778beeff3f518b34703507748e0fdd9';
	public function __construct(){
		parent::__construct();
	}

	
	public function c(){
		$lib = new Vimeo($client_id, $client_secret);
		$client = new Vimeo($client_id, $client_secret, $this->token);
		$response = $client->request('/tutorial', array(), 'GET');
		printR($response);
	}

	public function c_2(){
		$lib = new Vimeo($this->client_id, $this->client_secret);
		$token = $lib->clientCredentials('public');
		// usable access token
		printR($token['body']);
		$lib->setToken($token['body']['access_token']);
	}
	public function video(){
		$lib = new Vimeo($this->client_id, $this->client_secret, $this->token);
		$token = $lib->clientCredentials('public');
		$lib->setToken($token['body']['access_token']);
/*		$token = $lib->clientCredentials('scope');
		$lib->setToken($token['body']['access_token']);*/
//		$response = $lib->upload('/home/aaron/Downloads/ada.mp4');
		// With parameters.
		$response = $lib->upload('./assets/uploads/channels/sample.mp4', array(
			'name' => 'Ada',
			'privacy' => array('view' => 'anybody')));
	}
}

