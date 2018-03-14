<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsersEventListener
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_login = \Carbon\Carbon::now();

        return $event->user->save();
    }

    public function subscribe(\Illuminate\Events\Dispatcher $events)
    {
        // 코드 23-15
        // $events->listen() 구문을 여러 개 써서 이벤트와 처리 로직을 연결할 수 있습니다.
        $events->listen(
            \App\Events\UserCreated::class,
            __CLASS__ . '@onUserCreated'
        );

        // // 코드 23-30
        // $events->listen(
        //     \App\Events\PasswordRemindCreated::class,
        //     __CLASS__ . '@onPasswordRemindCreated'
        // );
    }

    public function onUserCreated(\App\Events\UserCreated $event)
    {
        $user = $event->user;
        $view = 'emails.'.app()->getLocale().'.auth.confirm';

        \Mail::send('emails.auth.confirm', compact('user'), function ($message) use ($user) {
            $message->to($user->email);
            $message->subject(
                sprintf('[%s] 회원 가입을 확인해 주세요.', config('app.name'))
            );
        });
    }
}
