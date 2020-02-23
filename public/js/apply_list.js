/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 15:02:00
 */

new Vue({
    el: '#app',
    data: {
        showAreas: false,
        area: '',
        areaIndex: 0,
        areas: _.pluck(REGIONS, 'region_name'),
        showHospitals: false,
        hospital: '',
        hospitalIndex: 0,
        hospitals: _.pluck(HOSPITALS, 'hospital_name'),
        showStatus: false,
        statu: '',
        statuIndex: 0,
        status: _.pluck(STATUS, 'statu_name'),
        keyword: '',
    },
    created: function() {
        this.area = this.areas[this.areaIndex];
        this.hospital = this.hospitals[this.hospitalIndex];
        this.statu = this.status[this.statuIndex];
    },
    methods: {
        areaOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.area = value;
            this.areaIndex = index;
        },
        hospitalOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.hospital = value;
            this.hospitalIndex = index;
        },
        statuOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.statu = value;
            this.statuIndex = index;
        },
        onSearch: function () {
            console.log({
                area: this.area,
                hospital: this.hospital,
                statu: this.statu,
                keyword: this.keyword,
            });
            window.location.href = '/hotel_list?distinct=' + REGIONS[this.areaIndex].id + '&hospital=' + HOSPITALS[this.hospitalIndex].id + '&s=' + this.keyword + '&status=' + STATUS[this.statuIndex].id;
        }
    }
});