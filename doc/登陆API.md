
|  Tables  |          说明          | 默认值  |
| :------: | :------------------: | :--: |
|   URL    | /auth/login |      |
| HTTP请求方式 |         POST          |      |
|  是否需要登录  |          否           |      |
|  授权访问限制  |          暂无          |      |
|  授权范围()  |          暂无          |      |
|   支持格式   |         JSON         |      |


表头参数:

无

接口说明：
登陆

请求字段:
无

| Tables | 类型及其范围 | 说明    | 默认值  |
| ------ | ------ | ----- | ---- |
| username   | string | 用户名 |   |
| password   | string | 密码 |   |

返回字段说明:

| Tables     | 类型及其范围 | 说明       | 默认值        |
| ---------- | ------ | -------- | ---------- |
| ev_error   | number | 请求是否成功   | 0为成功, 1为错误 |
| ev_message | string | 报错信息     | 空          |
| ev_token  | string  | 返回的token |            |

返回结果(默认JSON):
```
{
    "ev_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE1MTA2MTE4NjksImV4cCI6MTUxMDYxNTQ2OSwibmJmIjoxNTEwNjExODY5LCJqdGkiOiJ6Z200cXVYUmFQaXhLU3p3Iiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.rwmEpiR8vqpzK5xT8eqYUgY9ozcRywJNrsH0_31LDLA",
    "ev_status": 0
}
```
