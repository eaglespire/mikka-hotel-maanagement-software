<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Feature;
use App\Models\Pricing;
use App\Models\Room;
use App\Services\CacheKeys;
use App\Services\FullPageCache;
use App\Services\Permissions;
use App\Traits\CloudinaryFileServer;
use App\Traits\CustomPagination;
use App\Traits\HasInternet;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends BaseController
{
    use CustomPagination, HasInternet, CloudinaryFileServer;
    public function Features()
    {
        $this->data['title'] = "Room Features";
        $this->data['titleText'] = "Available Room Features";
        $features = Cache::remember(CacheKeys::FEATURE_CACHE, now()->addDays(30), function (){
            return Feature::get();
        });
        return view('dashboard.feature.index',$this->data,compact('features'));
    }
    public function CreateFeature()
    {
        $this->authorize(Permissions::CAN_CREATE_ROOM_FEATURES);
        $this->data['title'] = "Add Feature";
        $this->data['titleText'] = "Add New Room Feature";
        return view('dashboard.feature.create',$this->data);
    }
    public function StoreFeature(Request $request)
    {
        $this->authorize(Permissions::CAN_CREATE_ROOM_FEATURES);
        $request->validate([
            'name'=>['required','string','max:255','min:3'],
            'icon'=>['required']
        ]);
        $feature = Feature::create([
            'name' => ucwords($request['name']),
            'icon' => $request['icon']
        ]);
        if ($feature){
            toast('Feature added','success');
        }else{
            toast('An error occurred','error');
        }
        return back();
    }
    public function UpdateFeature(Request $request, int $id)
    {
        $this->authorize(Permissions::CAN_UPDATE_ROOM_FEATURES);
        $request->validate([
            'name'=>['required','string','max:255','min:3'],
            'icon'=>['nullable']
        ]);
        try {
            $feature = Feature::findOrFail($id);
            $feature->update([
                'name' => $request['name'],
                'icon' => $request['icon'] == null ? $feature->icon : $request['icon']
            ]);
            toast('Updated successfully','success');
        }  catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('An error has occurred','error');
        }
        return back();
    }
    public function DeleteFeature(int $id)
    {
        $this->authorize(Permissions::CAN_DELETE_ROOM_FEATURES);
        try {
            $feature = Feature::findOrFail($id);
            $feature->delete();
            toast('Deleted...','success');
        }  catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('Feature not found','error');
        }
        return back();
    }
    public function Rooms()
    {
        $this->data['categoriesCount'] = Pricing::count();
        $this->data['title'] = "Rooms";
        $this->data['titleText'] = "Available Rooms";

//        $rooms = Cache::remember(CacheKeys::ROOM_CACHE, now()->addDays(30),static function (){
//            return Room::get();
//        });
        /*
         * Convert the collection to a plain PHP Array
         */
//        $arr = $rooms->toArray();
//        $items = $this->paginate($arr,20);
        // Set  pagination path/route.
//        $items->withPath(route('b-rooms'));
        $this->data['items'] = Room::paginate(10);
        return view('dashboard.room.index',$this->data);
    }
    public function AddRoom(Request $request)
    {
        $this->authorize(Permissions::CAN_CREATE_ROOMS);
        $this->data['title'] = "New room";
        $this->data['titleText'] = "Add a new room";
        $categories = Cache::remember(CacheKeys::PRICING_CACHE, now()->addDays(30), function (){
            return Pricing::get();
        });
        $this->data['categories'] = $categories;
        return view('dashboard.room.create',$this->data);
    }
    public function StoreRoom(StoreRoomRequest $request)
    {
        $this->authorize(Permissions::CAN_CREATE_ROOMS);
        if (!$this->ConnectedToInternet()){
            toast('Ooops!!!, No or weak Internet','error');
            return back();
        }
        try {
            DB::transaction(function () use ($request){
                $firstImageUrl = $this->SaveFile('rooms',1200,800,'firstImage');
                $secondImageUrl = $this->SaveFile('rooms',400,300,'secondImage');
                $thirdImageUrl = $this->SaveFile('rooms',400,300,'thirdImage');
                $fourthImageUrl = $this->SaveFile('rooms',400,300,'fourthImage');
                $fifthImageUrl = $this->SaveFile('rooms',400,300,'fifthImage');
                $sixthImageUrl = $this->SaveFile('rooms',400,300,'sixthImage');

                $room =  Room::create([
                    'title'=>$request['title'],
                    'pricing_id' => $request['category'],
                    'extraInfo' => $request['adesc'],
                    'description' => $request['desc'],
                    'price' => $request['price'],
                    'roomNumber' => $request['roomNumber'],
                    'firstImage'=> empty($firstImageUrl) ? null : $firstImageUrl[1] ,
                    'secondImage' => empty($secondImageUrl) ? null : $secondImageUrl[1],
                    'thirdImage' => empty($thirdImageUrl) ? null : $thirdImageUrl[1],
                    'fourthImage' => empty($fourthImageUrl) ? null : $fourthImageUrl[1],
                    'fifthImage' => empty($fifthImageUrl) ? null : $fifthImageUrl[1],
                    'sixthImage' => empty($sixthImageUrl) ? null : $sixthImageUrl[1],
                    'f1_public_id' => empty($firstImageUrl) ? null : $firstImageUrl[0],
                    'f2_public_id' => empty($secondImageUrl) ? null : $secondImageUrl[0],
                    'f3_public_id' => empty($thirdImageUrl) ? null : $thirdImageUrl[0],
                    'f4_public_id' => empty($fourthImageUrl) ? null : $fourthImageUrl[0],
                    'f5_public_id' => empty($fifthImageUrl) ? null : $fifthImageUrl[0],
                    'f6_public_id' => empty($sixthImageUrl) ? null : $sixthImageUrl[0],
                ]);
                if (!$room){
                    throw new \Exception('Room not created');
                }
                $room->update([
                    'slug'=>Str::slug($room->title).'-'.$room->id.'-'.Str::slug($room->category)
                ]);
            });
            Artisan::call('cache:clear');
            toast('Room created','success');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            toast('Something went wrong','error');
        }
        return back();
    }
    public function Room(string $slug)
    {
        $room = Room::where('slug',$slug)->first();
        $this->data['title'] = (string)$room->title;
        $this->data['titleText'] = "Single room";
        return view('dashboard.room.show',$this->data,compact('room'));
    }
    public function EditRoom(string $slug)
    {
        $this->authorize(Permissions::CAN_UPDATE_ROOMS);
        $room = Room::where('slug',$slug)->first();
        $this->data['title'] = (string)$room->title;
        $this->data['titleText'] = "Edit Single room";
        $categories = Cache::remember(CacheKeys::PRICING_CACHE, now()->addDays(30), function (){
            return Pricing::get();
        });
        $this->data['categories'] = $categories;
        $this->data['room'] = $room;
        return view('dashboard.room.edit',$this->data);
    }
    public function UpdateRoom(UpdateRoomRequest $request, string $slug)
    {
        $this->authorize(Permissions::CAN_UPDATE_ROOMS);
        if (!$this->ConnectedToInternet()){
            toast('Ooops!!!, No or weak Internet','error');
            return back();
        }
        try {
            $room = Room::where('slug',$slug)->firstOrFail();

            DB::transaction(function () use ($room, $request) {
                $firstImageResponse = $this->CheckImageWasUploaded('firstImage',$room['f1_public_id'],'rooms',1200,800);
                $secondImageResponse = $this->CheckImageWasUploaded('secondImage',$room['f2_public_id'],'rooms',400,300);
                $thirdImageResponse = $this->CheckImageWasUploaded('thirdImage',$room['f3_public_id'],'rooms',400,300);
                $fourthImageResponse = $this->CheckImageWasUploaded('fourthImage',$room['f4_public_id'],'rooms',400,300);
                $fifthImageResponse = $this->CheckImageWasUploaded('fifthImage',$room['f5_public_id'],'rooms',400,300);
                $sixthImageResponse = $this->CheckImageWasUploaded('sixthImage',$room['f6_public_id'],'rooms',400,300);

                $updateResponse = $room->update([
                    'title'=>$request['title'],
                    'pricing_id' => $request['category'],
                    'extraInfo' => $request['adesc'],
                    'description' => $request['desc'],
                    'roomShown' => $request['publish'],
                    'price' => $request['price'],
                    'roomNumber' => $request['roomNumber'],
                    'firstImage'=> $firstImageResponse !== null ?  $firstImageResponse[1] : $room['firstImage'] ,
                    'secondImage' => $secondImageResponse !== null ? $secondImageResponse[1] : $room['secondImage'] ,
                    'thirdImage' => $thirdImageResponse !== null ? $thirdImageResponse[1] : $room['thirdImage'] ,
                    'fourthImage' => $fourthImageResponse !== null ? $fourthImageResponse[1] : $room['fourthImage'] ,
                    'fifthImage' => $fifthImageResponse !== null ? $fifthImageResponse[1] : $room['fifthImage'] ,
                    'sixthImage' => $sixthImageResponse !== null ? $sixthImageResponse[1] : $room['sixthImage'] ,
                    'f1_public_id' => $firstImageResponse !== null ? $firstImageResponse[0] : $room['f1_public_id'] ,
                    'f2_public_id' => $secondImageResponse !== null ? $secondImageResponse[0] : $room['f2_public_id'] ,
                    'f3_public_id' => $thirdImageResponse !== null ? $thirdImageResponse[0] : $room['f3_public_id'] ,
                    'f4_public_id' => $fourthImageResponse !== null ? $fourthImageResponse[0] : $room['f4_public_id'] ,
                    'f5_public_id' => $fifthImageResponse !== null ? $fifthImageResponse[0] : $room['f5_public_id'] ,
                    'f6_public_id' => $sixthImageResponse !== null ? $sixthImageResponse[0] : $room['f6_public_id'] ,
                ]);
                $room->update([
                    'slug'=>Str::slug($room->title).'-'.$room->id.'-'.Str::slug($room->category)
                ]);
                if(!$updateResponse){
                    toast('An error occurred','error');
                } else{
                    toast('Successfully updated','success');
                }
            });
            Artisan::call('cache:clear');
            return redirect()->route('b-rooms');
        }  catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('Oops!!!, Not Found','error');
            return back();
        }
    }

    public function DeleteRoom(int $id)
    {
        $this->authorize(Permissions::CAN_DELETE_ROOMS);
        if ($this->ConnectedToInternet()){
            try {
                $room = Room::where('id',$id)->firstOrFail();
                //delete the images if any
                $arr = ['f1_public_image','f2_public_image','f3_public_image','f4_public_image','f5_public_image','f6_public_image'];
                for ($i = 1; $i < 6; $i++){
                    $this->DeleteFile($room[$arr[$i]]);
                }
                //delete the room model
                $room->delete();
                toast('Success','success');
            } catch (ModelNotFoundException $exception){
                Log::error($exception->getMessage());
                toast('An error occurred','error');
            }
        }  else{
            toast('Weak or no internet','error');
        }
        return back();
    }
    public function RoomCategory()
    {
        $this->data['title'] = "Room Categories";
        $this->data['titleText'] = "Room Categories";
        return view('dashboard.room.room-categories',$this->data);
    }
}
