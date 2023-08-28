<?php

namespace App\Jobs;

use App\Mail\Verification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $datas;

    /**
     * Create a new job instance.
     */
    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->datas['email'])->send(new Verification($this->datas));
    }
}
