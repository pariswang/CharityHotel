/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-24 18:55:34
 */

new Vue({
    el: '#app',
    data: {
        showAreas: false,
        area: '',
        areaIndex: 0,
        areas: _.pluck(REGIONS, 'region_name'),
        hope_addr: '',
        remark: '',
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
        onSubmit: function () {
            var data = {
                region_id: REGIONS[this.areaIndex].id,
                hope_addr: this.hope_addr,
                remark: this.remark,
            }
            this.submitApply(data);
        }
    },
    mixins: [apply]
});