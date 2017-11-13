##获取首页信息 API


|  Tables  |          说明          | 默认值  |
| :------: | :------------------: | :--: |
|   URL    | /api/v1/project |      |
| HTTP请求方式 |         GET          |      |
|  是否需要登录  |          否           |      |
|  授权访问限制  |          暂无          |      |
|  授权范围()  |          暂无          |      |
|   支持格式   |         JSON         |      |


表头参数:

| Tables | 类型及其范围 | 说明    | 默认值  |
| ------ | ------ | ----- | ---- |
| Authorization   | string | 接口验证用 |   "Bearer " + token   |

接口说明：
获取所有的项目列表(不包括服务器信息)

请求字段:
无


返回字段说明:

| Tables     | 类型及其范围 | 说明       | 默认值        |
| ---------- | ------ | -------- | ---------- |
| ev_error   | number | 请求是否成功   | 0为成功, 1为错误 |
| ev_message | string | 报错信息     | 空          |
| ea_data  | array  | 项目信息 |            |


| ea_data | 类型及其范围 | 说明          |
| --------- | ------ | ----------- |
| id        | number | 服务器id |
| name     | string | 项目名 |
| localPath      | string | 本地路径(基于项目目录/projects/)          |

返回结果(默认JSON):
```
{
    "ev_error": 0,
    "ea_data": [
        {
            "id": 10,
            "name": "ace68723/auto-deploy",
            "localPath": "ace68723/auto-deploy"
        }
    ]
}
```
