<?php
namespace EmsSpot\Melipayamak;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;
class SMS
{
	protected $recipient;
	protected $msg;
	public function send($notifiable, Notification $notification)
	{
		$message = $notification->toSms($notifiable);
	}

	public function to($recipient)
	{
		if (config('laravel-melipayamak-sms.debug')) {
			$this->recipient = config('laravel-melipayamak-sms.debug_recipient_number');
		} else {
			$this->recipient = $recipient;
		}
		return $this;
	}

	public function text($msg)
	{
		$this->msg = $msg;
		return $this;
	}

	public function sendText()
	{
		\Log::info('sending text message (sms)',[
			'to'           => $this->recipient,
			'message'      => $this->msg,
		]);

		$url = \Config::get('laravel-melipayamak-sms.url');
		$data = [
			'UserName' 	=> \Config::get('laravel-melipayamak-sms.username'),
			'PassWord' 	=> \Config::get('laravel-melipayamak-sms.password'),
			'From' 		=> \Config::get('laravel-melipayamak-sms.from'),
			'To' 		=> $this->recipient,
			'Text' 		=> $this->msg,
			// 'IsFlash' 	=> $isFlash
		];
		
		return $this->execute($url, $data);
	}

	protected function execute($url, $data = null)
	{		
		$client = new Client();
		$response = $client->post($url, $data);

		\Log::info('message has been sent');
		return $response;
	}
}