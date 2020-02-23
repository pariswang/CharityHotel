list<br/>
<!--
参数：
/apply_list?distinct={distinct_id}&hospital={hospital_id}&s={addr_str}&status={status_id}
-->
status:
1 => 已申请
5 => 已接单
<br/>

@foreach ($applies as $apply)
    {{$apply->date_begin}}
@endforeach