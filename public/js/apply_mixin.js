/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-24 21:14:17
 */

var HOSPITALS_COLUMNS = {};
_.each(REGIONS, function (item, index) {
    // console.log(item);
    if (item.hospitals.length > 0) {
        HOSPITALS_COLUMNS[item.region_name] = _.pluck(item.hospitals, 'hospital_name');
    }
});
console.log('HOSPITALS_COLUMNS', HOSPITALS_COLUMNS);

var apply = {
    data: {
        tabbarActive: 1,
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
        hospitals: [],
        hospitals_columns : [
            { values: _.keys(HOSPITALS_COLUMNS) },
            { values: HOSPITALS_COLUMNS[_.keys(HOSPITALS_COLUMNS)[0]] }
        ],
        hospitalPicker: false,
        showDateBeginPicker: false,
        showDateEndPicker: false,
        submitLoading: false,
        showAddHospital: true
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
        hospitalonChange: function(picker, values) {
            picker.setColumnValues(1, HOSPITALS_COLUMNS[values[0]]);
        },
        hospitalOnConfirm: function(value, index) {
            // console.log('value', value, index);
            var hospital = REGIONS[index[0]].hospitals[index[1]];
            // console.log('hospital', hospital);
            this.hospitals.push({
                id: hospital.id,
                hospital_name: hospital.hospital_name,
                region_id: hospital.region_id
            });
            this.hospitalPicker = false;
            if(this.hospitals.length>=3){
                this.showAddHospital = false;
            }
        },
        // 删除医院
        deleteHospital: function (id) {
            this.hospitals = _.filter(this.hospitals, function (item) {return item.id !== id });
            if(this.hospitals.length<3){
                this.showAddHospital = true;
            }
        },
        showPicker: function(){
            this.hospitalPicker = true;
            setTimeout(function(){$('.van-picker-column:eq(1)').css('flex-grow',3);},1000);
        },
        // 提交申请
        submitApply: function (data) {
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
            if(this.hospitals.length<1){
                vant.Toast('我的医院不能为空');
                return false;
            }
            // 过滤掉医院名
            var _hospitals = _.map(this.hospitals, function(item){
                var _item = {
                    id: item.id,
                    region_id: item.region_id
                }
                return _item;
            });
            var defaultData = {
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
                hospitals: _hospitals,
            }
            if (data) {
                for(var i in data){
                    defaultData[i] = data[i];
                }
            }
            console.log('defaultData', defaultData);
            $.ajax({
                type: 'POST',
                url: '/apply_hotel',
                data: defaultData,
                beforeSend: function () {
                    _this.submitLoading = true;
                },
                success: function (res) {
                    console.log('success', res);
                    vant.Notify({ type: 'success', message: '申请成功' });
                    setTimeout( function() {
                        window.location.href = '/profile';
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
};