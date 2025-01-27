<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\{Category, SubCategory, Setting, Video, Notification, VideoCategory, User, HomePageSetting, Page, Sport, SubscriptionDescription, Subscription};
use Illuminate\Support\Facades\Storage;

$i = 0;

// if (!function_exists('asset')) {
//     function asset($path, $secure = null)
//     {
//         // Check if the environment or configuration requires S3
//         if (config('filesystems.default') === 's3') {
//             return Storage::disk('s3')->url($path);
//         }

//         // Default asset behavior for local storage
//         return app('url')->asset($path, $secure);
//     }
// }
// if (!function_exists('public_path')) {
//     function public_path($path, $secure = null)
//     {
//         // Check if the environment or configuration requires S3
//         if (config('filesystems.default') === 's3') {
//             return Storage::disk('s3')->url($path);
//         }

//         // Default asset behavior for local storage
//         return app('url')->public_path($path, $secure);
//     }
// }





function prx($data)
{
    echo '<pre>';

    print_r($data);

    die();
}

function uploadImage($file, $path)
{
    try {
        $destinationPath = public_path($path);

        $filename = time() . '_' . $file->getClientOriginalName();

        $path = $path . '/' . $filename;

        $filename = str_replace(' ', '', $filename);

        $file->move($destinationPath, $filename);

        return $filename;
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

function AddDateTime($data, $action = 'store')
{
    $data = $data->except('_token');

    $time = GetDateTime();

    $data['updated_at'] = $time;

    if ($action == 'store') {
        $data['created_at'] = $time;
    }

    return $data;
}

function AddDateTimeInArray(array $data, string $action = 'store'): array
{
    $time = GetDateTime();
    $data['updated_at'] = $time;
    if ($action == 'store') {
        $data['created_at'] = $time;
    }

    return $data;
}

function GetDateTime()
{
    $date_time = date('Y-m-d H:i:s');

    return $date_time;
}

function CheckPermissionForUser($module, $operation)
{
    $role_data = Auth::user()->role()->first();

    // $role_data = Auth::user();

    if ($role_data) {
        $role = json_decode($role_data->permissions);

        if (property_exists($role, $module) && in_array($operation, $role->$module)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function GetCategoryList()
{
    $front_category_list = Category::whereNull('category_id')->get();

    return $front_category_list;
}

function GetSportList()
{
    $sport_list = Sport::get();
    return $sport_list;
}

function GetCategoryTree($data = null)
{
    // Fetch main categories
    $category_list = Category::whereNull('category_id')->get();
    $data['category_list'] = $category_list;

    // Fetch subcategories for each main category
    $data['sub_category_list'] = [];
    foreach ($category_list as $list) {
        $data['sub_category_list'][$list->id] = Category::where('category_id', $list->id)->get();
        // Fetch sub-subcategories for each subcategory
        if (count($data['sub_category_list'][$list->id]) > 0) {
            foreach ($data['sub_category_list'][$list->id] as $list1) {
                $data['sub_category1_list'][$list->id][$list1->id] = VideoCategory::where('sub_category_1', $list1->id)
                    ->whereNull('sub_category_2')
                    ->whereNull('sub_category_3')
                    ->whereNull('sub_category_4')
                    ->get();
                if (count($data['sub_category1_list'][$list->id][$list1->id]) > 0) {
                    foreach ($data['sub_category1_list'][$list->id][$list1->id] as $list2) {
                        $data['sub_category2_list'][$list->id][$list1->id][$list2->id] = VideoCategory::where('sub_category_2', $list2->id)
                            ->whereNull('sub_category_3')
                            ->whereNull('sub_category_4')
                            ->get();
                    }
                }
            }
        }
    }
    // prx($data['sub_category1_list']);

    return $data;
}

// function GetSubCategoryTree($data)
// {
//     // Fetch main categories
//     $category_list = Category::whereNull('category_id')->get();
//     $data['category_list'] = $category_list;

//     // Fetch subcategories for each main category
//     $data['sub_category_list'] = [];
//     foreach ($category_list as $list) {
//         $data['sub_category_list'][$list->id] = Category::where('category_id', $list->id)->get();

//         // Fetch sub-subcategories for each subcategory
//         if (count($data['sub_category_list'][$list->id]) > 0) {
//             foreach ($data['sub_category_list'][$list->id] as $list1) {
//                 $data['sub_category1_list'][$list->id][$list1->id] = VideoCategory::where('sub_category_1', $list1->id)->get();

//                 if (count($data['sub_category1_list'][$list->id][$list1->id]) > 0) {
//                     foreach ($data['sub_category1_list'][$list->id][$list1->id] as $list2) {
//                         $data['sub_category2_list'][$list->id][$list1->id][$list2->id] = VideoCategory::where('sub_category_2', $list2->id)->get();
//                     }
//                 }
//             }
//         }
//     }

//     return $data;
// }

function GetSubCategory($id): array
{
    $subcategory = SubCategory::where('sub_category_id', $id);

    $subcategory_data['data'] = $subcategory->get();

    $subcategory_data['count'] = $subcategory->count();

    return $subcategory_data;
}

function GetSlug($data)
{
    $fullSlug = Str::lower($data['fullname']);
    $fullSlug = strtr($fullSlug, ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u']);
    // Remove non-alphanumeric characters
    $fullSlug = preg_replace('/[^a-zA-Z0-9]/', ' ', $fullSlug);
    $fullSlug = str_replace(' ', '-', $fullSlug);
    $slug_count = User::where('slug', $fullSlug)->count();

    if ($slug_count > 0) {
        $fullSlug = $fullSlug . '-' . rand(11, 99); // Appending a random number between 11 and 99
        // prx($fullSlug);
    }
    return $fullSlug;
}

function GetSetting($key)
{
    $settingData = Setting::first();
    // prx($settingData);
    if ($settingData) {
        $value = $settingData->$key;
    } else {
        $value = '';
    }

    return $value;
}

function Getyearofexperience()
{
    $count = [];
    for ($i = 1; $i <= 40; $i++) {
        $count[$i] = $i;
    }
    return $count;
}

function GetHomePageSetting($key)
{
    $homepagesettingData = HomePageSetting::first();

    if ($homepagesettingData) {
        $value = $homepagesettingData->$key;
    } else {
        $value = '';
    }

    return $value;
}

// function VideoNotification()
// {
//     $userId = Auth::user()->id;
//     $notifications = Notification::where('to_user_id', $userId)->get();
//     return $notifications;
// }

function VideoNotification()
{
    $userId = Auth::user()->id;

    // Retrieve all notifications where 'to_user_id' may include the user ID
    // $notifications = Notification::where('to_user_id', $userId)
    //     ->orderBy('created_at', 'desc')
    //     ->limit(4)
    //     ->get();

    $notifications = Notification::where('to_user_id', $userId)
        ->orderBy('is_read', 'asc') // 0 (unread) will come before 1 (read)
        ->orderBy('created_at', 'desc') // Most recent notifications first
        ->limit(4) // Fetch a total of 6 notifications
        ->get();


    // Filter notifications where 'to_user_id' contains the current user ID


    return $notifications;
}

// function VideoNotification()
// {
//     $userId = Auth::user()->id;

//     // Retrieve all notifications where 'to_user_id' may include the user ID
//     $notifications = Notification::all();

//     // Filter notifications where 'to_user_id' contains the current user ID and 'is_read' is 0
//     $filteredNotifications = $notifications->filter(function ($notification) use ($userId) {
//         $userIds = explode(',', $notification->to_user_id);
//         return in_array($userId, $userIds) && $notification->is_read == 0;
//     });

//     return $filteredNotifications;
// }


// function VideoNotification()
// {
//     $userId = Auth::user()->id;

//     // Retrieve all notifications where 'to_user_id' may include the user ID
//     $notifications = Notification::all();
//     foreach($notifications as $notific){
//         $allIds = explode(',',$notific->to_user_id);
//         dd($allIds);
//     }


//     // Filter notifications where 'to_user_id' contains the current user ID
//     $filteredNotifications = $notifications->filter(function ($notification) use ($userId) {
//         $userIds = explode(',', $notification->to_user_id);
//         return in_array($userId, $userIds);
//     });

//     return $filteredNotifications;
// }



function addVideoNotification($title, $userIdsString, $professionId)
{
    // $fromUserId = Auth::user()->id;
    $fromUserId = $professionId;
    $toUserId = $userIdsString;
    $title = $title;

    $notification = new Notification();
    $notification->from_user_id = $fromUserId;
    $notification->to_user_id = $toUserId;
    $notification->description = $title;
    $notification->date = carbon::now();
    $notification->save();
}
// function addVideoNotification($title, $professionIdsString)
// {
//     $fromUserId = Auth::user()->id;
//     $toUserId = $professionIdsString;
//     $title = $title;

//     $notification = new Notification();
//     $notification->from_user_id = $fromUserId;
//     $notification->to_user_id = $toUserId;
//     $notification->description = $title;
//     $notification->save();
// }

function GetSlugData($data)
{
    $fullSlug = Str::lower($data['title']);
    $fullSlug = strtr($fullSlug, ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u']);
    // Remove non-alphanumeric characters
    $fullSlug = preg_replace('/[^a-zA-Z0-9]/', ' ', $fullSlug);
    $fullSlug = str_replace(' ', '-', $fullSlug);
    $slug_count = Page::where('slug', $fullSlug)->count();

    if ($slug_count > 0) {
        $fullSlug = $fullSlug . '-' . rand(11, 99); // Appending a random number between 11 and 99
        // prx($fullSlug);
    }
    return $fullSlug;
}

function getCategoryName($user_category_id)
{
    // Assuming your User model has a 'name' attribute
    $user = Category::find($user_category_id);
    $category_name = '';
    if ($user) {
        $category_name = $user->name;
    }

    return $category_name;
}
function getMediaType($file)
{
    $mimeType = $file->getClientMimeType();

    $type = '';
    if (strpos($mimeType, 'image/') === 0) {
        $type = 'image';
    } elseif (strpos($mimeType, 'video/') === 0) {
        $type = 'video';
    } else {
        $type = 'other';
    }
    return $type;
}


function getsubscribelist()
{

    $return_data['subscription'] = Subscription::where('status', '1')
        ->with('subscriptionDescription') // Assuming 'subscriptionDescription' is the relationship name
        ->get();
    // dd($return_data['subscription']);
    return $return_data['subscription'];
}
