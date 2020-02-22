/*
 * @Author: kermit.yu 
 * @Date: 2020-02-22 22:13:41 
 * @Last Modified by: kermit.yu
 * @Last Modified time: 2020-02-23 01:03:48
 */

new Vue({
    el: '#app',
    data: {
        phone: '',
        password: '',
        password_f: '',
        uname: '',
        position: '',
        company: '',
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
            } else if (!/^[a-zA-Z0-9_-]{4,16}$/.test(this.password)){
                vant.Toast('密码6-16位，包括至少1个大写字母，1个小写字母，1个数字，1个特殊字符');
                return false;
            } else if (this.password !== this.password_f ){
                vant.Toast('两次密码不一致');
                return false;
            }
            if(this.uname == ''){
                vant.Toast('姓名不能为空');
                return false;
            }
            if(this.position == ''){
                vant.Toast('岗位不能为空');
                return false;
            }
            if(this.company == ''){
                vant.Toast('工作单位不能为空');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '/register',
                data: {
                    _token: $('input[name="_token"]').val(),
                    phone: this.phone,
                    password: this.password,
                    uname: this.uname,
                    position: this.position,
                    company: this.company,
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