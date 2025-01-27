<?php

namespace App\Http\Controllers;

use App\Mail\SampleMailable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use carbon\carbon;
use App\Models\Information;
use App\Models\Newsletter;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Client;
use App\Models\Difficulty;
use App\Models\Follower;
use App\Models\Following;
use App\Models\Service;
use App\Models\SubscriptionDescription;
use App\Models\Tag;
use App\Models\Page;
use App\Models\UserEducationDetail;
use App\Models\UserOtp;
use App\Models\UserProfessionalDetail;
use App\Models\UserService;
use App\Models\UserTag;
use App\Models\Sport;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUploadTrait;
use Doctrine\DBAL\Schema\View;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\UserCategory;
use App\Models\Like;
use App\Models\PrivateVideoUser;
use App\Models\UserDocument;
use App\Models\UserVideoCategory;
use App\Models\UserSlider;
use App\Models\VideoView;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use App\Models\Ads;
use App\Models\Lesson;
use App\Models\VideoAds;
use App\Models\VideoSport;
use App\Models\UserSport;
use App\Models\PrivateLessonUser;
use App\Models\UserLike;
use App\Models\UserCalender;
use App\Models\MeetingUser;
use App\Models\MaliciousProfile;
use App\Models\MaliciousVideo;
use App\Models\Notification;
use App\Models\SubscriptionHestory;
use FFMpeg\FFMpeg;
use DB;

use App\Mail\WelcomeUser;
use App\Models\ProfileAds;

class FrontendController extends Controller
{

    function getLatLngFromAddress($address)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $apiKey;


        $response = file_get_contents($url);
        file_put_contents('geocode_response.json', $response);
        $data = json_decode($response, true);

