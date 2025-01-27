<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use DB;

class SubscriptionHistoryExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // If you want to include related user data, you could use:
        $subscriptionHistories = DB::table('subscription_hestory')
            ->leftjoin('subscriptions', 'subscriptions.id', '=', 'subscription_hestory.subsciption_id')
            ->leftjoin('users', 'subscription_hestory.user_id', '=', 'users.id')
            ->select(
                'subscription_hestory.*',
                'users.fullname',
                'users.email',
                'subscriptions.title',
                'users.mobile_number'
            )
            ->get();
        return $subscriptionHistories->map(function ($history) {
            return [
                'fullname' => $history->fullname,
                'email' => $history->email,
                'mobile_number' => $history->mobile_number,
                'created_at' => $history->created_at,
                'subscription_title' => $history->title,
                'amount' => $history->amount,
            ];
        });
    }




    public function headings(): array
    {
        return [
            'Username',
            'Email',
            'Contact Number',
            'Purchase Date',
            'Subscription Type',
            'Amount',
        ];
    }
}
