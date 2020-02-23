/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 16:37:53
 */

new Vue({
    el: '#app',
    data: {
        hotle_name: HOTLE_NAME,
        conn_person: CONN_PERSON,
        conn_phone: CONN_PHONE,
        conn_position: CONN_POSITION,
        conn_company: CONN_COMPANY,
        checkin_num: CHECKIN_NUM,
        room_count: ROOM_COUNT,
        date_begin: DATE_BEGIN,
        date_end: DATE_END,
        can_pay: CAN_PAY,
        has_letter: HAS_LETTER,
        region_name: REGION_NAME,
        hope_addr: HOPE_ADDR,
        remark: REMARK,
        submitLoading: false
    },
    methods: {
        onCancel: function () {
            $.ajax({
                type: 'POST',
                url: '/apply',
                data: {
                    _token: $('input[name="_token"]').val(),
                },
                beforeSend: function () {
                    _this.submitLoading = true;
                },
                success: function (res) {
                    console.log('res', res);
                    vant.Notify({ type: 'success', message: '申请成功' });
                    setTimeout( function() {
                        window.location.href = '/apply_list';
                    }, 1000);
                },
                complete: function () {
                    _this.submitLoading = false;
                    
                }
            });
        }
    }
});