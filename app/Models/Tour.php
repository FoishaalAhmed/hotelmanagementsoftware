<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'guide_id', 'type', 'duration', 'charge',
    ];

    public function getTours()
    {
        $tours = $this::join('guides', 'tours.guide_id', '=', 'guides.id')
            ->leftJoin('tour_packages', 'tours.tour_package_id', '=', 'tour_packages.id')
            ->orderBy('guides.name', 'asc')
            ->where('tours.hotel_id', auth()->user()->hotel_id)
            ->select('tours.*', 'guides.name', 'tour_packages.name as package')
            ->get();
        return $tours;
    }

    public function getTourById($id)
    {
        $tours = $this::join('guides', 'tours.guide_id', '=', 'guides.id')
            ->leftJoin('tour_packages', 'tours.tour_package_id', '=', 'tour_packages.id')
            ->orderBy('guides.name', 'asc')
            ->where('tours.id', $id)
            ->where('tours.hotel_id', auth()->user()->hotel_id)
            ->select('tours.*', 'guides.name', 'tour_packages.name as package')
            ->first();
        return $tours;
    }

    public function storeTour(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->guide_id = $request->guide_id;
        $this->type = $request->type;
        $this->tour_package_id = $request->package_id;
        $this->duration = $request->duration;
        $this->charge = $request->charge;
        $storeTour = $this->save();

        if ($request->person != null) {
            foreach ($request->person as $key => $value) {
                if ($value == null) continue;
                $booking_id = BookingDetail::where('room_id', $request->room_id[$key])->where('status', 1)->first()->booking_id;

                $data[] = [
                    'hotel_id' => auth()->user()->hotel_id,
                    'tour_id' => $this->id,
                    'booking_id' => $booking_id,
                    'room_id' => $request->room_id[$key],
                    'person' => $value,
                    'names' => $request->names[$key],
                    'paid' => $request->paid[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            TourUser::insert($data);
        }

        $storeTour
            ? session()->flash('message', 'New Tour Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyTour(Object $tour)
    {
        $destroyTour = $tour::delete();

        $destroyTour
            ? session()->flash('message', 'Tour Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
