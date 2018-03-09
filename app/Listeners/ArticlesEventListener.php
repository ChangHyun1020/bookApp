<?php

namespace App\Listeners;

//use App\Events\aricle.created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticlesEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  aricle.created  $event
     * @return void
     */
    public function handle(\app\Events\ArticlesEvent $event)
    {
        if($event->action === 'created') {
            \Log::info(sprintf(
                '새로운 포럼이 등록되었습니다. : %s',
                $event->article->title
            ));
        }
        // dump('이벤트를 받았습니다. 받은 데이터(상태)입니다.');
        // dump($event->article->toArray());
    }
}
