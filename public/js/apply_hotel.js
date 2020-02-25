/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-24 18:54:49
 */

new Vue({
    el: '#app',
    data: {
        hotel_id: ppo.getUrlParam('id'),
    },
    methods: {
        onSubmit: function () {
            var data = {
                hotel_id: this.hotel_id,
            }
            this.submitApply(data);
        }
    },
    mixins: [apply]
});