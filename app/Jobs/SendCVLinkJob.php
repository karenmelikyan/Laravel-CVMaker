<?php

namespace App\Jobs;

use App\DataRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCVLinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use DataRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**  for data from `queue` table*/
        $this->tableName = 'queue';

        /** set job for queue process*/
        $this->onQueue('mail_sending');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {



//        $objArr = $this->getAll();
//        foreach($objArr as $elem){
//            mail($elem->email, 'CV Maker notification',
//                "You created CV via `CV Maker` <a href=" . $elem->cv_path . ">Your Cv<" . "/a>");
//
//            $this->deleteOneById($elem->id);
//        }
    }

}
