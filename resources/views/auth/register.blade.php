


@extends('layouts.app')
@section('title', '注册')
@section('content')
<div class="page page--start" id="register">
    <h1 class="page-title">{{isset($hotel) ? '酒店人员注册' : ' 医护人员注册'}}</h1>
    <h3 class="register-titile" >
        本系统为不涉及捐赠等事情，如果发现有人涉嫌利用虚假信息进行诈骗等活动，请及时举报。
        <br/>
        @if (isset($hotel) && $hotel==1)
            如遇到问题，请点击查看<a href="http://1252139118.vod2.myqcloud.com/48f025a3vodcq1252139118/6b40cf595285890799046373528/MO9OIDEE9twA.mp4">帮助视频</a>。
        @else
            如遇到问题，请点击查看<a href="http://1252139118.vod2.myqcloud.com/48f025a3vodcq1252139118/6d60b6135285890799046445117/F6vE2urUG0UA.mp4">帮助视频</a>。
        @endif
    </h3>
    @csrf
    <input type="hidden" name="ishotel" value="{{isset($hotel)? $hotel : '0'}}"/>
    <van-cell-group>
        <van-field
            v-model="phone"
            required
            type="tel"
            maxlength="11"
            label="手机号"
            placeholder="请输入手机号"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="password"
            required
            type="password"
            label="密码"
            placeholder="请输入密码，至少6位"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="password_f"
            required
            type="password"
            label="确认密码"
            placeholder="请确认密码"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="uname"
            required
            label="姓名"
            placeholder="请输入姓名"/>
    </van-cell-group>
    <van-cell-group>
        <van-field
            v-model="company"
            required
            label="工作单位"
            placeholder="请输入工作单位"/>
    </van-cell-group>
<!--     <van-cell-group>
        <div class="van-cell van-cell--required van-field" @click="showRoles=true">
            <div class="van-cell__title van-field__label"><span>角色</span></div>
            <div class="van-cell__value">
                <div class="van-field__body --space-between">
                    <span v-text="role !== '' ? role : '请选择角色'"></span>
                    <van-icon name="arrow-down"/>
                </div>
            </div>
        </div>
    </van-cell-group> -->
    <van-cell-group>
        <van-field
                v-model="position"
                required
                label="岗位"
                placeholder="请输入岗位"/>
    </van-cell-group>
    <van-popup
        v-model="showRoles"
        closeable
        round
        position="bottom"
        close-icon="{{asset('/imgs/confirm_btn.png')}}"
        :style="{ height: '30%' }">
        <van-picker :columns="roles" @change="rolesOnChange"/>
    </van-popup>
    <p class="register-tip">请如实录入您真实信息，不要透漏个人隐私. 
        @if (isset($hotel))
        <button class="text-btn" @click="tipOverlay = true">医护接待酒店的环境安全要求须知</button>
        @else
        <button class="text-btn" @click="tipOverlay = true">医护人员入住须知</button>
        @endif
    </p>
    <van-checkbox value="checked" bind:change="null"><a href="/disclaimer">“日月同城”医护酒店公寓平台注册条款</a></van-checkbox>
    <van-button class="login-btn" color="#1d63cb" round block :loading="submitLoading" loading-text="注册中..." @click="onSubmit">注册</van-button>
    <div class="overlay" :class="{'overlay-show': tipOverlay}">
        <div class="overlay__wrapper">
            @if (isset($hotel))
            <div class="overlay__inner" id="detail">
                <h2 class="page-title">《医护接待酒店的环境安全要求须知》</h2>
                <div class="scroll__box">
                    <p>1.<span class="text--green">不要直接和医务人员接触,</span>做好防护（口罩+<span class="text--green">一次性浴帽盖住头发,</span>等）,接触前后请使用手部消毒液</p>
                    <p>2.医务人员如有资源,请自行携带消毒液等,商家也可准备消毒液</p>
                    <p>3.<span class="text--red">日常注意事项</span>：</p>
                    <ul>
                        <li>工作人员一定正确佩戴双层口罩及密封手套、浴帽</li>
                        <li>用75%医用酒精、过氧乙酸、含氯消毒剂(可用84、健之素泡腾片,不要用氯己定,不敏感)等清洁房间内的物体表面和地面（每日两次）；</li>
                        <li>每日开窗通风两次，每次30分钟；紫外线灯至少30分钟(如果有的话)。酒店最好可以配备空气净化器及一次性床单被套毛巾浴巾,医护人员也会自行配备相关的防护措施.</li>
                    </ul>
                    <p>4.重中之重,酒店人员一定做好防护,保护好自己！务必！如果您有顾虑或遇到其他问题请通过运维微信群联系我们</p>
                    <p>5.酒店方操作细则（感谢支持！但请一定量力而行。）</p>
                    <ol>
                        <li>客房供应：不建议全部供应。例如30间客房,应空余10间左右；入住太满,存在安全隐患；中央空调建议关掉，防止交叉感染。</li>
                        <li>无前台接待：医护人员应保证干净卫生,清换床单被套,方便下一位医护入住；请加酒店负责人微信后,请将离店时房间视频发送给酒店负责人；保证干净卫生,方便下一位医护入住</li>
                        <li>酒店有前台：前台应做好安全防护-见上面<span class="text--red">日常注意事项</span>。</li>
                        <li>无论有无前台，请确保酒店客房的正常各项服务（热水、暖气、各类耗品），一定确保客房床品干净卫生，一客一换，并请配备多余被褥供给住客</li>
                        <li>50岁以上的酒店工作人员请勿参与接待或清扫房间的工作。</li>
                        <li>酒店工作人员班次结束后请淋浴洗头洗澡， 每天工作结束后，酒店工作人员的工作服需集中放置并清洗消毒。</li>
                    </ol>
                </div>
                <van-button
                    color="#1d63cb"
                    :disabled="closebtnDisabled"
                    round
                    block
                    @click="tipOverlay = false">
                    <span v-text="countDown + 's' " v-if="closebtnDisabled"></span> 继续
                </van-button>
            </div>
            @else
            <div class="overlay__inner" id="detail">
                <h2 class="page-title">《医护人员入住须知》</h2>
                <p>1.请务必提供医护证明或公函（电子版也可接受）；</p>
                <p>2.<span class="text--green">请自行做好防护</span>,保护自己和他人,入住前最好自带4件套、一次性用品、垃圾袋（或酒店提供）、消毒液（如有资源请自带）；</p>
                <p>3.入住后,请大家自己打包好4件套（装塑料袋）尽量不要让酒店人员处理用物；</p>
                <p>4.接待人员都是普通的市民,也有家庭,入住人员如有感染症状请回家隔离</p>
                <p>5.医护人员如有资源,请自行携带消毒液等。</p>
                <van-button
                    color="#1d63cb"
                    :disabled="closebtnDisabled"
                    round
                    block
                    @click="tipOverlay = false">
                    <span v-text="countDown + 's' " v-if="closebtnDisabled"></span> 继续
                </van-button>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('/js/register.js')}}"></script>
@endsection
