<?php

namespace App\Console;

use App\Models\ActionHistory;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $actionHistories = ActionHistory::where('status', 'pending')->lockForUpdate()->get();

            foreach ($actionHistories as $actionHistory) {
                // get current point of user
                $currentPoint = $actionHistory->user->getCurrentPoint->lockForUpdate()->first();

                DB::transaction(function () use ($currentPoint, $actionHistory) {
                    //このifはクロンタブで８０％アクションを承認する。これはただ例です。現在承認の要件は決まっていませんので。
                    if (random_int(1, 5) == 5) {
                        //update current point for user
                        $currentPoint->update([
                            'reject_point' => ($currentPoint->reject_point + $actionHistory->point_num),
                            'pending_point' => ($currentPoint->pending_point - $actionHistory->point_num)
                        ]);

                        $actionHistory->update(['status' => 'reject']);
                    } else {
                        //update current point for user
                        $currentPoint->update([
                            'approval_point' => ($currentPoint->approval_point + $actionHistory->point_num),
                            'pending_point' => ($currentPoint->pending_point - $actionHistory->point_num)
                        ]);

                        $actionHistory->update(['status' => 'approval']);
                    }
                });
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
