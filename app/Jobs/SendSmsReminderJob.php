<?php

// namespace App\Jobs;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Http;

// class SendSmsReminderJob implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected $phoneNumber;
//     protected $patientName;

//     public function __construct($phoneNumber, $patientName)
//     {
//         $this->phoneNumber = $phoneNumber;
//         $this->patientName = $patientName;
//     }

//     public function handle()
//     {
//         $message = "Hello {$this->patientName}, this is a reminder of your appointment in 5 minutes.";

//         Http::timeout(15)->post('https://semaphore.co/api/v4/messages', [
//             'apikey' => '046125f45f4f187e838905df98273c4e',
//             'number' => $this->phoneNumber,
//             'message' => $message,
//             'sendername' => 'KaisFrozen',
//         ]);
//     }

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendSmsReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phoneNumber;
    protected $patientName;
    protected $appointmentDateTime;

    public function __construct($phoneNumber, $patientName, $appointmentDateTime)
    {
        $this->phoneNumber = $phoneNumber;
        $this->patientName = $patientName;
        $this->appointmentDateTime = $appointmentDateTime;
    }

    public function handle()
    {
        $formattedDateTime = \Carbon\Carbon::parse($this->appointmentDateTime)->format('F j, Y \a\t g:i A');

        $message = "Hello {$this->patientName}, this is a reminder of your appointment scheduled on {$formattedDateTime}.";

        Http::timeout(15)->post('https://semaphore.co/api/v4/messages', [
            'apikey' => '046125f45f4f187e838905df98273c4e',
            'number' => $this->phoneNumber,
            'message' => $message,
            'sendername' => 'KaisFrozen',
        ]);
    }
}


