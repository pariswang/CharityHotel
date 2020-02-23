/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 14:21:11
 */

new Vue({
    el: '#app',
    data: {
        showAreas: false,
        area: '',
        areaIndex: 0,
        areas: _.pluck(REGIONS, 'region_name'),
        conn_person: CONN_PERSON,
        conn_phone: CONN_PHONE,
        conn_position: CONN_POSITION,
        conn_company: CONN_COMPANY,
        checkin_num: 1,
        room_count: 1,
        date_begin: moment().format('YYYY/MM/DD'),
        date_end: moment().add(1, 'days').format('YYYY/MM/DD'),
        can_pay: true,
        has_letter: true,
        hope_addr: '',
        remark: '',
        showDatePicker: false,
        submitLoading: false,
    },
    created: function() {
        this.area = this.areas[this.areaIndex];
    },
    methods: {
        areaOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.area = value;
            this.areaIndex = index;
        },
        formatDate: function(date) {
            return `${date.getMonth() + 1}/${date.getDate()}`;
        },
        datePickerOnConfirm: function (date) {
            console.log('date', date);
            this.date_begin = moment(date[0]).format('YYYY/MM/DD');
            this.date_end = moment(date[1]).format('YYYY/MM/DD');
            this.showDatePicker = false;
        },
        onSubmit: function () {
            var _this = this;
            if(this.conn_person == ''){
                vant.Toast('联系人不能为空');
                return false;
            }
            if(this.conn_phone == ''){
                vant.Toast('联系人电话不能为空');
                return false;
            } else if (!/^1\d{10}$/.test(this.conn_phone)){
                vant.Toast('请填写正确的联系人电话');
                return false;
            }
            if(this.conn_position == ''){
                vant.Toast('职位不能为空');
                return false;
            }
            if(this.conn_company == ''){
                vant.Toast('工作单位不能为空');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '/apply',
                data: {
                    _token: $('input[name="_token"]').val(),
                    conn_person: this.conn_person,
                    conn_phone: this.conn_phone,
                    conn_position: this.conn_position,
                    conn_company: this.conn_company,
                    checkin_num: this.checkin_num,
                    room_count: this.room_count,
                    date_begin: this.date_begin,
                    date_end: this.date_end,
                    can_pay: this.can_pay,
                    has_letter: this.has_letter,
                    region_id: REGIONS[this.areaIndex].id,
                    hope_addr: this.hope_addr,
                    remark: this.remark,
                },
                beforeSend: function () {
                    _this.submitLoading = true;
                },
                success: function (res) {
                    console.log('res', res);
                    vant.Notify({ type: 'success', message: '申请成功' });
                    setTimeout( function() {
                        window.location.href = '/hotel_list';
                    }, 1000);
                },
                complete: function () {
                    _this.submitLoading = false;
                    
                }
            });
        }
    }
});