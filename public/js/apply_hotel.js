/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-24 12:15:01
 */

new Vue({
    el: '#app',
    data: {
        conn_person: CONN_PERSON,
        conn_phone: CONN_PHONE,
        conn_position: CONN_POSITION,
        conn_company: CONN_COMPANY,
        checkin_num: 1,
        room_count: 1,
        date_begin: moment().format('YYYY/MM/DD'),
        date_end_min: new Date(moment().add(1, 'days').format('YYYY/MM/DD')),
        date_end_default: new Date(moment().add(1, 'days').format('YYYY/MM/DD')),
        date_end: '',
        can_pay: true,
        has_letter: true,
        hotel_id: ppo.getUrlParam('id'),
        showDateBeginPicker: false,
        showDateEndPicker: false,
        submitLoading: false
    },
    methods: {
        formatDate: function(date) {
            return `${date.getMonth() + 1}/${date.getDate()}`;
        },
        dateBeginOnConfirm: function (date) {
            console.log('dateBegin', date);
            this.date_begin = moment(date).format('YYYY/MM/DD');
            this.date_end_min = new Date(moment(date).add(1, 'days').format('YYYY/MM/DD')),
            this.date_end_default = new Date(moment(date).add(1, 'days').format('YYYY/MM/DD')),
            this.showDateBeginPicker = false;
        },
        dateEndOnConfirm: function (date) {
            console.log('dateEnd', date);
            this.date_end = moment(date).format('YYYY/MM/DD');
            this.showDateEndPicker = false;
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
                url: '/apply_hotel',
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
                    hotel_id: this.hotel_id,
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
                error: function (res) {
                    var errors = res.responseJSON.errors;
                    console.log('errors', errors);
                    var errors_text = '';
                    for(var i in  errors) {
                        var item = errors[i];
                        item.forEach(function (_item) { 
                            errors_text += _item;
                        });
                    }
                    vant.Notify({ type: 'danger', message: errors_text !== '' ? errors_text : '发布错误，请重试'});
                },
                complete: function () {
                    _this.submitLoading = false;
                }
            });
        }
    }
});