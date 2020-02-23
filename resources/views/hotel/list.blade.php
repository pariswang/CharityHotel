<!--
参数说明
?distinct={distinct_id}&hospital={hospital_id}&s={addr_str}
-->
@foreach ($regions as $region)
    {{$region->id}} - {{$region->region_name}}<br/>
@endforeach

@foreach ($hotels as $hotel)
    {{$hotel->region->region_name}}-{{$hotel->hotel_name}},可安排{{$hotel->room_count-$hotel->use_room_count}}间，
    @if ($hotel->medical_staff_free)
        医护人员免费，其他收费{{$hotel->discount_price}}/晚。
        @else
        收费{{$hotel->discount_price}}/晚。
    @endif
@endforeach

@foreach ($hospitals as $hospital)
    {{$hospital->id}} - {{$hospital->hospital_name}}<br/>
@endforeach