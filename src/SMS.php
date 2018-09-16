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
        return $this;
    }

    public function speech($speech)
    {
        $this->speech = $speech;
        return $this;
    }

    public function sendText()
    {
        \Log::info('sending text message',[
            'to'           => $this->recipient,
            'message'      => $this->msg,
        ]);

        $data = [
            'from'      => \Config::get('melipayamak.from'),
            'to'        => $this->recipient,
            'text'      => $this->msg,
        ];

        try {
            $sms = Melipayamak::sms();
            $response = $sms->send($data['to'], $data['from'], $data['text']);
            \Log::debug($response);
        }catch(Exception $e) {
            echo $e->getMessage();
        }

        \Log::info('message has been sent');
        return $response;
    }

    public function sendSpeech()
    {
        \Log::info('sending text and speech message',[
            'to'           => $this->recipient,
            'message'      => $this->msg,
            'speech'      => $this->speech,
        ]);

        $data = [
            'from'      => \Config::get('melipayamak.from'),
            'to'        => $this->recipient,
            'text'      => $this->msg,
            'speech'    => $this->speech,
            'scaduleDate' => \Carbon\Carbon::now()->addSeconds(3)->format('Y-m-d\Th:m:s'),
        ];
        try {
            $sms = Melipayamak::sms('soap');
            $response = $sms->sendWithSpeechSchduleDate($data['to'], $data['from'], $data['text'], $data['speech'], $data['scaduleDate']);
            \Log::debug($response);
        }catch(Exception $e) {
            echo $e->getMessage();
        }

        \Log::info('message has been sent');
        return $response;
    }

    public function sendSpeechAfterTwoMinutesIfFailed()
    {
        \Log::info('sending text and speech message',[
            'to'           => $this->recipient,
            'message'      => $this->msg,
            'speech'      => $this->speech,
        ]);

        $data = [
            'from'      => \Config::get('melipayamak.from'),
            'to'        => $this->recipient,
            'text'      => $this->msg,
            'speech'    => $this->speech,
        ];
        try {
            $sms = Melipayamak::sms('soap');
            $response = $sms->sendWithSpeech($data['to'], $data['from'], $data['text'], $data['speech']);
            \Log::debug($response);
        }catch(Exception $e) {
            echo $e->getMessage();
        }

        \Log::info('message has been sent');
        return $response;
    }
}