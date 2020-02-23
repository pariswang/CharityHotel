/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 23:07:04
 */
REGIONS.unshift({
    id: '',
    region_name: "全部区域"
})
HOSPITALS.unshift({
    id: '',
    hospital_name: "全部医院"
})
var area_index = _.findIndex(REGIONS, function (item) {return item.id == ppo.getUrlParam('distinct')});
var hospital_index = _.findIndex(HOSPITALS, function (item) {return item.id == ppo.getUrlParam('hospital')});
console.log('area_index', area_index);
console.log('hospital_index', hospital_index);

new Vue({
    el: '#app',
    data: {
        showAreas: false,
        area: '',
        areaIndex: area_index > 0 ? area_index : null,
        areas: _.pluck(REGIONS, 'region_name'),
        showHospitals: false,
        hospital: '',
        hospitalIndex: hospital_index > 0 ? hospital_index : null,
        hospitals: _.pluck(HOSPITALS, 'hospital_name'),
        showStatus: false,
        statu: '',
        statuIndex: null,
        status: ['全部', '已发布', '已取消', '已接单'],
        keyword: ppo.getUrlParam('s') || '',
    },
    created: function() {
        this.area = this.areaIndex !== null ? this.areas[this.areaIndex] : '';
        this.hospital = this.hospitalIndex !== null ? this.hospitals[this.hospitalIndex] : '';
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
            // console.log({
            //     area: this.area,
            //     hospital: this.hospital,
            //     statu: this.statu,
            //     keyword: this.keyword,
            // });
            var distinct_id = !this.areaIndex ? '' : REGIONS[this.areaIndex].id;
            var hospital_id = !this.hospitalIndex ? '' : HOSPITALS[this.hospitalIndex].id;
            window.location.href = '/hotel_list?distinct=' + distinct_id + '&hospital=' + hospital_id + '&s=' + this.keyword;
        }
    }
});