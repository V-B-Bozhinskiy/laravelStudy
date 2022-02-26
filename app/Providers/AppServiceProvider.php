<?php

namespace App\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::before(function ( JobProcessing $event ) {
            Log::info('Job ready: ' . $event->job->resolveName());
            Log::info('Job started: ' . $event->job->resolveName());
         });
          
         Queue::after(function ( JobProcessed $event ) {
            Log::notice('Job done: ' . $event->job->resolveName());
            Log::notice('Job payload: ' . print_r($event->job->payload(), true));
         });
          
         Queue::failing(function ( JobFailed $event ) {
            session()->flash("Error with {$event->job->resolveName()}");
            Log::error('Job failed: ' . 
                        $event->job->resolveName() . 
                       '(' . $event->exception->getMessage() . ')'
                       );
         });
    }
}
