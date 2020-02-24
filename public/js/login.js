/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 19:14:29
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
                    if(res && res.data && res.data.url){
                        window.location.href = res.data.url;
                    }else{
                        window.location.href = '/hotel_list';
                    }
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
                    vant.Notify({ type: 'danger', message: errors_text !== '' ? errors_text : '登录错误，请重试'});
                },
                complete: function () {
                    _this.submitLoading = false;
                }
            });
        }
    }
});