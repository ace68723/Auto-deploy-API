##获取首页信息 API


|  Tables  |          说明          | 默认值  |
| :------: | :------------------: | :--: |
|   URL    | /api/v1/mapping |      |
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
获取所有的服务器与项目mapping列表(包括所有信息)

请求字段:
无


返回字段说明:

| Tables     | 类型及其范围 | 说明       | 默认值        |
| ---------- | ------ | -------- | ---------- |
| ev_error   | number | 请求是否成功   | 0为成功, 1为错误 |
| ev_message | string | 报错信息     | 空          |
| ea_data  | array  | mapping信息 |            |


| ea_data | 类型及其范围 | 说明          |
| --------- | ------ | ----------- |
| server_id        | number | 服务器id |
| name     | string | 服务器名 |
| project_id     | number | 项目id |
| project_name     | string | 项目名 |
| project_path     | string | 项目路径(基于项目目录/projects/) |
| ip      | string | 服务器ip          |
| user     | string | 登陆用户名          |
| password     | string | 登陆密码          |
| path     | string | 中转目录(基于~/)          |
| deploy_path     | string | 生产目录(基于/var/www)         |
| branch     | string | git分支          |


返回结果(默认JSON):
```
{
    "ev_error": 0,
    "ea_data": [
        {
            "server_id": 8,
            "name": "new",
            "project_id": 10,
            "project_name": "ace68723/auto-deploy",
            "project_path": "ace68723/auto-deploy",
            "ip": "45.77.216.62",
            "user": "root",
            "path": "proj",
            "deploy_path": "proj",
            "branch": "master",
            "password": "Tr,3TvQQzBW}8-P)"
        }
    ]
}
```
