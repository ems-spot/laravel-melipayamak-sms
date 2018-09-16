# laravel-melipayamak-sms


> An unofficial integration of the melipayamak sms library for laravel 5.



## Code Example

    public function toSms($notifiable)
    {
        return (new SMS)
            ->text(__('sms.activation_code', ['code' => $this->activation_code]))
            ->to($notifiable->phone)
            ->sendText();
    }

    public function via($notifiable)
    {
        return ['EmsSpot\Melipayamak\SMS'];
    }

## Installation
    in .env:
    
    MELIPAYAMAK_USERNAME= 
    MELIPAYAMAK_PASSWORD= 
    MELIPAYAMAK_FROM= 
    
    in command line:
    
    php artisan vendor:publish EmsSpot\Melipayamak\MelipayamakServiceProvider

## License

WTF

