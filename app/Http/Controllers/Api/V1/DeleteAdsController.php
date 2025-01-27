<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoAds;
use carbon\carbon;

class DeleteAdsController extends Controller
{
    public function deleteAds(Request $request)
    {
        // Calculate the date 24 hours ago
        $twentyFourHoursAgo = Carbon::now()->subHours(24);
        // Fetch records older than 24 hours
        $adsToDelete = VideoAds::where('created_at', '<=', $twentyFourHoursAgo)->get();

        // Perform deletion
        foreach ($adsToDelete as $ad) {
            $ad->delete();
        }

        // Optionally, you can return a response indicating success or any other relevant information
        return response()->json(['message' => 'Ads older than 24 hours deleted successfully']);
    }
}
