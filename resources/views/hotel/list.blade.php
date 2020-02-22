
@foreach ($hotels as $hotel)
    {{$hotel->region->region_name}}-{{$hotel->hotel_name}},可安排{{$hotel->room_count-$hotel->use_room_count}}间，
    @if ($hotel->medical_staff_free)
        医护人员免费，其他收费{{$hotel->discount_price}}/晚。
        @else
        免费。
    @endif
@endforeach