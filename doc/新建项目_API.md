##获取首页信息 API


|  Tables  |          说明          | 默认值  |
| :------: | :------------------: | :--: |
|   URL    | /api/sb/v1/home_data |      |
| HTTP请求方式 |         GET          |      |
|  是否需要登录  |          否           |      |
|  授权访问限制  |          暂无          |      |
|  授权范围()  |          暂无          |      |
|   支持格式   |         JSON         |      |


表头参数:

| Tables | 类型及其范围 | 说明    | 默认值  |
| ------ | ------ | ----- | ---- |
| UUID   | string | 接口验证用 |      |

接口说明：
获取首页banner的详细信息，以及每个theme的前十个产品信息

请求字段:
无


返回字段说明:

| Tables     | 类型及其范围 | 说明       | 默认值        |
| ---------- | ------ | -------- | ---------- |
| ev_error   | number | 请求是否成功   | 0为成功, 1为错误 |
| ev_message | string | 报错信息     | 空          |
| ea_banner  | array  | BANNER信息 |            |
| ea_theme   | array  | 口味列表     |            |


| ea_banner | 类型及其范围 | 说明          |
| --------- | ------ | ----------- |
| id        | number | 首页Banner ID |
| image     | string | 首页Banner图片  |
| type      | string | 类别          |
| param     | string | 参数          |

| ea_theme  | 类型及其范围 | 说明   |
| --------- | ------ | ---- |
| tmid      | number | 口味ID |
| name      | string | 口味名字 |
| icon      | string | 口味图标 |
| prod_list | array  | 产品列表 |

| prod_list   | 类型及其范围 | 说明      |
| ----------- | ------ | ------- |
| pmid        | number | 产品ID    |
| fullname    | string | 产品名字    |
| description | string | 产品描述    |
| banner      | string | 产品图片    |
| price       | float  | 价格_min  |
| weights     | number | 权重 _min |
| related     | array  | 相关产品    |

| related     | 类型及其范围 | 说明      |
| ----------- | ------ | ------- |
| pmid        | number | 产品ID    |
| fullname    | string | 产品名字    |
| description | string | 产品描述    |
| image       | string | 产品图片    |
| price       | float  | 价格_min  |
| weights     | number | 权重 _min |




返回结果(默认JSON): （稍后更新！！！！！！！）
```
{
  ev_error: 0,
  ev_message: "",
  ea_banner: [
    {
      id: number,
      image: string,
      type: number,
      param: string
    }
  ],
  ea_theme": [
    {
      tmid: number,
      name": string,
      icon_active: string,
      icon_deactive: string,
      prod_list: [
        {
          pmid: number,
          fullname: string,
          description: string,
          weights: number,
          price: string,
          banne": string,
          related: [
            {
              pmid: number,
              fullname: string,
              weights: number,
              price: string,
              description: string,
              image: string
            }
          ]
        }
      ]
    }
  ]
}
```
