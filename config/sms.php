<?php
/**
 * 短信配置
 */
return [
	'sms_config' => [
		'access_key_id' => 'LTAIbBIlbZDyBwD3',
		'access_key_secret' => 'ortIyRBqwOkQZLJX10YPXimBFnQ0Yf',
		'sign_name' => '日月同城医护酒店公寓平台',

		'regist_code' => 'SMS_184621443',				// 注册验证码 {code}
		//【日月同城】验证码XXXX，您已经注册为会员，验证码有效时间X分钟。

		'login_code' => 'SMS_184621446',				// 快速登录验证码 {code}
		//【日月同城】验证码XXXX，您正在使用快速登录，验证码有效时间X分钟。

		'request_hotel_code' => 'SMS_184622218',		// 住宿请求，酒店响应{name}{date}
		//【日月同城】您收到来自XXX 于X月X日入住的住宿请求，请登录系统处理

		'request_area_code' => 'SMS_184627095',			// 住宿请求，行政响应{name}{date}
		//【日月同城】XXX 提交于X月X日在XX区的住宿请求，请登录系统处理

		'order_code' => 'SMS_184627098',				// 医护人员被接单提醒{hotel}{date}
		//【日月同城】XXX酒店已接受您于 X月X日入住的住宿请求，请登录系统查询酒店详情和联系方式。
	]
];
