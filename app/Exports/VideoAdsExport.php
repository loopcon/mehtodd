<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoAds;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use DB;

class VideoAdsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VideoAds::with(['user', 'video'])
            ->select('id', 'user_id', 'video_id', 'amount', 'created_at')
            ->get()
            ->map(function ($videoAds) {
                // Retrieve the associated user and video using Eloquent relationships
                $user = $videoAds->user;  // Assuming you have a 'user' relationship in VideoAds
                $video = $videoAds->video;  // Assuming you have a 'video' relationship in VideoAds

                return [
                    'id' => $videoAds->id,
                    'fullname' => $user ? $user->fullname : 'N/A',
                    'mobile_number' => $user ? $user->mobile_number : 'N/A',
                    'title' => $video ? $video->title : 'N/A',
                    'created_at' => $videoAds->created_at,
                    'amount' => $videoAds->amount,
                ];
            });
    }




    public function headings(): array
    {
        return [
            'Order Id',
            'Username',
            'Contact Number',
            'Title',
            'Purchase Date',
            'Amount',
        ];
    }
}
