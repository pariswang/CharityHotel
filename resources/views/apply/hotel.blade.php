申请{{$hotel->hotel_name}}的住宿

<form method="post" action="">
    <input name="conn_person" value="{{$user->uname}}"/><br/>
    <input name="conn_phone" value="{{$user->phone}}"/><br/>
    <input name="conn_position" value="{{$user->position}}"/><br/>
    <input name="conn_company" value="{{$user->company}}"/><br/>
    <input name="checkin_num" /><br/>
    <input name="room_count"/><br/>
    <input name="date_begin"/><br/>
    <input name="date_end"/><br/>
    <input name="can_pay"/><br/>
    <input name="has_letter"/><br/>
    <input type="submit" value="提交"/>
    <input name="hotel_id" type="hidden" value="{{$hotel->id}}"/>
    @csrf
</form>