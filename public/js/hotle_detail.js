/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 17:00:53
 */

new Vue({
    el: '#app',
    data: {
        hotle_name: '',
        free: true,
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