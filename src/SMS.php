<?php
namespace EmsSpot\Melipayamak;
use Illuminate\Notifications\Notification;
use Melipayamak;
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
		$this->recipient = $recipient;
//		if (config('laravel-melipayamak-sms.debug')) {
//			$this->recipient = config('laravel-melipayamak-sms.debug_recipient_number');
//		} else {
//
//		}
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
			// 'username' 	=> \Config::get('laravel-melipayamak-sms.username'),
			// 'password' 	=> \Config::get('laravel-melipayamak-sms.password'),
			// 'from' 		=> \Config::get('laravel-melipayamak-sms.from'),
			'to' 		=> $this->recipient,
			'text' 		=> $this->msg
		];
		
		return $this->execute($url, $data);
	}

	protected function execute($url, $data = null)
	{
        try {
            $sms = Melipayamak::sms();
            $response = $sms->send($data['to'], $data['from'], $data['text']);
            $json = json_decode($response);
            \Log::debug($json->Value);

        } catch(Exception $e) {
            echo $e->getMessage();
        }

		\Log::info('message has been sent');
		return $response;
	}
}