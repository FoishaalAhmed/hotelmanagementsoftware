<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Room extends Model
{
    protected $fillable = [
        'number', 'type', 'situate', 'facing', 'bed', 'rent',
    ];

    public function bookings()
    {
        return $this->hasMany('App\Models\BookingDetail');
    }

    public function storeRoom($request)
    {
        DB::transaction(
            function () use ($request) {
                $image = $request->file('display_photo');

                if ($image) {

                    $image_name      = date('YmdHis');
                    $ext             = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $image_url       = 'https://amarlodge.com/public/images/rooms/' . $image_full_name;
                    $success         = $image->storeAs('rooms', $image_full_name, 'parent_disk');
                    $this->photo     = $image_url;
                }

                $this->hotel_id = auth()->user()->hotel_id;
                $this->number   = $request->number;
                $this->type     = $request->type;
                $this->facing   = $request->facing;
                $this->situate  = $request->situate;
                $this->beds     = $request->beds;
                $this->rate     = $request->rate;
                $this->area     = $request->area;
                $this->bath     = $request->bath;
                $this->description = $request->description;
                $storeRoom      = $this->save();

                $room_id = $this->id;

                if ($files = $request->file('photo')) {

                    foreach ($files as $file) {

                         $multiple_upload_path = 'https://amarlodge.com/public/images/rooms/';
                        $name                 = $file->getClientOriginalName();
                        $multiple_image_name  = date('YmdHis') . '_' . $name;
                        $file->storeAs('rooms', $multiple_image_name, 'parent_disk');

                        $room_photo           = new RoomPhoto;
                        $room_photo->photo    = $multiple_upload_path . $multiple_image_name;
                        $room_photo->hotel_id = auth()->user()->hotel_id;
                        $room_photo->room_id  = $room_id;
                        $room_photo->save();
                    }
                }

                if ($request->video) {

                    foreach ($request->video as $key => $value) {
                        if ($value == null) continue;
                        $room_video           = new RoomVideo();
                        $room_video->hotel_id = auth()->user()->hotel_id;
                        $room_video->room_id  = $room_id;
                        $room_video->video    = $value;
                        $room_video->save();
                    }
                }
                $storeRoom
                    ? session()->flash('message', 'New Room Created Successfully!')
                    : session()->flash('message', 'Something Went Wrong!');
            }
        );
    }

    public function updateRoom($request, $id)
    {
        DB::transaction(
            function () use ($request, $id) {
                $room  = $this::findOrFail($id);
                $image = $request->file('display_photo');

                if ($image) {

                    if (file_exists($room->photo)) unlink($room->photo);
        
                    $image_name      = date('YmdHis');
                    $ext             = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $image_url       = 'https://amarlodge.com/public/images/rooms/' . $image_full_name;
                    $success         = $image->storeAs('rooms', $image_full_name, 'parent_disk');
                    $room->photo     = $image_url;
                }

                $room->hotel_id = auth()->user()->hotel_id;
                $room->number   = $request->number;
                $room->type     = $request->type;
                $room->facing   = $request->facing;
                $room->situate  = $request->situate;
                $room->beds     = $request->beds;
                $room->rate     = $request->rate;
                $room->area     = $request->area;
                $room->bath     = $request->bath;
                $room->description = $request->description;
                $updateRoom     = $room->save();
                $room_id = $room->id;
                
                if ($files = $request->file('photo')) {
                    foreach ($files as $file) {
                        $multiple_upload_path = 'https://amarlodge.com/public/images/rooms/';
                        $name                 = $file->getClientOriginalName();
                        $multiple_image_name  = date('YmdHis') . '_' . $name;
                        $file->storeAs('rooms', $multiple_image_name, 'parent_disk');

                        $room_photo           = new RoomPhoto;
                        $room_photo->photo    = $multiple_upload_path . $multiple_image_name;
                        $room_photo->hotel_id = auth()->user()->hotel_id;
                        $room_photo->room_id  = $room_id;
                        $room_photo->save();
                    }
                }

                if ($request->video) {

                    foreach ($request->video as $key => $value) {
                        if ($value == null) continue;
                        $room_video           = new RoomVideo();
                        $room_video->hotel_id = auth()->user()->hotel_id;
                        $room_video->room_id  = $room_id;
                        $room_video->video    = $value;
                        $room_video->save();
                    }
                }

                $updateRoom
                    ? session()->flash('message', 'Room Updated Successfully!')
                    : session()->flash('message', 'Something Went Wrong!');
            }
        );
    }

    public function destroyRoom($id)
    {
        DB::transaction(
            function () use ($id) {
                $room  = $this::findOrFail($id);
                if (file_exists($room->photo)) unlink($room->photo);

                $room_photos = RoomPhoto::where('room_id', $id)->get();

                foreach ($room_photos as $key => $value) {

                    if (file_exists($value->photos)) unlink($value->photos);
                }

                RoomPhoto::where('room_id', $id)->delete();
                RoomVideo::where('room_id', $id)->delete();

                $destroyRoom = $room->delete();

                $destroyRoom
                    ? session()->flash('message', 'Room Deleted Successfully!')
                    : session()->flash('message', 'Something Went Wrong!');
            }
        );
    }
}
