
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="">
    @csrf
    手机：<input name="phone"/><br/>
    密码：<input type="password" name="password"/><br/>
    确认密码：<input type="password" name="password_confirmation"/><br/>
    姓名：<input name="uname"/><br/>
    岗位：<input name="position"/><br/>
    工作单位：<input name="company"/><br/>
    <input type="submit" value="提交"/>
</form>