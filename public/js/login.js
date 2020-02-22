/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 00:31:19
 */

new Vue({
    el: '#app',
    data: {
        phone: '',
        password: '',
        submitLoading: false
    },
    methods: {
        onSubmit: function () {
            var _this = this;
            if(this.phone == ''){
                vant.Toast('手机号不能为空');
                return false;
            } else if (!/^1\d{10}$/.test(this.phone)){
                vant.Toast('请填写正确的手机号');
                return false;
            }
            if(this.password == ''){
                vant.Toast('密码不能为空');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '/login',
                data: {
                    _token: $('input[name="_token"]').val(),
                    phone: this.phone,
                    password: this.password,
                },
                beforeSend: function () {
                    _this.submitLoading = true;
                },
                success: function (res) {
                    console.log('res', res);
                },
                complete: function () {
                    _this.submitLoading = false;
                }
            });
        }
    }
});