<?php

declare(strict_types=1);

namespace EmsSpot\Melipayamak;

use Illuminate\Notifications\Notification;
use Log;
use Melipayamak;

final class SMS
{
    /**
     * @var
     */
    private $recipient;
    /**
     * @var
     */
    private $msg;
    /**
     * @var
     */
    private $speech;

    public function send(object $notifiable, Notification $notification): void
    {
        $notification->toSms($notifiable);
    }

    public function to(string $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function text(string $msg): self
    {
        $this->msg = $msg;

        return $this;
    }

    public function speech(string $speech): self
    {
        $this->speech = $speech;

        return $this;
    }

    /**
     * @return false|string
     */
    public function sendText()
    {
        Log::info('sending text message', [
            'to' => $this->recipient,
            'message' => $this->msg,
        ]);

        $data = [
            'from' => Config::get('melipayamak.from'),
            'to' => $this->recipient,
            'text' => $this->msg,
        ];

        return $this->handleResponse($data);
    }

    /**
     * @param string[]
     *
     * @return false|string
     */
    public function handleResponse(array $data, string $type = 'text')
    {
        try {
            $username = config('melipayamak.username');
            $password = config('melipayamak.password');
            if (empty($username) || empty($password)) {
                Log::error('Username or password is empty for melipayamak');

                return json_encode([
                    'status' => 'error',
                    'message' => 'Username or password is empty for sms driver',
                ]);
            }

            if ('speech' === $type) {
                $sms = Melipayamak::sms('soap');
                $response = $sms->sendWithSpeechSchduleDate($data['to'], $data['from'], $data['text'], $data['speech'], $data['scaduleDate']);
            } else {
                $sms = Melipayamak::sms();
                $json_response = $sms->send($data['to'], $data['from'], $data['text']);
            }

            Log::debug($json_response);
            Log::info('message has been sent');
            $response = json_decode($json_response, true);
            if ('Ok' === $response['StrRetStatus']) {
                return json_encode([
                    'status' => 'success',
                    'message' => 'Sms successfully sent.',
                ]);
            }

            return json_encode([
                'status' => 'error',
                'message' => 'Sms failed with code: '.$response['RetStatus'].' - '.$response['StrRetStatus'],
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @return false|string
     */
    public function sendSpeech()
    {
        Log::info('sending text and speech message', [
            'to' => $this->recipient,
            'message' => $this->msg,
            'speech' => $this->speech,
        ]);

        $data = [
            'from' => Config::get('melipayamak.from'),
            'to' => $this->recipient,
            'text' => $this->msg,
            'speech' => $this->speech,
            'scaduleDate' => Carbon::now()->addSeconds(3)->format('Y-m-d\Th:m:s'),
        ];

        return $this->handleResponse($data, 'speech');
    }
}
