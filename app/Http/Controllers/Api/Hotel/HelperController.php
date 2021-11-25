<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\BankPayment;
use App\Models\Booking;
use App\Models\BookingPayment;
use App\Models\Hotel;
use App\Models\HotelCommission;
use App\Models\MobilePayment;
use App\Models\Room;
use App\Models\Service;
use App\Models\RoomRent;
use App\Models\RoomPhoto;
use App\Models\RoomVideo;
use App\Models\HotelService;
use App\Models\ServiceCharge;
use App\Models\RoomFacility;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class HelperController extends Controller
{
    public function permission()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        return response($permissions, 200);
    }

    public function userPermission($id)
    {
        $userPermissions = DB::table('model_has_permissions')->where('model_id', $id)->pluck('permission_id')->toArray();
        return response($userPermissions, 200);
    }

    public function roomVideo($id)
    {
        $video = RoomVideo::find($id);
        if ($video == null) {
            $response = [
                'message' => 'This video dose not exist.'
            ];
            return response($response, 200);
        } else {
            $video->delete();
            $response = [
                'message' => 'Video deleted successfully.'
            ];
            return response($response, 200);
        }
    }

    public function roomPhoto($id)
    {
        $photo = RoomPhoto::find($id);
        if ($photo == null) {
            $response = [
                'message' => 'This photo dose not exist.'
            ];
            return response($response, 200);
        } else {
            if (file_exists($photo->photo)) unlink($photo->photo);
            $photo->delete();
            $response = [
                'message' => 'Photo deleted successfully.'
            ];
            return response($response, 200);
        }
    }

    public function due(Int $id)
    {
        $total = Booking::where('id', $id)->firstOrFail()->total;
        $bankPayments = BankPayment::where('booking_id', $id)->selectRaw('sum(amount) as total')->first()->total;
        $cashPayments = BookingPayment::where('booking_id', $id)->selectRaw('sum(paid) as total')->first()->total;
        $mobilePayments = MobilePayment::where('booking_id', $id)->selectRaw('sum(amount) as total')->first()->total;
        $serviceCharge = ServiceCharge::where('booking_id', $id)->selectRaw('sum(paid) as total, sum(charge) as charge')->first();

        $charge = 0;
        $chargePaid = 0;

        if ($serviceCharge != null) {
            $charge = $serviceCharge->charge;
            $chargePaid = $serviceCharge->total;
        }
        
        $total_bill = $total + $charge;
        $total_paid = $cashPayments + $mobilePayments + $chargePaid;
        $due = $total + $charge - $bankPayments - $cashPayments - $mobilePayments - $chargePaid;
        
        $response = [
            'total_bill' => $total_bill,
            'total_paid' => $total_paid,
            'due' => $due,
            ];

       return response($response, 200);
    }
    
    public function service()
    {
        $services = Service::orderBy('name', 'asc')->select('id', 'name')->get();
        return response($services, 200);
    }
    
    public function services(Int $id)
    {
        $serviceChargeObject = new ServiceCharge();
        $services = $serviceChargeObject->getBookingServiceCharge($id);
        return response($services, 200);
    }
    
    public function room_facility(Int $room_id)
    {
        $roomFacilityObject = new RoomFacility();
        $facilities = $roomFacilityObject->getRoomFacilities($room_id);

        return response($facilities, 200);
    }
    
    public function room_other_rent(Int $room_id, String $type)
    {
        $rent = Room::findOrFail($room_id)->rate;

        if ($type != 'Normal Rate') {
            $room = RoomRent::where('room_id', $room_id)->where('type', $type)->first();

            if ($room != null) {
                $rent = $room->rent;
            }
        }

        echo $rent;
    }
    
    public function type() {
        $data1 = ['name' => 'Seasonal Rate'];
        $data2 = ['name' => 'Festival Rate'];
        
        $data = [];
        
        array_push($data, $data1);
        array_push($data, $data2);
        
        return response($data, 200); 
    }

    public function commission()
    {
        $commission = HotelCommission::where('hotel_id', auth()->user()->hotel_id)->select('commission')->first();
        return response($commission, 200);
    }

    public function logo(Request $request)
    {
        $hotelObject = new Hotel();
        $hotelObject->updateHotelLogo($request);
        $response = ['message' => 'Logo Change Successfully!'];
        return response($response, 200);
    }
}
