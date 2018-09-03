<?php
namespace EmsSpot\Melipayamak;
use Illuminate\Notifications\Notification;
use Melipayamak;
class SMS
{
	protected $recipient;
    protected $msg;
    protected $speech;
	public function send($notifiable, Notification $notification)
	{
		$message = $notification->toSms($notifiable);
	}

	public function to($recipient)
	{
		$this->recipient = $recipient;
		return $this;
	}

	public function text($msg)
	{
		$this->msg = $msg;
        $this->speech = $msg;
		return $this;
	}

    public function speech($speech)
    {
        $this->speech = $speech;
        return $this;
    }

	public function sendText()
	{
		\Log::info('sending text message (sms)',[
			'to'           => $this->recipient,
			'message'      => $this->msg,
		]);

		$data = [
			'from' 		=> \Config::get('laravel-melipayamak-sms.from'),
			'to' 		=> $this->recipient,
			'text' 		=> $this->msg
		];
		
		return $this->execute($data, 'text');
	}

    public function sendSpeech()
    {
        \Log::info('sending text and speech message',[
            'to'           => $this->recipient,
            'message'      => $this->msg,
            'speech'      => $this->speech,
        ]);

        $data = [
            'from' 		=> \Config::get('laravel-melipayamak-sms.from'),
            'to' 		=> $this->recipient,
            'text' 		=> $this->msg,
            'speech' 	=> $this->speech,
        ];

        return $this->execute($data, 'speech');
    }

	protected function execute($data = null, $type = 'text')
	{
        try {
            if($type == 'text'){
                $sms = Melipayamak::sms();
                $response = $sms->send($data['to'], $data['from'], $data['text']);
                $json = json_decode($response);
                \Log::debug($json->Value);
            }elseif($type == 'speech'){
                $sms = Melipayamak::sms('soap');
                $response = $sms->sendWithSpeech($data['to'], $data['from'], $data['text'], $data['speech']);
                \Log::debug($response);
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }

		\Log::info('message has been sent');
		return $response;
	}
}