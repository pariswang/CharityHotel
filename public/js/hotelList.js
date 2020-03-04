/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-24 21:19:49
 */
REGIONS.unshift({
    id: '',
    region_name: "全部区域"
})
var ALL_HOSPITAL = {
    id: '',
    hospital_name: "全部医院"
}
HOSPITALS.unshift(ALL_HOSPITAL);
var area_index = _.findIndex(REGIONS, function (item) {return item.id == ppo.getUrlParam('distinct')});
var hospital_index = -1;
var cur_region_id = area_index > 0 ? REGIONS[area_index].id : null;
var _hospitals = [];
if (area_index > 0) {
    _hospitals = _.filter(HOSPITALS, function(item){ return item.region_id == cur_region_id; });
    _hospitals.unshift(ALL_HOSPITAL);
    hospital_index = _.findIndex(_hospitals, function (item) {return item.id == ppo.getUrlParam('hospital')});
    console.log('_hospitals', _hospitals);
} else {
    hospital_index = _.findIndex(HOSPITALS, function (item) {return item.id == ppo.getUrlParam('hospital')});
}

var FREE_DATA = ["全部价格","医护免费","医护收费"];
var ISOLCATION_DATA = ["全部房间","有隔离房","无隔离房"];
var SORT_DATA = ["默认排序","按价格↑","按时间↓"];
var sort_index = ppo.getUrlParam('sort_id');
var free_index = ppo.getUrlParam('free_id');
var isolation_index = ppo.getUrlParam('isolation_id');

new Vue({
    el: '#app',
    data: {
        tabbarActive: 0,
        showAreas: false,
        area: '',
        areaIndex: area_index > 0 ? area_index : null,
        areas: _.pluck(REGIONS, 'region_name'),
        showHospitals: false,
        hospital: '',
        hospitalIndex: hospital_index > 0 ? hospital_index : null,
        hospitals: _.pluck(area_index > 0 ? _hospitals : HOSPITALS, 'hospital_name'),
        showStatus: false,
        statu: '',
        statuIndex: null,
        status: ['全部', '已发布', '已取消', '已接单'],
        keyword: ppo.getUrlParam('s') || '',
        showAreas: false,
        free: '',
        frees: FREE_DATA,
        freeIndex: free_index > 0 ? free_index : null,
        showFrees: false,
        isolation: '',
        isolations: ISOLCATION_DATA,
        isolationIndex: isolation_index > 0 ? isolation_index : null,
        showIsolations: false,
        sort: '',
        sorts: SORT_DATA,
        sortIndex:  sort_index > 0 ? sort_index : null,
        showSorts: false,
    },
    created: function() {
        this.area = this.areaIndex !== null ? this.areas[this.areaIndex] : '';
        this.hospital = this.hospitalIndex !== null ? this.hospitals[this.hospitalIndex] : '';
        this.free = this.freeIndex !== null ? ( this.isolationIndex == 0 ? '医护是否免费' : this.frees[this.freeIndex] ) : '';
        this.isolation = this.isolationIndex !== null ? ( this.isolationIndex == 0 ? '是否有隔离房' : this.isolations[this.isolationIndex]) : '';
        this.sort = this.sortIndex !== null ? ( this.sortIndex == 0 ? '排序方式' : this.sorts[this.sortIndex] ) : '';
    },
    methods: {
        areaOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.area = value;
            this.areaIndex = index;
            cur_region_id = REGIONS[this.areaIndex].id;
            if (cur_region_id !== '') {
                _hospitals = _.filter(HOSPITALS, function(item){ return item.region_id == cur_region_id; });
                _hospitals.unshift(ALL_HOSPITAL);
                this.hospitals = _.pluck(_hospitals, 'hospital_name');
            } else {
                this.hospitals = _.pluck(HOSPITALS, 'hospital_name');
            }
            this.hospital = '',
            this.hospitalIndex = null;
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
        freeOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.free = index == 0 ? '医护是否免费' : value;
            this.freeIndex = index;
        },
        isolationOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.isolation = index == 0 ? '是否有隔离房' : value;
            this.isolationIndex = index;
        },
        sortOnChange(picker, value, index) {
            // console.log(`当前值：${value}, 当前索引：${index}`);
            this.sort = index == 0 ? '排序方式' : value;
            this.sortIndex = index;
        },
        onSearch: function () {
            // console.log({
            //     area: this.area,
            //     hospital: this.hospital,
            //     statu: this.statu,
            //     keyword: this.keyword,
            // });
            var free_id = !this.freeIndex ? '' : this.freeIndex;
            var isolation_id = !this.isolationIndex ? '' : this.isolationIndex;
            var sort_id = !this.sortIndex ? '' : this.sortIndex;
            var distinct_id = !this.areaIndex ? '' : REGIONS[this.areaIndex].id;
            var hospital_id = !this.hospitalIndex ? '' : (cur_region_id && cur_region_id !== '' ? _hospitals[this.hospitalIndex].id : HOSPITALS[this.hospitalIndex].id);
            var url = '/hotel_list?distinct=' + distinct_id + '&hospital=' + hospital_id + '&s=' + this.keyword + '&free_id=' + free_id + '&isolation_id=' + isolation_id + '&sort_id=' + sort_id;
            // console.log(url);return;
            window.location.href = url;
        }
    }
});