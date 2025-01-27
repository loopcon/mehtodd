<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\ProfileAds;
use Carbon\Carbon;

class UpdateUserAdsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:user_ads_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users.is_ads to 0 if 24 hours have passed since profile_ads.create_at';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('is_ads', '=', '1')
            ->whereHas('profileAds', function ($query) {
                $query->where('created_at', '<=', Carbon::now()->subHours(24));
            })->get();

        if (count($users) > 0) {
            $ids = $users->pluck('id');
            User::whereIn('id', $ids)->update(['is_ads' => '0']);
            ProfileAds::whereIn('user_id', $ids)->delete();
        };
        $this->info('User ads status updated successfully.');
        return true;
    }
}
