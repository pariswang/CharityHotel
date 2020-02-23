/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 23:06:49
 */
REGIONS.unshift({
    id: '',
    region_name: "全部区域"
})
STATUS.unshift({
    id: '',
    statu_name: "全部申请"
})
var area_index = _.findIndex(REGIONS, function (item) {return item.id == ppo.getUrlParam('distinct')});
var statu_index = _.findIndex(STATUS, function (item) {return item.id == ppo.getUrlParam('status')});
console.log('area_index', area_index);
console.log('statu_index', statu_index);

new Vue({
    el: '#app',
    data: {
        showAreas: false,
        area: '',
        areaIndex: area_index > 0 ? area_index : null,
        areas: _.pluck(REGIONS, 'region_name'),
        showHospitals: false,
        hospital: '',
        hospitalIndex: null,
        hospitals: _.pluck(HOSPITALS, 'hospital_name'),
        showStatus: false,
        statu: '',
        statuIndex: statu_index > 0 ? statu_index : null,
        status: _.pluck(STATUS, 'statu_name'),
        keyword: ppo.getUrlParam('s') || '',
    },
    created: function() {
        this.area = this.areaIndex !== null ? this.areas[this.areaIndex] : '';
        this.statu = this.statuIndex !== null ? this.status[this.statuIndex] : '';
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
            var statu_id = !this.statuIndex ? '' : STATUS[this.statuIndex].id;
            window.location.href = '/apply_list?distinct=' + distinct_id + '&s=' + this.keyword + '&status=' + statu_id;
        }
    }
});