<?php

namespace App\Console\Commands;

use App\Models\absen;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CekAbsen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cek-absen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $today = Carbon::today();

        foreach ($users as $user) {
            $absenToday = Absen::where('user_id', $user->id)
                                ->whereDate('created_at', $today)
                                ->whereTime('created_at', '<', '08:00:00')
                                ->exists();
            
            if (!$absenToday) {
                $user->skor -= 5;
                $user->save();
            }
        }

        $this->info('Skor pengguna yang tidak absen hari ini berhasil dikurangi.');
    }
}
