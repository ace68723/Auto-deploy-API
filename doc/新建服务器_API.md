
|  Tables  |          说明          | 默认值  |
| :------: | :------------------: | :--: |
|   URL    | /api/v1/server |      |
| HTTP请求方式 |         POST          |      |
|  是否需要登录  |          否           |      |
|  授权访问限制  |          暂无          |      |
|  授权范围()  |          暂无          |      |
|   支持格式   |         JSON         |      |


表头参数:

| Tables | 类型及其范围 | 说明    | 默认值  |
| ------ | ------ | ----- | ---- |
| token   | string | 接口验证用 |      |

接口说明：
新建项目

请求字段:
| Tables     | 类型及其范围 | 说明       |
| ---------- | ------ | -------- |
| io_server   | object | 服务器json object   |

| io_server | 类型及其范围 | 说明          |
| --------- | ------ | ----------- |
| project_name        | string | 项目名 |
| project_id        | number | 项目ID |
| name        | string | 服务器名 |
| user        | string | 登陆用户名 |
| password     | string | 登陆密码          |
| path     | string | 中转目录(基于~/)          |
| deploy_path     | string | 生产目录(基于/var/www)         |
| branch     | string | git分支          |


返回字段说明:

| Tables     | 类型及其范围 | 说明       | 默认值        |
| ---------- | ------ | -------- | ---------- |
| ev_error   | number | 请求是否成功   | 0为成功, 1为错误 |
| ev_message | string | 报错信息     | 空          |
| ev_data  | string  | 新建服务器的id |            |

返回结果(默认JSON):
```
{
    "ev_error": 0,
    "ev_data": 9
}
```