        if ($data['status'] == 'OK') {
            $lat = $data['results'][0]['geometry']['location']['lat'];
            $lng = $data['results'][0]['geometry']['location']['lng'];
            return ['lat' => $lat, 'lng' => $lng];
        } else {
            return null;
        }
    }


    // this is old org code
    public function ProfessionalList(Request $request)
    {
        $allSelectIds = $request->select_categories;
        $return_data = [];
        $return_data['site_title'] = 'Professionals';
        $query = User::where('role_id', "2")
            ->orderBy('is_ads', 'desc');
        $address = $request->address;
        $words = preg_split('/\s+/', trim($address));
        $user = auth()->user();


        if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
            $categoryIds = array_map('intval', $allSelectIds);
            $query->whereIn('user_category_id', $categoryIds);
        }
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('fullname', 'like', '%' . $searchTerm . '%')
                    ->orWhere('slug', 'like', '%' . $searchTerm . '%')
                    ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($address != null) {
            $location = $this->getLatLngFromAddress($address);
            if ($location) {
                $latitude = $location['lat'];
                $longitude = $location['lng'];

                $query->selectRaw("
                    *,
                    (3959 * acos(
                        cos(radians(?)) 
                        * cos(radians(JSON_EXTRACT(latlong, '$.latitude'))) 
                        * cos(radians(JSON_EXTRACT(latlong, '$.longitude')) - radians(?)) 
                        + sin(radians(?)) 
                        * sin(radians(JSON_EXTRACT(latlong, '$.latitude')))
                    )) AS distance_in_mi", [$latitude, $longitude, $latitude]);
                    
                    // Apply distance range filtering
                    if ($request->has('distance') && !empty($request->distance)) {
                        $distanceRange = explode("-", $request->distance);

                        if ($distanceRange[0] !== "") {
                            $query->having('distance_in_mi', '>=', (float)$distanceRange[0]);
                        }
                        if (isset($distanceRange[1]) && $distanceRange[1] !== "") {
                            $query->having('distance_in_mi', '<=', (float)$distanceRange[1]);
                        }
                    }

                    $query->orderBy('distance_in_mi');
            }
            // $latitude = $location['lat'];
            // $longitude = $location['lng'];

            // $query->whereRaw("ABS(JSON_EXTRACT(latlong, '$.latitude') - ?) <= ?", [$latitude, 0.1])
            //     ->whereRaw("ABS(JSON_EXTRACT(latlong, '$.longitude') - ?) <= ?", [$longitude, 0.1]);
            
            // $query->orWhere(function ($subQuery) use ($words) {
            //     // Matching city, state, and country
            //     if (count($words) >= 1) {
            //         $subQuery->where('city', 'like', '%' . $words[0] . '%');
            //     }

            //     if (count($words) >= 2) {
            //         $subQuery->where('state', 'like', '%' . $words[1] . '%');
            //     }

            //     if (count($words) >= 3) {
            //         $subQuery->where('country', 'like', '%' . $words[2] . '%');
            //     }
            // });
        } else if ($user != null && $address != null) {
            $logUserAddress = $user->latlong;
            if ($logUserAddress != null) {
                $logUserAddressArray = json_decode($logUserAddress, true);
                $userLatitude = $logUserAddressArray['latitude'];
                $userLongitude = $logUserAddressArray['longitude'];

                $query->selectRaw("
                    *,
                    (3959 * acos(
                        cos(radians(?)) 
                        * cos(radians(JSON_EXTRACT(latlong, '$.latitude'))) 
                        * cos(radians(JSON_EXTRACT(latlong, '$.longitude')) - radians(?)) 
                        + sin(radians(?)) 
                        * sin(radians(JSON_EXTRACT(latlong, '$.latitude')))
                    )) AS distance_in_mi", [$latitude, $longitude, $latitude]);
                    
                    // Apply distance range filtering
                    if ($request->has('distance') && !empty($request->distance)) {
                        $distanceRange = explode("-", $request->distance);

                        if ($distanceRange[0] !== "") {
                            $query->having('distance_in_mi', '>=', (float)$distanceRange[0]);
                        }
                        if (isset($distanceRange[1]) && $distanceRange[1] !== "") {
                            $query->having('distance_in_mi', '<=', (float)$distanceRange[1]);
                        }
                    }
                    $query->orderBy('distance_in_mi');

                // $query->whereRaw("ABS(JSON_EXTRACT(latlong, '$.latitude') - ?) <= ?", [$userLatitude, 0.1])
                //     ->whereRaw("ABS(JSON_EXTRACT(latlong, '$.longitude') - ?) <= ?", [$userLongitude, 0.1]);


                // $query->orWhere(function ($subQuery) use ($user) {
                //     $subQuery->where('city', 'like', '%' . $user->city . '%')
                //         ->orWhere('state', 'like', '%' . $user->state . '%')
                //         ->orWhere('country', 'like', '%' . $user->country . '%');
                // });

                // Use the BETWEEN clause to get the nearest latlongs and sort by proximity in descending order
                // $query->orderByRaw("CASE
                //                     WHEN ABS(JSON_EXTRACT(latlong, '$.latitude') - ?) <= 0.1
                //                          AND ABS(JSON_EXTRACT(latlong, '$.longitude') - ?) <= 0.1 THEN 0
                //                     WHEN city LIKE ? OR state LIKE ? OR country LIKE ? THEN 1
                //                     ELSE 2
                //                   END", [
                //     $userLatitude,
                //     $userLongitude,
                //     '%' . $user->city . '%',
                //     '%' . $user->state . '%',
                //     '%' . $user->country . '%'
                // ])
                //     ->orderByRaw("ABS(JSON_EXTRACT(latlong, '$.latitude') - ?) + ABS(JSON_EXTRACT(latlong, '$.longitude') - ?) DESC", [
                //         $userLatitude,
                //         $userLongitude
                //     ]);
            } else {
                $query;
            }
        }

        $professionals = $query->paginate(12);
        $return_data['professionals'] = $professionals;
        return view('frontend.professional-list', $return_data);
    }


    // public function ProfessionalList(Request $request)
    // {
    //     $allSelectIds = $request->select_categories;
    //     $return_data = [];
    //     $return_data['site_title'] = 'Professionals';

    //     $user = auth()->user();
    //     $address = $request->address;

    //     $location = $this->getLatLngFromAddress($address);
    //     if ($location) {
    //         $latlong = json_encode([
    //             'latitude' => $location['lat'],
    //             'longitude' => $location['lng']
    //         ]);
    //     } else {
    //         return response()->json(['error' => 'Unable to fetch location data'], 500);
    //     }

    //     $latlongData = json_decode($latlong, true);
    //     $latitude = $latlongData['latitude'];
    //     $longitude = $latlongData['longitude'];

    //     // When user is not logged in but address is provided
    //     if ($user == null && $address != null) {

    //         $query = User::where('role_id', "2")
    //             ->orderBy('is_ads', 'desc');

    //         // Handle optional filters
    //         if ($request->has('select_categories') && !empty($request->select_categories[0])) {
    //             $categoryIds = array_map('intval', $request->select_categories);
    //             $query->whereIn('user_category_id', $categoryIds);
    //         }

    //         if ($request->has('search') && !empty($request->search)) {
    //             $searchTerm = $request->search;
    //             $query->where(function ($q) use ($searchTerm) {
    //                 $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //             });
    //         }

    //         // Filter by latlong and proximity
    //         $query->whereRaw("ST_Distance_Sphere(
    //                             point(JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.longitude')), JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.latitude'))),
    //                             point(?, ?)
    //                         ) < 5000", [$longitude, $latitude]);

    //         $professionals = $query->paginate(12);
    //     }
    //     // else if (!empty($user->city) && !empty($user->state) && !empty($user->country)) {
    //     else if ($user != null && $address == null) {
    //         // Get user's address location
    //         $userAddress = $user->city . ', ' . $user->state . ', ' . $user->country;
    //         $userLatLng = $this->getLatLngFromAddress($userAddress);

    //         if ($userLatLng) {
    //             $query = User::where('role_id', "2")
    //                 ->orderBy('is_ads', 'desc');

    //             if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //                 $categoryIds = array_map('intval', $allSelectIds);
    //                 $query->whereIn('user_category_id', $categoryIds);
    //             }

    //             if ($request->has('search') && !empty($request->search)) {
    //                 $searchTerm = $request->search;
    //                 $query->where(function ($q) use ($searchTerm) {
    //                     $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //                 });
    //             }

    //             // Filter by latlong and proximity for the user's location
    //             $query->whereRaw("ST_Distance_Sphere(
    //                                 point(JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.longitude')), JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.latitude'))),
    //                                 point(?, ?)
    //                             ) < 5000", [$longitude, $latitude]);

    //             $professionals = $query->paginate(12);
    //         } else {
    //             return response()->json(['error' => 'Could not get user location'], 400);
    //         }
    //     }
    //     // When user is logged in but no address is provided
    //     else {
    //         // Fallback query when no address or city/state/country information is available
    //         $query = User::where('role_id', "2")
    //             ->orderBy('is_ads', 'desc');

    //         if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //             $categoryIds = array_map('intval', $allSelectIds);
    //             $query->whereIn('user_category_id', $categoryIds);
    //         }

    //         if ($request->has('search') && !empty($request->search)) {
    //             $searchTerm = $request->search;
    //             $query->where(function ($q) use ($searchTerm) {
    //                 $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //             });
    //         }

    //         // Filter by latlong and proximity for the fallback case
    //         $query->whereRaw("ST_Distance_Sphere(
    //                             point(JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.longitude')), JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.latitude'))),
    //                             point(?, ?)
    //                         ) < 5000", [$longitude, $latitude]);

    //         $professionals = $query->paginate(12);
    //     }

    //     $return_data['professionals'] = $professionals;
    //     return view('frontend.professional-list', $return_data);
    // }



    // aa code ma login user na latlong vada no locho chhe
    // public function ProfessionalList(Request $request)
    // {
    //     $allSelectIds = $request->select_categories;
    //     $return_data = [];
    //     $return_data['site_title'] = 'Professionals';

    //     $user = auth()->user();
    //     $address = $request->address;

    //     $location = $this->getLatLngFromAddress($address);
    //     if ($location) {
    //         $latlong = json_encode([
    //             'latitude' => $location['lat'],
    //             'longitude' => $location['lng']
    //         ]);
    //     } else {
    //         return response()->json(['error' => 'Unable to fetch location data'], 500);
    //     }

    //     $latlongData = json_decode($latlong, true);
    //     $latitude = $latlongData['latitude'];
    //     $longitude = $latlongData['longitude'];


    //     if ($user == null && $address != null) {

    //         $query = User::where('role_id', "2")
    //             ->orderBy('is_ads', 'desc');

    //         // Handle optional filters
    //         if ($request->has('select_categories') && !empty($request->select_categories[0])) {
    //             $categoryIds = array_map('intval', $request->select_categories);
    //             $query->whereIn('user_category_id', $categoryIds);
    //         }

    //         if ($request->has('search') && !empty($request->search)) {
    //             $searchTerm = $request->search;
    //             $query->where(function ($q) use ($searchTerm) {
    //                 $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //             });
    //         }

    //         $query->whereRaw("ST_Distance_Sphere(
    //                             point(JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.longitude')), JSON_UNQUOTE(JSON_EXTRACT(latlong, '$.latitude'))),
    //                             point(?, ?)
    //                         ) < 5000", [$longitude, $latitude]);

    //         $professionals = $query->paginate(12);

    //     } else if (!empty($user->city) && !empty($user->state) && !empty($user->country)) {
    //         $userAddress = $user->city . ', ' . $user->state . ', ' . $user->country;
    //         $userLatLng = $this->getLatLngFromAddress($userAddress);

    //         if ($userLatLng) {
    //             $query = User::where('role_id', "2")
    //                 ->orderBy('is_ads', 'desc');

    //             if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //                 $categoryIds = array_map('intval', $allSelectIds);
    //                 $query->whereIn('user_category_id', $categoryIds);
    //             }

    //             if ($request->has('search') && !empty($request->search)) {
    //                 $searchTerm = $request->search;
    //                 $query->where(function ($q) use ($searchTerm) {
    //                     $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('displayname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('city', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('state', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('country', 'like', '%' . $searchTerm . '%');
    //                 });
    //             }

    //             $query->orderByRaw("CASE
    //             WHEN city LIKE ? AND state LIKE ? AND country LIKE ? THEN 1
    //             WHEN city LIKE ? OR state LIKE ? OR country LIKE ? THEN 2
    //             ELSE 3
    //         END ASC", [
    //                 '%' . $user->city . '%',
    //                 '%' . $user->state . '%',
    //                 '%' . $user->country . '%',
    //                 '%' . $user->city . '%',
    //                 '%' . $user->state . '%',
    //                 '%' . $user->country . '%'
    //             ]);

    //             $professionals = $query->paginate(12);
    //         } else {
    //             return response()->json(['error' => 'Could not get user location'], 400);
    //         }
    //     } else {
    //         // Simplified fallback query
    //         $query = User::where('role_id', "2")
    //             ->orderBy('is_ads', 'desc');

    //         if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //             $categoryIds = array_map('intval', $allSelectIds);
    //             $query->whereIn('user_category_id', $categoryIds);
    //         }

    //         if ($request->has('search') && !empty($request->search)) {
    //             $searchTerm = $request->search;
    //             $query->where(function ($q) use ($searchTerm) {
    //                 $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //             });
    //         }

    //         $professionals = $query->paginate(12);
    //     }

    //     $return_data['professionals'] = $professionals;
    //     return view('frontend.professional-list', $return_data);
    // }


    // public function ProfessionalList(Request $request)
    // {
    //     $allSelectIds = $request->select_categories;
    //     $return_data = [];
    //     $return_data['site_title'] = 'Professionals';

    //     $user = auth()->user();

    //     if (!empty($user->city) && !empty($user->state) && !empty($user->country)) {
    //         $userAddress = $user->city . ', ' . $user->state . ', ' . $user->country;
    //         $userLatLng = $this->getLatLngFromAddress($userAddress);

    //         if ($userLatLng) {
    //             $query = User::where('role_id', "2")
    //                 ->orderBy('is_ads', 'desc');

    //             if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //                 $categoryIds = array_map('intval', $allSelectIds);
    //                 $query->whereIn('user_category_id', $categoryIds);
    //             }

    //             if ($request->has('search') && !empty($request->search)) {
    //                 $searchTerm = $request->search;
    //                 $query->where(function ($q) use ($searchTerm) {
    //                     $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('displayname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('city', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('state', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('country', 'like', '%' . $searchTerm . '%');
    //                 });
    //             }

    //             $query->orderByRaw("CASE
    //                 WHEN city LIKE ? AND state LIKE ? AND country LIKE ? THEN 1
    //                 WHEN city LIKE ? OR state LIKE ? OR country LIKE ? THEN 2
    //                 ELSE 3
    //             END ASC", [
    //                 '%' . $user->city . '%',
    //                 '%' . $user->state . '%',
    //                 '%' . $user->country . '%',
    //                 '%' . $user->city . '%',
    //                 '%' . $user->state . '%',
    //                 '%' . $user->country . '%'
    //             ]);

    //             $professionals = $query->paginate(12);
    //         } else {
    //             return response()->json(['error' => 'Could not get user location from address'], 400);
    //         }
    //     } else {
    //         // Simplified fallback query
    //         $query = User::where('role_id', "2")
    //             ->orderBy('is_ads', 'desc');

    //         if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //             $categoryIds = array_map('intval', $allSelectIds);
    //             $query->whereIn('user_category_id', $categoryIds);
    //         }

    //         if ($request->has('search') && !empty($request->search)) {
    //             $searchTerm = $request->search;
    //             $query->where(function ($q) use ($searchTerm) {
    //                 $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //             });
    //         }

    //         $professionals = $query->paginate(12);
    //     }

    //     $return_data['professionals'] = $professionals;
    //     return view('frontend.professional-list', $return_data);
    // }


    // public function ProfessionalList(Request $request)
    // {
    //     $allSelectIds = $request->select_categories;
    //     $return_data = [];
    //     $return_data['site_title'] = 'Professionals';

    //     $user = auth()->user();

    //     if ($user == null) {
    //         $userLatitude = session('latitude');
    //         $userLongitude = session('longitude');

    //         // Get address from latitude and longitude using a geolocation service
    //         $userAddress = $this->getAddressFromLatLng($userLatitude, $userLongitude);

    //         if ($userAddress) {
    //             $userLatLng = $this->getLatLngFromAddress($userAddress);

    //             // Use the user address details (city, state, country) in the query
    //             $query = User::where('role_id', "2")
    //                 ->orderBy('is_ads', 'desc');

    //             if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //                 $categoryIds = array_map('intval', $allSelectIds);
    //                 $query->whereIn('user_category_id', $categoryIds);
    //             }

    //             if ($request->has('search') && !empty($request->search)) {
    //                 $searchTerm = $request->search;
    //                 $query->where(function ($q) use ($searchTerm) {
    //                     $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('displayname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('city', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('state', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('country', 'like', '%' . $searchTerm . '%');
    //                 });
    //             }

    //             $query->orderByRaw("CASE
    //                 WHEN city LIKE ? AND state LIKE ? AND country LIKE ? THEN 1
    //                 WHEN city LIKE ? OR state LIKE ? OR country LIKE ? THEN 2
    //                 ELSE 3
    //             END ASC", [
    //                 '%' . $userLatLng['city'] . '%',
    //                 '%' . $userLatLng['state'] . '%',
    //                 '%' . $userLatLng['country'] . '%',
    //                 '%' . $userLatLng['city'] . '%',
    //                 '%' . $userLatLng['state'] . '%',
    //                 '%' . $userLatLng['country'] . '%'
    //             ]);

    //             $professionals = $query->paginate(12);
    //         } else {
    //             return response()->json(['error' => 'Could not get user location from latitude/longitude'], 400);
    //         }
    //     } else if (!empty($user->city) && !empty($user->state) && !empty($user->country)) {
    //         $userAddress = $user->city . ', ' . $user->state . ', ' . $user->country;
    //         $userLatLng = $this->getLatLngFromAddress($userAddress);

    //         if ($userLatLng) {
    //             $query = User::where('role_id', "2")
    //                 ->orderBy('is_ads', 'desc');

    //             if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //                 $categoryIds = array_map('intval', $allSelectIds);
    //                 $query->whereIn('user_category_id', $categoryIds);
    //             }

    //             if ($request->has('search') && !empty($request->search)) {
    //                 $searchTerm = $request->search;
    //                 $query->where(function ($q) use ($searchTerm) {
    //                     $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('displayname', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('city', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('state', 'like', '%' . $searchTerm . '%')
    //                         ->orWhere('country', 'like', '%' . $searchTerm . '%');
    //                 });
    //             }

    //             $query->orderByRaw("CASE
    //                 WHEN city LIKE ? AND state LIKE ? AND country LIKE ? THEN 1
    //                 WHEN city LIKE ? OR state LIKE ? OR country LIKE ? THEN 2
    //                 ELSE 3
    //             END ASC", [
    //                 '%' . $user->city . '%',
    //                 '%' . $user->state . '%',
    //                 '%' . $user->country . '%',
    //                 '%' . $user->city . '%',
    //                 '%' . $user->state . '%',
    //                 '%' . $user->country . '%'
    //             ]);

    //             $professionals = $query->paginate(12);
    //         } else {
    //             return response()->json(['error' => 'Could not get user location from address'], 400);
    //         }
    //     } else {
    //         // Simplified fallback query
    //         $query = User::where('role_id', "2")
    //             ->orderBy('is_ads', 'desc');

    //         if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //             $categoryIds = array_map('intval', $allSelectIds);
    //             $query->whereIn('user_category_id', $categoryIds);
    //         }

    //         if ($request->has('search') && !empty($request->search)) {
    //             $searchTerm = $request->search;
    //             $query->where(function ($q) use ($searchTerm) {
    //                 $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                     ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //             });
    //         }

    //         $professionals = $query->paginate(12);
    //     }


    //     // if ($user == null) {
    //     //     $userLatitude = session('latitude');
    //     //     $userLongitude = session('longitude');

    //     // } else if (!empty($user->city) && !empty($user->state) && !empty($user->country)) {
    //     //     $userAddress = $user->city . ', ' . $user->state . ', ' . $user->country;
    //     //     $userLatLng = $this->getLatLngFromAddress($userAddress);

    //     //     if ($userLatLng) {
    //     //         $query = User::where('role_id', "2")
    //     //             ->orderBy('is_ads', 'desc');

    //     //         if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //     //             $categoryIds = array_map('intval', $allSelectIds);
    //     //             $query->whereIn('user_category_id', $categoryIds);
    //     //         }

    //     //         if ($request->has('search') && !empty($request->search)) {
    //     //             $searchTerm = $request->search;
    //     //             $query->where(function ($q) use ($searchTerm) {
    //     //                 $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //     //                     ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //     //                     ->orWhere('displayname', 'like', '%' . $searchTerm . '%')
    //     //                     ->orWhere('city', 'like', '%' . $searchTerm . '%')
    //     //                     ->orWhere('state', 'like', '%' . $searchTerm . '%')
    //     //                     ->orWhere('country', 'like', '%' . $searchTerm . '%');
    //     //             });
    //     //         }

    //     //         $query->orderByRaw("CASE
    //     //         WHEN city LIKE ? AND state LIKE ? AND country LIKE ? THEN 1
    //     //         WHEN city LIKE ? OR state LIKE ? OR country LIKE ? THEN 2
    //     //         ELSE 3
    //     //     END ASC", [
    //     //             '%' . $user->city . '%',
    //     //             '%' . $user->state . '%',
    //     //             '%' . $user->country . '%',
    //     //             '%' . $user->city . '%',
    //     //             '%' . $user->state . '%',
    //     //             '%' . $user->country . '%'
    //     //         ]);

    //     //         $professionals = $query->paginate(12);
    //     //     } else {
    //     //         return response()->json(['error' => 'Could not get user location'], 400);
    //     //     }
    //     // } else {
    //     //     // Simplified fallback query
    //     //     $query = User::where('role_id', "2")
    //     //         ->orderBy('is_ads', 'desc');

    //     //     if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //     //         $categoryIds = array_map('intval', $allSelectIds);
    //     //         $query->whereIn('user_category_id', $categoryIds);
    //     //     }

    //     //     if ($request->has('search') && !empty($request->search)) {
    //     //         $searchTerm = $request->search;
    //     //         $query->where(function ($q) use ($searchTerm) {
    //     //             $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //     //                 ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //     //                 ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //     //         });
    //     //     }

    //     //     $professionals = $query->paginate(12);
    //     // }

    //     $return_data['professionals'] = $professionals;
    //     return view('frontend.professional-list', $return_data);
    // }


    // public function ProfessionalList(Request $request)
    // {
    //     $allSelectIds = $request->select_categories;

    //     $return_data = [];
    //     $return_data['site_title'] = 'Professionals';
    //     $user = auth()->user();

    //     // Dynamically get the user's city, state, and country
    //     $userAddress = $user->city . ', ' . $user->state . ', ' . $user->country;
    //     $userLatLng = $this->getLatLngFromAddress($userAddress); // Get the user's latitude and longitude

    //     if (!$userLatLng) {
    //         // Handle error, maybe show a message or use default location
    //         return response()->json(['error' => 'Could not get user location'], 400);
    //     }

    //     $query = User::where('role_id', "2")
    //         ->orderBy('is_ads', 'desc');

    //     // Check for selected categories
    //     if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //         $categoryIds = array_map('intval', $allSelectIds);
    //         $query->whereIn('user_category_id', $categoryIds);
    //     }

    //     // Check for search input
    //     if ($request->has('search') && !empty($request->search)) {
    //         $searchTerm = $request->search;

    //         $query->where(function ($q) use ($searchTerm) {
    //             // Matching name, slug, or displayname
    //             $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('displayname', 'like', '%' . $searchTerm . '%')
    //                 // Matching city, state, or country
    //                 ->orWhere('city', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('state', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('country', 'like', '%' . $searchTerm . '%');
    //         });
    //     }

    //     // Priority ordering (Exact match, Nearby, Other)
    //     $query->orderByRaw("CASE
    //     WHEN city LIKE ? AND state LIKE ? AND country LIKE ? THEN 1
    //     WHEN city LIKE ? OR state LIKE ? OR country LIKE ? THEN 2
    //     ELSE 3
    // END ASC", [
    //         '%' . $user->city . '%',
    //         '%' . $user->state . '%',
    //         '%' . $user->country . '%',
    //         '%' . $user->city . '%',
    //         '%' . $user->state . '%',
    //         '%' . $user->country . '%'
    //     ]);

    //     // Fetch the paginated results
    //     $professionals = $query->paginate(12);

    //     $return_data['professionals'] = $professionals;
    //     return view('frontend.professional-list', $return_data);
    // }





    // this is old org code
    // public function ProfessionalList(Request $request)
    // {
    //     $allSelectIds = $request->select_categories;
    //     $return_data = [];
    //     $return_data['site_title'] = 'Professionals';
    //     $query = User::where('role_id', "2")
    //         ->orderBy('is_ads', 'desc');
    //     if ($request->has('select_categories') && !empty($allSelectIds) && $allSelectIds[0] != null) {
    //         $categoryIds = array_map('intval', $allSelectIds);
    //         $query->whereIn('user_category_id', $categoryIds);
    //     }
    //     if ($request->has('search') && !empty($request->search)) {
    //         $searchTerm = $request->search;
    //         $query->where(function ($q) use ($searchTerm) {
    //             $q->where('fullname', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('slug', 'like', '%' . $searchTerm . '%')
    //                 ->orWhere('displayname', 'like', '%' . $searchTerm . '%');
    //         });
    //     }
    //     $professionals = $query->paginate(12);
    //     $return_data['professionals'] = $professionals;
    //     return view('frontend.professional-list', $return_data);
    // }


    // public function ProfessionalList(Request $request)
    // {
    //     $return_data = [];
    //     $return_data['site_title'] = 'Professionals';
    //     $user = auth()->user();
    //     $is_filter = 0;
    //     if ($request->filled('receipt_name')) {
    //         $is_filter = 1;
    //         if (
    //             $request->query('sort_type') === null
    //             && $request->query('receipt_name') === null
    //             && (!$request->has('category') || empty($request->query('category')) || !array_filter($request->query('category')))
    //             // && (!$request->has('sport') || empty($request->query('sport')) || !array_filter($request->query('sport')))
    //             // && (!$request->has('length') || empty($request->query('length')) || !array_filter($request->query('length')))
    //         ) {
    //             return redirect()->route('front.professional-list');
    //         }
    //     }

    //     $sport = collect([]);
    //     $kinésithérapie = collect([]);

    //         // dd($kinésithérapie);

    //     if (isset($request->sport)) {
    //         $sportIds = is_array($request->sport) ? $request->sport : [$request->sport];
    //         $sport = User::where('user_category_id', 1)->whereIn('user_category_id', $sportIds)->pluck('user_id');
    //     }

    //     if (isset($request->Kinésithérapie)) {
    //         $KinésithérapieIds = is_array($request->Kinésithérapie) ? $request->Kinésithérapie : [$request->Kinésithérapie];
    //         $kinésithérapie= User::where('user_category_id', 2)->whereIn('user_category_id', $KinésithérapieIds)->pluck('user_id');
    //     }
    //     $professionals =  User::get();
    //     if (isset($request->sport)) {
    //         $professionals->appends(['sport' => $request->sport]);
    //     }
    //     $return_data['professionals'] = $professionals;
    //     return view('frontend.professional-list', $return_data);
    // }

    public function ProfessionalListoff(Request $request)
    {

        $return_data = [];
        $return_data['site_title'] = 'Professionals';
        $user = auth()->user();

        $is_filter = 0;

        // dd($request->all());

        if ($request->filled('receipt_name') || $request->filled('category') || $request->filled('sport') || $request->filled('length')) {
            $is_filter = 1;
            if (
                $request->query('sort_type') === null
                && $request->query('receipt_name') === null
                && (!$request->has('category') || empty($request->query('category')) || !array_filter($request->query('category')))
                && (!$request->has('sport') || empty($request->query('sport')) || !array_filter($request->query('sport')))
                && (!$request->has('length') || empty($request->query('length')) || !array_filter($request->query('length')))
            ) {
                return redirect()->route('front.professional-list');
            }
        }


        if ($user) {
            $user_id = $user->id;
            // dd($user_id);
            $professionals = User::with([
                'userProfessionalDetail',
                'user',
                'likes' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                },
            ])->where('userProfessionalDetail.status', '1');
        } else {
            $professionals = User::with('userProfessionalDetail')->where('userProfessionalDetail.status', '1');
        }

        // if ($user) {
        //     $user_id = $user->id;
        //     $videos = Video::with([
        //         'user',
        //         'likes' => function ($query) use ($user_id) {
        //             $query->where('user_id', $user_id);
        //         },
        //     ])->where('status', '1');
        // } else {
        //     $videos = Video::with('user')->where('status', '1');
        // }


        // $TagvideoIds = collect([]);
        // // dd($TagvideoIds);
        $categoryVideoIds = collect([]);
        $sportVideoIds = collect([]);
        // $difficultyVideoIds = collect([]);
        $lengthVideoIds = collect([]);

        // if (isset($request->tag)) {
        //     $tagIds = is_array($request->tag) ? $request->tag : [$request->tag];
        //     $TagvideoIds = UserTag::whereIn('tag_id', $tagIds)->pluck('video_id');
        // }

        if (isset($request->sport)) {
            $sportIds = is_array($request->sport) ? $request->sport : [$request->sport];
            $sportVideoIds = VideoSport::whereIn('sport_id', $sportIds)->pluck('video_id');
        }

        if (isset($request->category) && count($request->category) > 0) {
            $categoryIds = is_array($request->category) ? $request->category : [$request->category];
            $categoryVideoIds = UserVideoCategory::whereIn('category_id', $request->category)->pluck('video_id');
        }

        // if (isset($request->difficulty) && count($request->difficulty) > 0) {
        //     $difficultyIds = is_array($request->difficulty) ? $request->difficulty : [$request->difficulty];
        //     $difficultyVideoIds = Video::whereIn('difficulty_id', $difficultyIds)->pluck('id');
        // }
        if (isset($request->length) && count($request->length) > 0) {
            $lengthIds = is_array($request->length) ? $request->length : [$request->length];

            $length = [];

            // Flag to indicate whether 15 is present in the array
            $includeGreater = false;

            foreach ($lengthIds as $item) {
                $parts = explode('-', $item);
                if (count($parts) >= 2) {
                    [$start, $end] = $parts;
                    if ($end !== '') {
                        // Include lengths between $start and $end
                        $length = array_unique(array_merge($length, range($start, $end)));
                        if ($start <= 15 && $end >= 15) {
                            $includeGreater = true;
                        }
                    } else {
                        // If end value is not set, include lengths greater than $start
                        if ($start <= 15) {
                            $includeGreater = true;
                        }
                    }
                }
            }

            // If 15 is present, include lengths greater than 15
            if ($includeGreater) {
                $length = array_merge($length, range(16, $end ?? PHP_INT_MAX));
            }

            $lengthVideoIds = Video::whereIn('length', $length)->pluck('id');
        }

        // $mergedVideoIds = array_merge($TagvideoIds->isNotEmpty() ? $TagvideoIds->toArray() : [], $sportVideoIds->isNotEmpty() ? $sportVideoIds->toArray() : [], $categoryVideoIds->isNotEmpty() ? $categoryVideoIds->toArray() : [], $difficultyVideoIds->isNotEmpty() ? $difficultyVideoIds->toArray() : [], $lengthVideoIds->isNotEmpty() ? $lengthVideoIds->toArray() : []);

        // $mergedVideoIds = array_unique($mergedVideoIds);

        // if ($is_filter === 1) {
        //     if (count($mergedVideoIds) > 0) {
        //         $videos = $videos->whereIn('id', $mergedVideoIds);
        //     } else {
        //         // prx([$videos->get(),$is_filter]);
        //         // $videos = $videos->whereIn('id', [0]);
        //     }
        // }

        // if (isset($request->difficulty)) {
        //     $difficultyIds = is_array($request->difficulty) ? $request->difficulty : [$request->difficulty];
        //     $videos = $videos->whereIn('difficulty_id', $difficultyIds);
        // }

        // if (isset($request->receipt_name)) {
        //     $username = $request->receipt_name;
        //     $videos = $videos->whereHas('user', function ($query) use ($username) {
        //         $query->where(function ($subquery) use ($username) {
        //             $subquery
        //                 ->where('fullname', 'like', '%' . $username . '%')
        //                 ->orWhere('displayname', 'like', '%' . $username . '%')
        //                 ->orWhere('username', 'like', '%' . $username . '%');
        //         });
        //     });
        // }

        // if (isset($request->added)) {
        //     $addedIds = is_array($request->added) ? $request->added : [$request->added];
        //     if (in_array('today', $addedIds)) {
        //         $videos = $videos->whereDate('created_at', Carbon::today());
        //     }

        //     if (in_array('this_week', $addedIds)) {
        //         $videos = $videos->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        //     }
        //     if (in_array('this_month', $addedIds)) {
        //         $videos = $videos->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
        //     }
        // }

        // $videos = $videos->withCount('videoView');
        // $videos =   $videos->orderByDesc('is_ads');
        // $videos =   $videos->orderByDesc('updated_at');
        // if (isset($request->sort_type)) {
        //     if ($request->sort_type == '0') {
        //         $videos = $videos->orderByDesc('video_view_count');
        //     } elseif ($request->sort_type == '1') {
        //         $videos = $videos->orderBy('length', 'desc');
        //     } elseif ($request->sort_type == '2') {
        //         $videos = $videos->orderBy('length', 'asc');
        //     } elseif ($request->sort_type == '3') {
        //     }
        // } else {
        //     $videos = $videos->orderByDesc('video_view_count');
        // }
        // if (isset($request->search)) {
        //     $searchTerm = $request->search;
        //     $videos = $videos->where(function ($query) use ($searchTerm) {
        //         $query
        //             ->where('title', 'like', '%' . $searchTerm . '%')
        //             ->orWhere('name', 'like', '%' . $searchTerm . '%')
        //             ->orWhere('description', 'like', '%' . $searchTerm . '%');
        //     });
        // }

        // $perPage = 12;


        // $videos = $videos->paginate($perPage);

        // if (isset($request->tag)) {
        //     $videos->appends(['tag' => $request->tag]);
        // }

        if (isset($request->sport)) {
            $professionals->appends(['sport' => $request->sport]);
        }
        if (isset($request->category)) {
            $professionals->appends(['category' => $request->category]);
        }
        // if (isset($request->difficulty)) {
        //     $videos->appends(['difficulty' => $request->difficulty]);
        // }

        if (isset($request->receipt_name)) {
            $professionals->appends(['receipt_name' => $request->receipt_name]);
        }

        // if (isset($request->length)) {
        //     $videos->appends(['length' => $request->length]);
        // }
        // if (isset($request->added)) {
        //     $videos->appends(['added' => $request->added]);
        // }
        // if (isset($request->sort_type)) {
        //     $videos->appends(['sort_type' => $request->sort_type]);
        // }
        // if (isset($request->search)) {
        //     $videos->appends(['search' => $request->search]);
        // }

        // // prx($videos);
        // $return_data['video'] = $videos;
        // $return_data['pagination'] = $videos->links();
        // $return_data['tag'] = Tag::get();
        $return_data['sport'] = Sport::get();
        // $return_data['difficulty'] = Difficulty::get();
        return view('frontend.professional-list', $return_data,  compact('professionals'));
    }


    public function Notifications(Request $request)
    {
        // dd($request->all());
        $userId = Auth::user()->id;

        $return_data['notifications']  = Notification::where('to_user_id', $userId)
            ->orderBy('is_read', 'asc') // 0 (unread) will come before 1 (read)
            ->orderBy('created_at', 'desc') // Most recent notifications first
            ->paginate(10); // Fetch a total of 6 notifications

        // $return_data['notifications'] = Notification::where('to_user_id', $userId)
        //     ->orderBy('is_read', 'asc') // 0 (unread) will come before 1 (read)
        //     ->orderBy('created_at', 'desc') // Most recent notifications first
        //     ->with(['fromUser' => function ($query) {
        //         $query->select('id', 'slug'); // Select only the fields you need
        //     }])
        //     ->paginate(10); // Fetch a total of 10 notifications


        return view('frontend.notifications', $return_data);
    }


    // public function updateNotificationStatus(Request $request)
    // {
    //     // $fromUserId = Notification::with(['fromUser' => function($query) {
    //     //     $query->select('id', 'slug'); // Fetch only 'id' and 'slug' from users table
    //     // }])->find($request->id);

    //     // dd($fromUserId);
    //     $notification = Notification::find($request->id);
    //     if ($notification) {
    //         $notification->is_read = 1;
    //         $notification->save();
    //         return response()->json(['success' => true]);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    // }

    public function updateNotificationStatus(Request $request)
    {
        $notification = Notification::with(['fromUser' => function ($query) {
            $query->select('id', 'slug');
        }])->find($request->id);

        if ($notification) {
            $notification->is_read = 1;
            $notification->save();
            $fromUserSlug = $notification->fromUser->slug ?? null;

            return response()->json([
                'success' => true,
                'slug' => $fromUserSlug,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    }



    public function ExpireAddsData(Request $request)
    {
        //   prx($request->all());
        $data = VideoAds::where('created_at', '<=', now()->subHours(24))
            ->get();

        // prx($data);
        foreach ($data as $record) {
            Video::find($record->video_id)->update(['is_ads' => '0']);
            $record->delete();
        }
    }

    // public function ExpireSubscription(Request $request)
    // {
    //     // Fetch records where subscribe_date is more than 1 month old
    //     $data = User::where('subscribe_date', '<=', Carbon::now()->subMonth())
    //         ->get();


    //     $subscription_query = Subscription::where('price', '0')->first();
    //     if ($subscription_query) {
    //         $PlanId = $subscription_query->id;
    //     } else {
    //         $PlanId = '0';
    //     }
    //     // prx($data);
    //     // Loop through each record and renew the subscription
    //     foreach ($data as $record) {
    //         // Logic to renew the subscription

    //         $record->subscription_id = $PlanId; // Example: setting is_subscribe to 1
    //         $record->subscribe_date = Carbon::now(); // Resetting the subscription date to now
    //         $record->save();
    //     }

    //     // Optionally, log or return a message
    //     echo "Subscriptions renewed successfully at " . Carbon::now()->toDateTimeString() . PHP_EOL;
    // }

    public function ExpireSubscription(Request $request)
    {
        // Fetch records where subscribe_date is more than 1 month old
        $data = User::where('subscribe_date', '<=', Carbon::now()->subMonth())->get();
        // prx($data);

        $subscription_query = Subscription::where('price', '0')->first();
        $PlanId = $subscription_query ? $subscription_query->id : '0';

        // Loop through each record and renew the subscription
        foreach ($data as $record) {
            // Update the user's subscription
            $record->subscription_id = $PlanId;
            $record->subscribe_date = Carbon::now();
            $record->save();

            // Soft delete the old entry in SubscriptionHestory
            SubscriptionHestory::where('user_id', $record->id)
                ->whereNull('deleted_at')
                ->update(['deleted_at' => Carbon::now()]);

            // Add a new entry to SubscriptionHestory
            SubscriptionHestory::create([
                'user_id' => $record->id,
                'subsciption_id' => $PlanId,
                'amount' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ]);
        }

        // Optionally, log or return a message
        echo "Subscriptions renewed successfully and new history added at " . Carbon::now()->toDateTimeString() . PHP_EOL;
    }


    public function MaliciousVideo(Request $request)
    {

        $videoId = $request->malicious_video_id;
        $videoDescription = $request->description;
        $reportBy = Auth::user()->id;
        $curDate = date('Y-m-d');

        MaliciousVideo::create([
            'video_id' => $videoId,
            'description' => $videoDescription,
            'report_by' => $reportBy,
            'reported_date' => $curDate,
        ]);
        return response()->json(['message' => 'Video Reported To Admin.'], 200);
    }

    public function MaliciousProfile(Request $request)
    {
        $userId = $request->user_id;
        $dataDesc = $request->description;
        $reportBy = Auth::user()->id;
        $curDate = date('Y-m-d');

        MaliciousProfile::create([
            'user_id' => $userId,
            'descriptions' => $dataDesc,
            'report_by' => $reportBy,
            'reported_date' => $curDate,
        ]);

        return response()->json(['message' => 'Profile Reported To Admin.'], 200);
    }

    public function SendMailTest()
    {
        $user = User::find(1226); // Assuming 1226 is a valid user ID
        if (!$user) {
            return 'User not found!';
        }

        try {
            Mail::to('encryptedprince03@gmail.com')->send(new WelcomeUser($user));

            return 'Email sent successfully!';
        } catch (\Exception $e) {
            return 'Failed to send email: ' . $e->getMessage();
        }
    }

    public function Home()
    {
        $return_data = [];
        $return_data['site_title'] = GetSetting('seo_title');
        $return_data['physio_list'] = User::where('is_top', '1')->get();
        $return_data['video'] = Video::with('user')->get();
        $videos = Video::where('share_home_page', '1')->latest()->limit(10)->get();

        return view('frontend.partial.home', $return_data, compact('videos'));
    }

    public function StoreGetInTouch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'The given data was invalid.',
                    'status' => 422,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }
        $data = $request->all();

        unset($data['_token']);

        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;

        $information = Information::create($data);

        return response()->json(['message' => 'data stored successfully'], 200);
    }

    public function StoreNewsLetter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();

        unset($data['_token']);

        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['updated_at'] = $dateTime;
        $newsletter = newsletter::create($data);
        return response()->json(['message' => 'data stored successfully'], 200);
    }

    // public function SubmitRegisterForm(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'fullname' => 'required',
    //         'displayname' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //         'password_confirmation' => 'required|min:6',
    //         'privacy_policy' => 'required',
    //         'role_id' => 'required',
    //     ]);

    //     $validator->sometimes('user_category_id', 'required', function ($input) {
    //         return $input->role_id == '2';
    //     });

    //     if ($validator->fails()) {
    //         return response()->json(
    //             [
    //                 'message' => 'The given data was invalid.',
    //                 'status' => 422,
    //                 'errors' => $validator->errors(),
    //             ],
    //             422,
    //         );
    //     }
    //     $password = Hash::make($request->password);

    //     $data = $request->all();
    //     unset($data['_token']);
    //     unset($data['password_confirmation']);
    //     unset($data['newslatter']);
    //     unset($data['privacy_policy']);
    //     unset($data['sport_category_id']);
    //     $slug_data['fullname'] = $request->fullname;
    //     $slug = GetSlug($slug_data);

    //     $dateTime = Carbon::now();
    //     $data['created_at'] = $dateTime;
    //     $data['slug'] = $slug;
    //     $data['updated_at'] = $dateTime;
    //     $data['password'] = $password;

    //     if ($request->has('newslatter')) {
    //         Newsletter::create(['email' => $request->email]);
    //     }

    //     $user = User::create($data);
    //     $sportId = $request->sport_category_id;
    //     $dateTime = Carbon::now();

    //     if ($sportId && $request->role_id == '2') {
    //         foreach ($sportId as $data) {
    //             $input = [];
    //             $input['user_id'] = $user['id'];
    //             $input['sport_id'] = $data;
    //             $input['created_at'] = $dateTime;
    //             $input['updated_at'] = $dateTime;
    //             $sport = UserSport::create($input);
    //         }
    //     }

    //     if ($sportId && $request->role_id == '2') {
    //         foreach ($sportId as $data) {
    //             $input = [];
    //             $input['user_id'] = $user['id'];
    //             $input['sport_id'] = $data;
    //             $input['created_at'] = $dateTime;
    //             $input['updated_at'] = $dateTime;
    //             $sport = UserSport::create($input);
    //         }
    //     }

    //     return response()->json(['message' => 'data stored successfully'], 200);
    // }

    public function SubmitRegisterForm(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'displayname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'privacy_policy' => 'required',
            'role_id' => 'required',
        ]);

        $validator->sometimes('user_category_id', 'required', function ($input) {
            return $input->role_id == '2';
        });

        // Handle validation errors
        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'The given data was invalid.',
                    'status' => 422,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        // Hash the password
        $password = Hash::make($request->password);

        // Prepare data for user creation
        $data = $request->all();
        unset($data['_token']);
        unset($data['password_confirmation']);
        unset($data['newslatter']);
        unset($data['privacy_policy']);
        unset($data['sport_category_id']);
        $slug_data['fullname'] = $request->fullname;
        $slug = GetSlug($slug_data);
        $dateTime = Carbon::now();
        $data['created_at'] = $dateTime;
        $data['slug'] = $slug;
        $data['updated_at'] = $dateTime;
        $data['password'] = $password;

        if ($data['role_id'] == '2') {
            $subscribe = Subscription::where('price', 0)->first();
            $today = date('Y-m-d');

            if ($subscribe) {
                $data['subscription_id'] = $subscribe->id;
                $data['is_subscribe'] = 1;
                $data['subscribe_date'] = $today;
            }
        } else {
            $data['subscription_id'] = null;
        }

        // dd($data);

        // Create the user
        $user = User::create($data);

        // If newsletter subscription is enabled, store the email
        if ($request->has('newslatter')) {
            Newsletter::create(['email' => $request->email]);
        }

        // $toEmail =  $user->email;

        // // Sending a basic email
        // $toEmail = 'viranijasmeen@gmail.com';

        // // Sending a basic email
        // Mail::send('front.email.welcome-mail', [], function ($message) use ($toEmail) {
        //     $message->to($toEmail)->subject('Test Email');
        // });
        $toEmail = $user->email;

        // Sending a basic email
        Mail::send('email.welcome-mail', [], function ($message) use ($toEmail) {
            $message->to($toEmail)->subject('You are Registered successfully');
        });

        // Send welcome email to the user
        // Mail::to($user->email)->send(new WelcomeUser($user));

        // $emails = ['princesolanki@yopmail.com', 'encryptedprince03@gmail.com'];
        // Mail::to($emails)->send(new WelcomeUser($user));
        // Mail::to('princesolanki@yopmail.com')->send(new WelcomeUser($user));

        // Handle additional logic for sports if needed

        return response()->json(['message' => 'Data stored successfully'], 200);
    }

    public function PhysioBio($slug, $user_id = null)
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return abort(404);
        }

        $site_title = $user->seo_title;
        $meta_keyword = $user->meta_keyword;
        $meta_description = $user->meta_description;
        $canonical = $user->canonical;
        $city = $user->city;
        $state = $user->state;
        $country = $user->country;

        $my_following_count = 0;
        $profession_following_count = 0;
        $sub_category_list = [];
        $follower = Follower::where('profession_id', $user->id)->count();
        $profession_following_count = Follower::where('user_id', $user->id)->count();
        $user_category = [];
        $likes_videos_ids = [];

        $phisio_user_sub_category_list = [];
        $sub_category1_list = [];
        $sub_category2_list = [];
        $sub_category3_list = [];
        $isproLiked = 0;
        $text = '';
        $users = User::latest()->get()->pluck('displayname', 'id')->toArray();
        if (Auth::user()) {
            $loggedInUserId = Auth::id();
            unset($users[$loggedInUserId]);

            $my_following_count = Follower::where('profession_id', $user->id)
                ->where('user_id', Auth::user()->id)
                ->count();
            $isproLiked = UserLike::where('user_id', Auth::user()->id)
                ->where('professional_id', $user->id)
                ->count();

            $sub_category_list = Category::where('category_id', $user->user_category_id)
                ->get()
                ->pluck('name', 'id');
            $user_category = UserCategory::where('user_id', $user->id)
                ->get()
                ->pluck('category_id')
                ->toArray();
            $likes_videos_ids = Like::where('user_id', Auth::user()->id)
                ->pluck('video_id')
                ->toarray();
            $user_subscription_id = Auth::user()->subscription_id;

            $subscription = Subscription::find($user_subscription_id);
            if ($subscription) {
                $subscription_key = $subscription->key;

                if ($subscription_key) {
                    // Determine the ID based on the subscription_id
                    switch ($subscription_key) {
                        case 'free':
                            $text = 'max video 5 MB';
                            break;
                        case 'silver':
                            $text = 'max video 30 MB';
                            break;
                        case 'gold':
                            $text = 'video unlimited';
                            break;
                        default:
                            $text = '5 MB';
                            break;
                    }
                }
            }

            $user_sub_category = UserCategory::where('user_id', Auth::user()->id)->get();
            if (count($user_sub_category) > 0) {
                foreach ($user_sub_category as $list1) {
                    $phisio_user_sub_category_list[$list1->id] = Category::where('id', $list1->category_id)->first();
                    $sub_category1_list[$list1->id] = VideoCategory::where('sub_category_1', $list1->category_id)
                        ->whereNull('sub_category_2')
                        ->whereNull('sub_category_3')
                        ->whereNull('sub_category_4')
                        ->get();
                    if (count($sub_category1_list[$list1->id]) > 0) {
                        foreach ($sub_category1_list[$list1->id] as $list2) {
                            $sub_category2_list[$list1->id][$list2->id] = VideoCategory::where('sub_category_2', $list2->id)
                                ->whereNull('sub_category_3')
                                ->whereNull('sub_category_4')
                                ->get();
                            if (count($sub_category2_list[$list1->id][$list2->id]) > 0) {
                                foreach ($sub_category2_list[$list1->id][$list2->id] as $list3) {
                                    $sub_category3_list[$list1->id][$list2->id][$list3->id] = VideoCategory::where('sub_category_3', $list3->id)
                                        ->whereNull('sub_category_4')
                                        ->get();
                                }
                            }
                        }
                    }
                }
            }
        }
        //  start code dynamic description
        $description = 'You can upload  ' . $text;

        $following = Following::where('user_id', $user->id)->count();
        $userEducations = UserEducationDetail::where('user_id', $user->id)->get();
        $userProfessionals = UserProfessionalDetail::where('user_id', $user->id)->get();
        $services = UserService::where('user_id', $user->id)
            ->with(['service'])
            ->get();
        $services_list = Service::get()->pluck('name', 'id')->toArray();
        $user_services = UserService::where('user_id', $user->id)
            ->get()
            ->pluck('service_id')
            ->toArray();
        $subcategory1 = $categories = Category::whereNull('category_id')->get()->pluck('name', 'id')->toArray();
        $difficulty = Difficulty::get()->pluck('name', 'id')->toArray();
        $tags = Tag::where('category_id', $user->user_category_id)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
        $videos = Video::with(['usertag'])
            ->where('user_id', $user->id)
            ->where('status', '1')
            ->latest()
            ->get();

        $sports = Sport::get()->pluck('name', 'id')->toArray();

        $selected_category = Category::find($user->user_category_id);

        if ($selected_category) {
            $selected_category = $selected_category->pluck('id')->toArray();
        } else {
            $selected_category = [];
        }

        $like = Like::with(['user', 'video'])
            ->where('user_id', $user->id)
            ->get();

        $videoSql = Video::with('user')
            ->where('user_id', $user->id);

        if (Auth::check() &&   $user->id ===  $loggedInUserId) {
        } else {
            $videoSql = $videoSql->where('status', '1');
        }

        $videoCountSql = clone $videoSql;
        $privateVideoCountSql = clone $videoSql;
        $videoCount = $videoCountSql->count();
        $privateVideoCount = $privateVideoCountSql->where('is_private', '1')->count();

        $video = $videoSql->get()->sortByDesc('videoPurchased');
        $slider = UserSlider::where('user_id', $user->id)->get();

        $ads = Ads::first();

        // && Auth::user()->id === $user->id
        if (Auth::check()) {
            if (Auth::user()->id === $user->id) {
                $lessons = $user->lessons()->latest()->get();
            } else {
                $sharedLessonIds = PrivateLessonUser::where('user_id', Auth::user()->id)
                    ->pluck('lesson_id')
                    ->toArray();

                $userPrivateLessons = Lesson::whereIn('id', $sharedLessonIds)->where('is_private', '1')->latest()->get();
                $userPublicLessons = $user->lessons()->where('is_private', '0')->latest()->get();
                $lessons = $userPublicLessons->merge($userPrivateLessons);
            }
        } else {
            $lessons = $user->lessons()->where('is_private', '0')->latest()->get();
        }
        // dd($lessons);

        $like_professional_count = UserLike::where('professional_id', $user->id)->count();
        $subscription = $user->subscription()->first();

        $subscription_name = null;

        if ($subscription) {
            $subscription_name = strtolower($subscription->key);
        }

        $chat_user = null;
        if ($user_id != "" && $user_id != null && $user_id != 0) {
            $chat_user = User::where('id', $user_id)->first();
        }

        // dd($subscription_name);
        return view('frontend.partial.becomephysiobio', compact('user', 'site_title', 'meta_keyword', 'meta_description', 'canonical', 'like_professional_count', 'isproLiked', 'slider', 'city', 'state', 'country', 'likes_videos_ids', 'profession_following_count', 'my_following_count', 'follower', 'following', 'userEducations', 'userProfessionals', 'services', 'services_list', 'user_services', 'categories', 'subcategory1', 'difficulty', 'tags', 'sports', 'videos', 'sub_category_list', 'selected_category', 'user_category', 'like', 'video', 'phisio_user_sub_category_list', 'sub_category1_list', 'sub_category2_list', 'sub_category3_list', 'site_title', 'users', 'ads', 'lessons', 'subscription_name', 'videoCount', 'privateVideoCount', 'description', 'chat_user'));
    }

    public function UpdateProfessionalProfile(Request $request)
    {
        $user = User::where('slug', $request->slug)->first();
        $id = $user->id;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'fullname' => 'required',
            'displayname' => 'required',
            'mobile_number' => 'required|regex:/^[0-9]{10,15}$/',
            'instaname' => 'nullable', // Assuming instaname is part of your request data
            'instalink' => $request->instaname ? 'required|url' : '', // Conditional validation
            'twittername' => 'nullable', // Assuming instaname is part of your request data
            'twitterlink' => $request->twittername ? 'required|url' : '', // Conditional validation
            'profile_video.*' => 'nullable|mimetypes:video/mp4,video/avi,video/quicktime,video/x-ms-wmv,image/jpeg,image/png|max:30000',

            'year_of_experience' => $user->role_id == 2 ? 'required' : '',
            'about_long' => $user->role_id == 2 ? 'required|min:10|max:200' : '',
            'about_sort' => $user->role_id == 2 ? 'required|min:5|max:50' : '',
            'subcategories' => $user->role_id == 2 ? 'required' : '',
        ]);

        $city = $request->city;
        $state = $request->state;
        $country = $request->country;

        $address = "$city, $state, $country";
        $location = $this->getLatLngFromAddress($address);
        if ($location) {
            $latlong = json_encode([
                'latitude' => $location['lat'],
                'longitude' => $location['lng']
            ]);
        } else {
            $latlong = null;
        }

        $data = [
            'email' => request()->email,
            'mobile_number' => request()->mobile_number,
            'fullname' => request()->fullname,
            'displayname' => request()->displayname,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'latlong' => $latlong ?? null,
            'instalink' => request()->instalink,
            'twitterlink' => request()->twitterlink,
            'year_of_experience' => request()->year_of_experience,
            'instaname' => request()->instaname,
            'instalink' => request()->instalink,
            'twittername' => request()->twittername,
            'twitterlink' => request()->twitterlink,
            'about_sort' => request()->about_sort,
            'about_long' => request()->about_long,
        ];

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        if ($request->hasFile('profile_video')) {
            $profileVideos = [];
            foreach ($request->file('profile_video') as $file) {
                $filename = ImageUploadTrait::updateImage($user->profile_video, $file, 'profilemedia');

                $type = getMediaType($file);

                $profileVideos[] = [
                    'user_id' => $user->id,
                    'name' => $filename,
                    'type' => $type,
                ];
            }

            UserSlider::insert($profileVideos);
        }

        if ($request->hasFile('profile_photo')) {
            $filename = ImageUploadTrait::updateImage($user->profile_photo, $request->file('profile_photo'), 'profilephoto');
            $data['profile_photo'] = $filename;
        }
        $user->update($data);

        $existing_services = UserService::where('user_id', $user->id)->get();

        if (request()->has('services')) {
            foreach ($existing_services as $key => $value) {
                $serviceId = $value->id;
                if (!in_array($serviceId, request()->services)) {
                    UserService::where('id', $value->id)->delete();
                }
            }
            foreach (request()->services as $key => $value) {
                $query = UserService::where('service_id', $value)->where('user_id', $value)->first();
                if (!$query) {
                    $data = [
                        'service_id' => $value,
                        'user_id' => $id,
                    ];
                    UserService::insert($data);
                }
            }
        }

        $existing_sub_category = UserCategory::where('user_id', $user->id)->get();

        if (request()->has('subcategories')) {
            foreach ($existing_sub_category as $key => $value) {
                $categoryId = $value->id;
                if (!in_array($categoryId, request()->subcategories)) {
                    UserCategory::where('id', $value->id)->delete();
                }
            }

            foreach (request()->subcategories as $key => $value) {
                $data = [
                    'category_id' => $value,
                    'user_id' => $user->id,
                ];
                UserCategory::insert(['category_id' => $value, 'user_id' => $user->id], $data);
            }
        }

        UserProfessionalDetail::where('user_id', $user->id)->delete();
        UserEducationDetail::where('user_id', $user->id)->delete();

        if (request()->has('professionaldetalis')) {
            $data = [];
            foreach (request()->professionaldetalis as $key => $value) {
                if ($value != null) {
                    $data[] = ['user_id' => $user->id, 'details' => $value];
                }
            }
            UserProfessionalDetail::insert($data);
        }

        if (request()->has('education_details')) {
            $data = [];
            foreach (request()->education_details as $key => $value) {
                if ($value != null) {
                    $data[] = ['user_id' => $user->id, 'details' => $value];
                }
            }
            UserEducationDetail::insert($data);
        }
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
    // public function UpdateProfessionalProfile(Request $request)
    // {
    //     $user = User::where('slug', $request->slug)->first();
    //     $id = $user->id;
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'fullname' => 'required',
    //         'displayname' => 'required',
    //         'mobile_number' => 'required|regex:/^[0-9]{10,15}$/',
    //         'instaname' => 'nullable', // Assuming instaname is part of your request data
    //         'instalink' => $request->instaname ? 'required|url' : '', // Conditional validation
    //         'twittername' => 'nullable', // Assuming instaname is part of your request data
    //         'twitterlink' => $request->twittername ? 'required|url' : '', // Conditional validation
    //         'profile_video.*' => 'nullable|mimetypes:video/mp4,video/avi,video/quicktime,video/x-ms-wmv,image/jpeg,image/png|max:30000',

    //         'year_of_experience' => $user->role_id == 2 ? 'required' : '',
    //         'about_long' => $user->role_id == 2 ? 'required|min:10|max:200' : '',
    //         'about_sort' => $user->role_id == 2 ? 'required|min:5|max:50' : '',
    //         'subcategories' => $user->role_id == 2 ? 'required' : '',
    //     ]);

    //     $data = [
    //         'email' => request()->email,
    //         'mobile_number' => request()->mobile_number,
    //         'fullname' => request()->fullname,
    //         'displayname' => request()->displayname,
    //         'city' => request()->city,
    //         'state' => request()->state,
    //         'country' => request()->country,
    //         'instalink' => request()->instalink,
    //         'twitterlink' => request()->twitterlink,
    //         'year_of_experience' => request()->year_of_experience,
    //         'instaname' => request()->instaname,
    //         'instalink' => request()->instalink,
    //         'twittername' => request()->twittername,
    //         'twitterlink' => request()->twitterlink,
    //         'about_sort' => request()->about_sort,
    //         'about_long' => request()->about_long,
    //     ];

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 401);
    //     }
    //     if ($request->hasFile('profile_video')) {
    //         $profileVideos = [];
    //         foreach ($request->file('profile_video') as $file) {
    //             $filename = ImageUploadTrait::updateImage($user->profile_video, $file, 'profilemedia');

    //             $type = getMediaType($file);

    //             $profileVideos[] = [
    //                 'user_id' => $user->id,
    //                 'name' => $filename,
    //                 'type' => $type,
    //             ];
    //         }

    //         UserSlider::insert($profileVideos);
    //     }

    //     if ($request->hasFile('profile_photo')) {
    //         $filename = ImageUploadTrait::updateImage($user->profile_photo, $request->file('profile_photo'), 'profilephoto');
    //         $data['profile_photo'] = $filename;
    //     }
    //     $user->update($data);

    //     $existing_services = UserService::where('user_id', $user->id)->get();

    //     if (request()->has('services')) {
    //         foreach ($existing_services as $key => $value) {
    //             $serviceId = $value->id;
    //             if (!in_array($serviceId, request()->services)) {
    //                 UserService::where('id', $value->id)->delete();
    //             }
    //         }
    //         foreach (request()->services as $key => $value) {
    //             $query = UserService::where('service_id', $value)->where('user_id', $value)->first();
    //             if (!$query) {
    //                 $data = [
    //                     'service_id' => $value,
    //                     'user_id' => $id,
    //                 ];
    //                 UserService::insert($data);
    //             }
    //         }
    //     }

    //     $existing_sub_category = UserCategory::where('user_id', $user->id)->get();

    //     if (request()->has('subcategories')) {
    //         foreach ($existing_sub_category as $key => $value) {
    //             $categoryId = $value->id;
    //             if (!in_array($categoryId, request()->subcategories)) {
    //                 UserCategory::where('id', $value->id)->delete();
    //             }
    //         }

    //         foreach (request()->subcategories as $key => $value) {
    //             $data = [
    //                 'category_id' => $value,
    //                 'user_id' => $user->id,
    //             ];
    //             UserCategory::insert(['category_id' => $value, 'user_id' => $user->id], $data);
    //         }
    //     }

    //     UserProfessionalDetail::where('user_id', $user->id)->delete();
    //     UserEducationDetail::where('user_id', $user->id)->delete();

    //     if (request()->has('professionaldetalis')) {
    //         $data = [];
    //         foreach (request()->professionaldetalis as $key => $value) {
    //             if ($value != null) {
    //                 $data[] = ['user_id' => $user->id, 'details' => $value];
    //             }
    //         }
    //         UserProfessionalDetail::insert($data);
    //     }

    //     if (request()->has('education_details')) {
    //         $data = [];
    //         foreach (request()->education_details as $key => $value) {
    //             if ($value != null) {
    //                 $data[] = ['user_id' => $user->id, 'details' => $value];
    //             }
    //         }
    //         UserEducationDetail::insert($data);
    //     }
    //     return response()->json(['message' => 'Profile updated successfully'], 200);
    // }

    public function AddLessonVideo(Request $request)
    {
        $rules = [
            'title' => 'required',
            'lesson_title' => 'required',
            'category_id' => 'required',
            'difficulty_id' => 'required',
            'tags' => 'required',
            'sports' => 'required',
            'description' => 'required',
            'video' => 'required|mimes:mp4,avi,mov,wmv|max:30000',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        if ($request->has('is_private')) {
            $rules['users'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $user = User::where('slug', $request->slug)->first();

        $video_lesson_id = VideoLesson::insertGetId(['title', $request->lesson_title]);

        $recordData = [
            'title' => $request->title,
            'description' => $request->description,
            'difficulty_id' => $request->difficulty_id,
            'user_id' => $user->id,
            'video_lesson_id' => $video_lesson_id,
            'is_private' => $request->is_private ?? 0,
        ];
        if ($request->hasFile('thumbnail')) {
            $filename = ImageUploadTrait::updateImage($user->thumbnail, $request->file('thumbnail'), 'thumbnail');
            $recordData['thumbnail'] = $filename;
        }
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $filename = ImageUploadTrait::updateImage($user->video, $video, 'videos');
                $recordData['videos'][] = $filename;
            }
        }

        $videoId = Video::insertGetId($recordData);
        $this->VideoAddTags($request->tags, $videoId, $user->id);
        $this->VideoAddCategory($request->category_id, $videoId, $user->id);
        $this->VideoAddSports($request->sports, $videoId, $user->id);

        if ($request->has('is_private')) {
            $this->AddPrivateVideo($request->users, $videoId);
        }

        return response()->json(['message' => 'Video added successfully.']);
    }

    public function ProfileAddVideo(Request $request)
    {
        $thumbnail = '';
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
            'difficulty_id' => 'required',
            'tags' => 'required',
            'sports' => 'required',
            'description' => 'required',
            'video' => 'required|mimes:mp4,avi,mov,wmv|max:30000',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required',
        ];

        if ($request->has('is_private')) {
            $rules['users'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $user = User::where('slug', $request->slug)->first();

        if ($request->hasFile('video')) {
            $video = ImageUploadTrait::updateImage($user->video, $request->file('video'), 'videos');
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = ImageUploadTrait::updateImage($user->thumbnail, $request->file('thumbnail'), 'thumbnail');
        }

        $recordData = [
            'title' => $request->title,
            'description' => $request->description,
            'difficulty_id' => $request->difficulty_id,
            'user_id' => $user->id,
            'is_private' => $request->is_private ?? 0,
            'length' => $request->duration,
            'thumbnail' => $thumbnail,
            'video' => $video,
        ];

        $videoId = Video::insertGetId($recordData);

        $this->VideoAddTags($request->tags, $videoId, $user->id);
        $this->VideoAddCategory($request->category_id, $videoId, $user->id);
        $this->VideoAddSports($request->sports, $videoId, $user->id);

        if ($request->has('is_private')) {
            $this->AddPrivateVideo($request->users, $videoId);
        }

        // $title =  $user->fullname . ' has uploaded a video';


        // // Query followers with the specific profession_id and get their user_id
        // $followers = Follower::where('profession_id', $user->id)->get('user_id');

        // // Extract the user_id values to an array
        // $userIds = $followers->pluck('user_id')->toArray();

        // // Implode the array to a comma-separated string
        // $userIdsString = implode(',', $userIds);

        // // add title for common function
        // addVideoNotification($title, $userIdsString);

        return response()->json(['message' => 'Video added successfully.']);
    }


    // public function ProfileAddVideo(Request $request)
    // {
    //     $thumbnail = '';
    //     $rules = [
    //         'title' => 'required',
    //         'category_id' => 'required',
    //         'difficulty_id' => 'required',
    //         'tags' => 'required',
    //         'sports' => 'required',
    //         'description' => 'required',
    //         'video' => 'required|mimes:mp4,avi,mov,wmv|max:30000',
    //         'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'duration' => 'required',
    //     ];

    //     if ($request->has('is_private')) {
    //         $rules['users'] = 'required';
    //     }

    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 401);
    //     }

    //     $user = User::where('slug', $request->slug)->first();

    //     if ($request->hasFile('video')) {
    //         $video = ImageUploadTrait::updateImage($user->video, $request->file('video'), 'videos');
    //     }

    //     if ($request->hasFile('thumbnail')) {
    //         $thumbnail = ImageUploadTrait::updateImage($user->thumbnail, $request->file('thumbnail'), 'thumbnail');
    //     }

    //     $recordData = [
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'difficulty_id' => $request->difficulty_id,
    //         'user_id' => $user->id,
    //         'is_private' => $request->is_private ?? 0,
    //         'length' => $request->duration,
    //         'thumbnail' => $thumbnail,
    //         'video' => $video,
    //     ];

    //     $videoId = Video::insertGetId($recordData);

    //     $this->VideoAddTags($request->tags, $videoId, $user->id);
    //     $this->VideoAddCategory($request->category_id, $videoId, $user->id);
    //     $this->VideoAddSports($request->sports, $videoId, $user->id);

    //     if ($request->has('is_private')) {
    //         $this->AddPrivateVideo($request->users, $videoId);
    //     }
    //     $title = 'Mr ' . $user->id . ' has uploaded a video';



    //     $followers = Follower::where('profession_id', $user->id)->get();

    //     // Extract the profession_id's to an array
    //     $professionIds = $followers->pluck('profession_id')->toArray();

    //     // Implode the array to a comma-separated string
    //     $professionIdsString = implode(',', $professionIds);

    //     // add title for common function
    //     addVideoNotification($title, $professionIdsString);

    //     return response()->json(['message' => 'Video added successfully.']);
    // }

    public function ProfileUpdateSeo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seo_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => 'The given data was invalid.',
                    'status' => 422,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        $user = User::where('slug', $request->slug)->first();

        // Update the user's SEO information
        $user->seo_title = $request->seo_title;
        $user->meta_keyword = $request->meta_keyword;
        $user->meta_description = $request->meta_description;
        $user->canonical = $request->canonical;
        $user->save();

        // You can add any additional logic or response as needed
        return response()->json(['message' => 'SEO information updated successfully']);
    }

    public function VideoAddSports($sports, $videoId, $userId)
    {
        $existingSports = VideoSport::where('video_id', $videoId)->where('user_id', $userId)->pluck('sport_id')->toArray();
        $sportsToDelete = array_diff($existingSports, $sports);

        if (!empty($sportsToDelete)) {
            VideoSport::where('video_id', $videoId)->where('user_id', $userId)->whereIn('sport_id', $sportsToDelete)->delete();
        }

        // Tags to add (tags in the request but not in the existing tags)
        $sportsToAdd = array_diff($sports, $existingSports);

        $sportData = [];
        foreach ($sportsToAdd as $value) {
            $sportData[] = ['user_id' => $userId, 'video_id' => $videoId, 'sport_id' => $value];
        }

        if (!empty($sportData)) {
            VideoSport::insert($sportData);
        }

        return true;
    }

    public function AddPrivateVideo($data, $videoId)
    {
        $privateUserData = [];
        foreach ($data as $key => $value) {
            $privateUserData[] = [
                'user_id' => $value,
                'video_id' => $videoId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!is_null($privateUserData)) {
            PrivateVideoUser::insert($privateUserData);
        }
    }

    public function VideoAddCategory($categoryIds, $videoId, $userId)
    {
        $existingCategories = UserVideoCategory::where('video_id', $videoId)->where('user_id', $userId)->pluck('category_id')->toArray();
        $categoriesToDelete = array_diff($existingCategories, $categoryIds);
        $categoriesToAdd = array_diff($categoryIds, $existingCategories);
        if (!empty($categoriesToDelete)) {
            UserVideoCategory::where('video_id', $videoId)->where('user_id', $userId)->whereIn('category_id', $categoriesToDelete)->delete();
        }
        // Prepare data for new categories
        $categoryData = [];
        foreach ($categoriesToAdd as $categoryId) {
            $categoryData[] = ['user_id' => $userId, 'video_id' => $videoId, 'category_id' => $categoryId];
        }

        // Insert new categories
        if (!empty($categoryData)) {
            UserVideoCategory::insert($categoryData);
        }
    }

    public function VideoAddTags($tags, $videoId, $userId)
    {
        $existingTags = UserTag::where('video_id', $videoId)->where('user_id', $userId)->pluck('tag_id')->toArray();
        $tagsToDelete = array_diff($existingTags, $tags);

        if (!empty($tagsToDelete)) {
            UserTag::where('video_id', $videoId)->where('user_id', $userId)->whereIn('tag_id', $tagsToDelete)->delete();
        }

        // Tags to add (tags in the request but not in the existing tags)
        $tagsToAdd = array_diff($tags, $existingTags);

        $tagData = [];
        foreach ($tagsToAdd as $value) {
            $tagData[] = ['user_id' => $userId, 'video_id' => $videoId, 'tag_id' => $value];
        }

        if (!empty($tagData)) {
            UserTag::insert($tagData);
        }

        return true;
    }

    public function GetVideoHtmlData(Request $request)
    {
        $videoId = request()->id;
        $video = Video::find($videoId);

        $user = Auth::user();
        $users = User::latest()->get()->pluck('displayname', 'id')->toArray();
        $selectedUsers = $video->privateVideoUsers()->pluck('user_id')->toArray();
        $str = $video->selectedPrivateUserString();
        $privateUserString = !is_null($str) ? $str : 'Select User';
        $sub_category1_list = [];
        $sub_category2_list = [];
        $sub_category3_list = [];
        $phisio_user_sub_category_list = [];
        $user_sub_category = UserCategory::where('user_id', Auth::user()->id)->get();
        if (count($user_sub_category) > 0) {
            foreach ($user_sub_category as $list1) {
                $phisio_user_sub_category_list[$list1->id] = Category::where('id', $list1->category_id)->first();
                $sub_category1_list[$list1->id] = VideoCategory::where('sub_category_1', $list1->category_id)
                    ->whereNull('sub_category_2')
                    ->whereNull('sub_category_3')
                    ->whereNull('sub_category_4')
                    ->get();
                if (count($sub_category1_list[$list1->id]) > 0) {
                    foreach ($sub_category1_list[$list1->id] as $list2) {
                        $sub_category2_list[$list1->id][$list2->id] = VideoCategory::where('sub_category_2', $list2->id)
                            ->whereNull('sub_category_3')
                            ->whereNull('sub_category_4')
                            ->get();
                        if (count($sub_category2_list[$list1->id][$list2->id]) > 0) {
                            foreach ($sub_category2_list[$list1->id][$list2->id] as $list3) {
                                $sub_category3_list[$list1->id][$list2->id][$list3->id] = VideoCategory::where('sub_category_3', $list3->id)
                                    ->whereNull('sub_category_4')
                                    ->get();
                            }
                        }
                    }
                }
            }
        }
        $difficulty = Difficulty::get()->pluck('name', 'id')->toArray();
        $sports = Sport::get()->pluck('name', 'id')->toArray();

        $videoSport = [];
        $videoSportNames = [];
        $videoSportsString = 'Select sport';

        $videoSports = VideoSport::where('video_id', $videoId)
            ->where('user_id', $user->id)
            ->get();

        if (count($videoSports) > 0) {
            $videoSport = $videoSports->pluck('sport_id')->toArray();
            $videoSportNames = $videoSports->pluck('UserVideoSport.name')->toArray();
            $videoSportsString = implode(', ', $videoSportNames);
        }

        $tags = Tag::where('category_id', $user->user_category_id)
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        $userTags = UserTag::where('video_id', $videoId)
            ->where('user_id', $user->id)
            ->get();
        // Get the array of tag IDs
        $userTag = $userTags->pluck('tag_id')->toArray();
        $userTagNames = $userTags->pluck('Usertag.name')->toArray();
        $userTagsString = implode(', ', $userTagNames);

        $selected_video_category_list = UserVideoCategory::where('video_id', $videoId)
            ->where('user_id', $user->id)
            ->get()
            ->pluck('category_id')
            ->toArray();
        $selected_category_names = Category::whereIn('id', $selected_video_category_list)->pluck('name');
        $selected_video_category_names = VideoCategory::whereIn('id', $selected_video_category_list)->pluck('category_name');
        $all_selected_category_names = $selected_category_names->merge($selected_video_category_names)->toArray();
        $selected_categories_string = implode(', ', $all_selected_category_names);
        $htmlContent = view('frontend.profile.video-edit-model', compact('selected_categories_string', 'userTagsString', 'sports', 'videoSport', 'selected_categories_string', 'videoSportsString', 'videoSports', 'selected_video_category_list', 'phisio_user_sub_category_list', 'sub_category1_list', 'sub_category2_list', 'sub_category3_list', 'difficulty', 'tags', 'video', 'userTag', 'users', 'selectedUsers', 'privateUserString'))->render();
        return response()->json(['html' => $htmlContent]);
    }

    public function updateVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'difficulty_id' => 'required',
            'tags' => 'required',
            'sports' => 'required',
            'description' => 'required',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:30000',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $video = Video::find($request->id);
        // prx($request->all());
        $user = User::where('id', $video->user_id)->first();

        $recordData = [
            'title' => $request->title,
            'description' => $request->description,
            'difficulty_id' => $request->difficulty_id,
            'is_private' => $request->is_private ?? 0,
            'length' => $request->duration == 0 ? $video->length : $request->duration,
        ];
        // Update video only if a new file is provided
        if ($request->hasFile('video')) {
            $filename = ImageUploadTrait::updateImage($video->video, $request->file('video'), 'videos');
            $recordData['video'] = $filename;
        }

        // Update thumbnail only if a new file is provided
        if ($request->hasFile('thumbnail')) {
            $filename = ImageUploadTrait::updateImage($video->thumbnail, $request->file('thumbnail'), 'thumbnail');
            $recordData['thumbnail'] = $filename;
        }
        $video->update($recordData);

        $this->VideoAddTags($request->tags, $request->id, $video->user_id);
        $this->VideoAddCategory($request->category_id, $request->id, $video->user_id);
        $this->VideoAddSports($request->sports, $request->id, $user->id);

        return response()->json(['message' => 'Video updated successfully.']);
    }

    public function UpdateProfileVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'difficulty_id' => 'required',
            'tags' => 'required',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:30000',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $video = Video::find($request->id);
        $user = User::where('id', $video->user_id)->first();
        $recordData = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'difficulty_id' => $request->difficulty_id,
            'tag_id' => $request->tag_id,
        ];

        if ($request->hasFile('video')) {
            $filename = ImageUploadTrait::updateImage($request->old_video, $request->file('video'), 'videos');
            $recordData['video'] = $filename;
        }

        if ($request->hasFile('thumbnail')) {
            $filename = ImageUploadTrait::updateImage($request->old_thumbnail, $request->file('thumbnail'), 'thumbnail');
            $recordData['thumbnail'] = $filename;
        }

        $video->update($recordData);
        $this->VideoAddTags($request->tags, $request->id, $video->user_id);
        $this->updateCategory($request->category_id, $request->id, $video->user_id);

        return response()->json(['message' => 'Video updated successfully.']);
    }
    public function DeleteVideo(Request $request)
    {
        $video = Video::find($request->id)->delete();
        $like = Like::where('video_id', $request->id)->delete();
        return response()->json(['message' => 'Video deleted successfully.']);
    }

    public function Physio()
    {
        $return_data['site_title'] = 'Become Physio';
        $return_data['client'] = Client::all();
        return view('frontend.becomephysio', $return_data);
    }

    public function follow(Request $request)
    {
        $data = $request->all();
        $Follower = Follower::create($data);
        return response()->json(['message' => 'You are now being followed.']);
    }

    public function unfollow()
    {
        $user_id = Auth::id();
        $profession_id = request()->input('profession_id');

        Follower::where('user_id', $user_id)->where('profession_id', $profession_id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Unfollowed successfully',
        ]);
    }

    public function SendUserOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')],
        ]);

        $otp = mt_rand(100000, 999999);
        $email = request()->email;
        $user = User::where('email', $email)->first();

        UserOtp::where('user_id', $user->id)->delete();

        UserOtp::create(['user_id' => $user->id, 'otp' => $otp]);

        $subject = 'Password reset Otp';

        $data = [
            'otp' => $otp,
            'subject' => $subject,
        ];

        try {
            Mail::send('email.sendOTP', $data, function ($message) use ($email) {
                $message->to($email)->subject('Password Reset Request');
            });

            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Email failed to send', 'error' => $e->getMessage()], 500);
        }
    }
    public function VerifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $otp = request()->get('otp');
        $optData = UserOtp::where('otp', $otp)->first();

        if (!$optData) {
            return response()->json(
                [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'otp' => ['Invalid OTP.'],
                    ],
                ],
                411,
            );
        }

        $startDate = Carbon::parse($optData->created_at);
        $endDate = Carbon::now();

        $difference = $startDate->diffInMinutes($endDate);

        if ($difference > 2) {
            $optData->delete();
            return response()->json(
                [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'otp' => ['OTP Expire plz try again.'],
                    ],
                ],
                411,
            );
        }
        return response()->json(['message' => 'otp varify successfully.', 'status' => true, 'data' => $optData], 200);
    }

    public function UserSetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password',
        ]);

        $otp = request()->get('otp');

        $optData = UserOtp::where('otp', $otp)->first();

        $password = Hash::make(request()->password);

        User::find($optData->user_id)->update(['password' => $password]);

        return response()->json(['message' => 'Password updated successfully!', 'status' => true], 200);
    }

    public function SampleEmail()
    {
        view('email\sendOTP');
    }

    public function ContactUs()
    {
        $return_data['site_title'] = 'Contact Us';
        return view('frontend.ContactUs', $return_data);
    }

    public function HowItWork()
    {
        $return_data['site_title'] = 'How It Work';
        return view('frontend.HowItWork', $return_data);
    }

    public function videoList(Request $request)
    {
        $return_data = [];
        $return_data['site_title'] = 'Videos';
        $user = auth()->user();

        $is_filter = 0;

        if ($request->filled('tag') || $request->filled('receipt_name') || $request->filled('added') || $request->filled('category') || $request->filled('sport') || $request->filled('length')) {
            $is_filter = 1;
            if ($request->query('sort_type') === null && $request->query('receipt_name') === null && $request->query('added') === null && (!$request->has('category') || empty($request->query('category')) || !array_filter($request->query('category'))) && (!$request->has('tag') || empty($request->query('tag')) || !array_filter($request->query('tag'))) && (!$request->has('sport') || empty($request->query('sport')) || !array_filter($request->query('sport'))) && (!$request->has('length') || empty($request->query('length')) || !array_filter($request->query('length'))) && (!$request->has('difficulty') || empty($request->query('difficulty')) || !array_filter($request->query('difficulty')))) {
                return redirect()->route('front.video-list');
            }
        }

        if ($user) {
            $user_id = $user->id;
            $videos = Video::with([
                'user',
                'likes' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                },
            ])->where('status', '1');
        } else {
            $videos = Video::with('user')->where('status', '1');
        }

        $TagvideoIds = collect([]);
        $categoryVideoIds = collect([]);
        $sportVideoIds = collect([]);
        $difficultyVideoIds = collect([]);
        $lengthVideoIds = collect([]);

        if (isset($request->tag)) {
            $tagIds = is_array($request->tag) ? $request->tag : [$request->tag];
            $TagvideoIds = UserTag::whereIn('tag_id', $tagIds)->pluck('video_id');
        }

        if (isset($request->sport)) {
            $sportIds = is_array($request->sport) ? $request->sport : [$request->sport];
            $sportVideoIds = VideoSport::whereIn('sport_id', $sportIds)->pluck('video_id');
        }

        if (isset($request->category) && count($request->category) > 0) {
            $categoryIds = is_array($request->category) ? $request->category : [$request->category];
            $categoryVideoIds = UserVideoCategory::whereIn('category_id', $request->category)->pluck('video_id');
        }

        if (isset($request->difficulty) && count($request->difficulty) > 0) {
            $difficultyIds = is_array($request->difficulty) ? $request->difficulty : [$request->difficulty];
            $difficultyVideoIds = Video::whereIn('difficulty_id', $difficultyIds)->pluck('id');
        }
        if (isset($request->length) && count($request->length) > 0) {
            $lengthIds = is_array($request->length) ? $request->length : [$request->length];

            $length = [];

            // Flag to indicate whether 15 is present in the array
            $includeGreater = false;

            foreach ($lengthIds as $item) {
                $parts = explode('-', $item);
                if (count($parts) >= 2) {
                    [$start, $end] = $parts;
                    if ($end !== '') {
                        // Include lengths between $start and $end
                        $length = array_unique(array_merge($length, range($start, $end)));
                        if ($start <= 15 && $end >= 15) {
                            $includeGreater = true;
                        }
                    } else {
                        // If end value is not set, include lengths greater than $start
                        if ($start <= 15) {
                            $includeGreater = true;
                        }
                    }
                }
            }

            // If 15 is present, include lengths greater than 15
            if ($includeGreater) {
                $length = array_merge($length, range(16, $end ?? PHP_INT_MAX));
            }

            $lengthVideoIds = Video::whereIn('length', $length)->pluck('id');
        }

        $mergedVideoIds = array_merge($TagvideoIds->isNotEmpty() ? $TagvideoIds->toArray() : [], $sportVideoIds->isNotEmpty() ? $sportVideoIds->toArray() : [], $categoryVideoIds->isNotEmpty() ? $categoryVideoIds->toArray() : [], $difficultyVideoIds->isNotEmpty() ? $difficultyVideoIds->toArray() : [], $lengthVideoIds->isNotEmpty() ? $lengthVideoIds->toArray() : []);

        $mergedVideoIds = array_unique($mergedVideoIds);

        if ($is_filter === 1) {
            if (count($mergedVideoIds) > 0) {
                $videos = $videos->whereIn('id', $mergedVideoIds);
            } else {
                // prx([$videos->get(),$is_filter]);
                // $videos = $videos->whereIn('id', [0]);
            }
        }

        if (isset($request->difficulty)) {
            $difficultyIds = is_array($request->difficulty) ? $request->difficulty : [$request->difficulty];
            $videos = $videos->whereIn('difficulty_id', $difficultyIds);
        }

        if (isset($request->receipt_name)) {
            $username = $request->receipt_name;
            $videos = $videos->whereHas('user', function ($query) use ($username) {
                $query->where(function ($subquery) use ($username) {
                    $subquery
                        ->where('fullname', 'like', '%' . $username . '%')
                        ->orWhere('displayname', 'like', '%' . $username . '%')
                        ->orWhere('username', 'like', '%' . $username . '%');
                });
            });
        }

        // if (isset($request->length)) {
        //     $lengthRanges = $request->length;
        //     $videos = $videos->where(function ($query) use ($lengthRanges) {
        //         foreach ($lengthRanges as $range) {
        //             if (strpos($range, '-') !== false) {
        //                 [$min, $max] = explode('-', $range);
        //                 $minSeconds = $min * 60; // convert minutes to seconds
        //                 $maxSeconds = $max * 60; // convert minutes to seconds
        //                 $query->orWhereBetween('length', [$minSeconds, $maxSeconds]);
        //             } else {
        //                 $valueSeconds = $range * 60; // convert minutes to seconds
        //                 $query->orWhere('length', '=', $valueSeconds);
        //             }
        //         }
        //     });
        // }
        // prx([$videos->get(),$is_filter]);
        if (isset($request->added)) {
            $addedIds = is_array($request->added) ? $request->added : [$request->added];
            if (in_array('today', $addedIds)) {
                $videos = $videos->whereDate('created_at', Carbon::today());
            }

            if (in_array('this_week', $addedIds)) {
                $videos = $videos->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            if (in_array('this_month', $addedIds)) {
                $videos = $videos->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
            }
        }

        $videos = $videos->withCount('videoView');

        $videos =   $videos->orderByDesc('is_ads');
        $videos =   $videos->orderByDesc('updated_at');
        if (isset($request->sort_type)) {
            if ($request->sort_type == '0') {
                $videos = $videos->orderByDesc('video_view_count');
            } elseif ($request->sort_type == '1') {
                $videos = $videos->orderBy('length', 'desc');
            } elseif ($request->sort_type == '2') {
                $videos = $videos->orderBy('length', 'asc');
            } elseif ($request->sort_type == '3') {
            }
        } else {
            $videos = $videos->orderByDesc('video_view_count');
        }
        if (isset($request->search)) {
            $searchTerm = $request->search;
            $videos = $videos->where(function ($query) use ($searchTerm) {
                $query
                    ->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $perPage = 12;


        $videos = $videos->paginate($perPage);

        if (isset($request->tag)) {
            $videos->appends(['tag' => $request->tag]);
        }
        if (isset($request->sport)) {
            $videos->appends(['sport' => $request->sport]);
        }
        if (isset($request->category)) {
            $videos->appends(['category' => $request->category]);
        }
        if (isset($request->difficulty)) {
            $videos->appends(['difficulty' => $request->difficulty]);
        }
        if (isset($request->receipt_name)) {
            $videos->appends(['receipt_name' => $request->receipt_name]);
        }

        if (isset($request->length)) {
            $videos->appends(['length' => $request->length]);
        }
        if (isset($request->added)) {
            $videos->appends(['added' => $request->added]);
        }
        if (isset($request->sort_type)) {
            $videos->appends(['sort_type' => $request->sort_type]);
        }
        if (isset($request->search)) {
            $videos->appends(['search' => $request->search]);
        }

        // prx($videos);
        $return_data['video'] = $videos;
        $return_data['pagination'] = $videos->links();
        $return_data['tag'] = Tag::get();
        $return_data['sport'] = Sport::get();
        $return_data['difficulty'] = Difficulty::get();
        return view('frontend.VideoList', $return_data);
    }

    public function UnLikeVideo()
    {
        $user_id = Auth::id();
        $video_id = request()->input('video_id');

        Like::where('user_id', $user_id)->where('video_id', $video_id)->delete();

        return response()->json(
            [
                'message' => 'LikedVideo successfully Delete',
            ],
            200,
        );
    }

    public function LikeVideo(Request $request)
    {
        $data = $request->all();

        $count = Like::where('user_id', $request->user_id)
            ->where('video_id', $request->video_id)
            ->withTrashed()
            ->count();

        Like::updateOrInsert($data);

        if ($count == 0) {
            $user_id = Auth::id();
            $video_id = $request->video_id;

            $data = [
                'user_id' => $user_id,
                'video_id' => $video_id,
            ];
            VideoView::create($data);
        }

        return response()->json(['message' => 'like action successful'], 200);
    }

    public function uploadDocument(Request $request)
    {
        $files = $request->file('base_documents');

        if ($request->hasFile('base_documents') && is_array($files)) {
            $uploadedFiles = []; // Array to store uploaded filenames
            foreach ($files as $file) {
                $filename = ImageUploadTrait::uploadImage($file, 'userdocuments');
                $data['document_name'] = $filename;
                $data['user_id'] = Auth::user()->id;
                // Create a new user record
                $userdocu = UserDocument::create($data);
            }
            $user = Auth::user(); // Get the authenticated user
            $user->update(['apply_base' => 0]);

            return response()->json(['message' => ' Success! Documents is Under Review With Admin.', 'filenames' => $uploadedFiles], 200);
        } else {
            return response()->json(['error' => 'Document Field Required.'], 400);
        }
    }

    public function DeleteThumbnail(Request $request)
    {
        $id = $request->input('id');
        $video = Video::where('id', $id)->first();
        if ($video) {
            ImageUploadTrait::removeImage($video->thumbnail, 'thumbnail');
            $video->update(['thumbnail' => null]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function DeleteSlider(Request $request)
    {
        $id = $request->input('id');
        $sliderprofilevideo = UserSlider::where('id', $id)->first();

        if ($sliderprofilevideo) {
            ImageUploadTrait::removeImage($sliderprofilevideo->name, 'name');
            $sliderprofilevideo->delete('name');
            return response()->json(['success' => true]);
            // prx(10);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function ChangePassword()
    {
        return view('frontend.partial.changepassword');
    }

    public function UpdatePassword(Request $request)
    {
        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->currentpassword, Auth::user()->password)) {
            return redirect()
                ->back()
                ->withErrors(['currentpassword' => 'The provided current password does not match your password.']);
        }

        // Validate the request data
        $request->validate([
            'currentpassword' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Update the user's password
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function VideoPayment(Ads $ads, Video $video)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $ads->video_adds * 100;
        $video_id = $video->id;
        $currency = 'inr';
        $payment_method_types = ['card'];
        $user_id = Auth::id();
        try {
            $session = Session::create([
                'payment_method_types' => $payment_method_types,
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => $currency,
                            'product_data' => [
                                'name' => '12',
                            ],
                            'unit_amount' => $amount,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment.success.video') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.fail.video') . '?session_id={CHECKOUT_SESSION_ID}',
                'metadata' => [
                    'ads' => $ads,
                    'user_id' => $user_id,
                    'video_id' => $video_id,
                    'amount' => $amount,
                ],
            ]);
            return redirect()->to($session->url);
        } catch (ApiErrorException $e) {
            return redirect()
                ->route('payment.fail.video')
                ->withErrors(['message' => 'Payment processing failed.']);
        }
    }


    public function VideoPaymentSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->input('session_id');

        try {
            $session = Session::retrieve($sessionId);

            $metadata = $session->metadata;
            $user_id = $session->metadata->user_id;
            $video_id = $session->metadata->video_id;
            $amount = $session->metadata->amount;
            $amount = $amount / 100;
            $ads = json_decode($metadata->ads);


            $data = [
                'video_id' => $video_id,
                'amount' => $amount,
                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            // Update user with the provided data
            $videoads = VideoAds::create($data);
            $video = Video::where('id', $video_id)->first();
            $video->update(['is_ads' => '1', 'updated_at' => now()]);

            $request->session()->put('video_purchase', 1);
            $user = User::find($user_id);
            // prx($video);
            // prx($video);
            return redirect()->route('front.physio.bio', ['slug' => $user->slug]);
        } catch (ApiErrorException $e) {
            // Handle error
            return redirect()
                ->route('payment.fail.video')
                ->withErrors(['message' => 'Payment processing failed.']);
        }
    }

    public function VideoPaymentFail(Request $request)
    {
        $user = Auth::user();
        $request->session()->put('video_purchase', 0);
        return redirect()->route('front.physio.bio', ['slug' => $user->slug]);
    }


    //Profile Ads code

    public function ProfilePayment(Ads $ads, User $profile)
    {
        // dd($ads, $profile);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $ads->profile_adds * 100;
        $profile_id = $profile->id;
        $currency = 'inr';
        $payment_method_types = ['card'];
        // $user_id = Auth::id();
        try {
            $session = Session::create([
                'payment_method_types' => $payment_method_types,
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => $currency,
                            'product_data' => [
                                'name' => '12',
                            ],
                            'unit_amount' => $amount,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment.success.profile') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.fail.profile') . '?session_id={CHECKOUT_SESSION_ID}',
                'metadata' => [
                    'ads' => $ads,
                    'user_id' => $profile_id,
                    'profile_id' => $profile_id,
                    'amount' => $amount,
                ],
            ]);
            return redirect()->to($session->url);
        } catch (ApiErrorException $e) {
            return redirect()
                ->route('payment.fail.profile')
                ->withErrors(['message' => 'Payment processing failed.']);
        }
    }




    public function ProfilePaymentSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->input('session_id');

        try {
            $session = Session::retrieve($sessionId);


            $metadata = $session->metadata;
            $user_id = $session->metadata->user_id;
            // $video_id = $session->metadata->video_id;
            $amount = $session->metadata->amount;
            $amount = $amount / 100;
            $ads = json_decode($metadata->ads);
            // dd($metadata);


            $data = [
                // 'video_id' => $video_id,
                'amount' => $amount,
                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            // Update user with the provided data
            $profileAds = ProfileAds::create($data);
            $profile = User::where('id', $user_id)->first();
            $profile->update(['is_ads' => '1', 'updated_at' => now()]);

            $request->session()->put('profile_purchase', 1);
            $user = User::find($user_id);
            // prx($video);
            // prx($video);
            return redirect()->route('front.physio.bio', ['slug' => $user->slug]);
        } catch (ApiErrorException $e) {
            // Handle error
            return redirect()
                ->route('payment.fail.profile')
                ->withErrors(['message' => 'Payment processing failed.']);
        }
    }

    public function ProfilePaymentFail(Request $request)
    {
        $user = Auth::user();
        $request->session()->put('profile_purchase', 0);
        return redirect()->route('front.physio.bio', ['slug' => $user->slug]);
    }



    public function testGoogleMeet()
    {
        return view('googl-meet');
    }
    public function UnLikeProfessional(Request $request)
    {
        $data = $request->all();
        UserLike::where('professional_id', $request->professional_id)
            ->where('user_id', $request->user_id)
            ->delete();
        return response()->json(['message' => 'Professional Un liked successfully.'], 200);
    }
    public function LikeProfessional(Request $request)
    {
        $data = $request->all();
        $data['created_at'] = now();
        $existing_user = UserLike::where('professional_id', $request->professional_id)
            ->where('user_id', $request->user_id)
            ->first();

        if (!$existing_user) {
            UserLike::insert($data);
        }
        return response()->json(['message' => 'Professional liked successfully.'], 200);
    }

    public function MyFavourites(Request $request)
    {
        $favorites_list = UserLike::with('Professional')->where('user_id', Auth::id())->get();
        return view('frontend.my-favourites', compact('favorites_list'));
    }

    public function MyPlans(Request $request)
    {
        $subscriptions = Subscription::all();
        return view('frontend.my-plans', compact('subscriptions'));
    }

    public function GetAppointment(Request $request)
    {
        $active_type = 0;
        $userId = Auth::user()->id;
        $userMeeting = MeetingUser::where('user_id', $userId)->get();
        $userCalenderIds = $userMeeting->pluck('user_calender_id');
        $meeting = UserCalender::with('organizer')->whereIn('id', $userCalenderIds)->get();
        $organizerCreateMeetings = UserCalender::where('organizer_id', $userId)->get();
        $users = User::latest()->get()->pluck('displayname', 'id')->toArray();
        return view('frontend.online-appointment', compact('meeting', 'users', 'organizerCreateMeetings', 'active_type'));
    }

    public function OnlineAppointments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'link' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userID = $request->user_id;
        $date = $request->date;
        $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('h:i A');
        $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('h:i A');

        $input = [];
        $input['organizer_id'] = Auth::user()->id;
        $input['date'] = $date;
        $input['start_time'] = $start_time;
        $input['end_time'] = $end_time;
        $input['description'] = $request->description;
        $input['link'] = $request->link;

        $userCalender = UserCalender::create($input);
        $userinput = [];
        foreach ($userID as $data) {
            $userinput['user_calender_id'] = $userCalender->id;
            $userinput['user_id'] = $data;
            $meetingUser = MeetingUser::create($userinput);
        }
        if (!$userCalender) {
            session()->flash('error', 'Failed to create appointment');
            return redirect()->back()->with('active_type', 1)->withInput();
        }
        return redirect()->back()->with('active_type', 1)->withInput();
    }

    public function editAppointment(Request $request)
    {
        $appointment = UserCalender::with('meetingUser')
            ->where('id', $request->meeting_id)
            ->first();
        // prx($appointment);
        $users = User::latest()->get()->pluck('displayname', 'id')->toArray();
        $selectedUsers = $appointment->meetingUser->pluck('user_id')->toArray();
        $htmlContent = view('frontend.edit-appointment', compact('appointment', 'users', 'selectedUsers'))->render();
        return response()->json(['html' => $htmlContent]);
    }

    public function updateAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userID = $request->users;
        $date = $request->date;
        $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('h:i A');
        $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('h:i A');

        $input = [];
        $input['organizer_id'] = Auth::user()->id;
        $input['date'] = $date;
        $input['start_time'] = $start_time;
        $input['end_time'] = $end_time;
        $input['description'] = $request->description;
        $input['link'] = $request->link;

        $userCalender = UserCalender::where('id', $request->id)->update($input);

        $meeting = MeetingUser::where('user_calender_id', $request->id)->delete();

        $userinput = [];
        foreach ($userID as $data) {
            $userinput['user_calender_id'] = $request->id;
            $userinput['user_id'] = $data;
            $meetingUser = MeetingUser::create($userinput);
        }

        if (!$userCalender) {
            session()->flash('error', 'Failed to update appointment');
            return redirect()->back();
        }

        return redirect()->back()->with('active_type', 1)->withInput();
    }

    public function deleteAppointment(Request $request)
    {
        $appointment = UserCalender::find($request->meeting_id);
        $meeting = MeetingUser::where('user_calender_id', $request->meeting_id)->delete();

        if ($appointment) {
            $appointment->delete();
            session()->flash('active_type', 1);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    public function pages(Request $request)
    {
        $page = Page::where('slug', $request->slug)->first();
        // prx($page);
        // $categories = Category::where('category_id', null)->get();

        return view('frontend.pages', compact('page'));
    }
}
