# Moe-counter

多种风格可选的萌萌计数器

> 使用php实现https://github.com/journey-ad/Moe-counter

> 数据每天重置为0，不重置请自行修改`date.php`52行条件

![Moe-counter](https://api.anyfan.top/count/)

<details>
<summary>More theme</summary>

##### moebooru
![Moe-counter](https://api.anyfan.top/count/?name=view)

##### gelbooru
![Moe-counter](https://api.anyfan.top/count/?name=view&theme=gelbooru)

##### rule34
![Moe-counter](https://api.anyfan.top/count/?name=view&theme=rule34)
</details>

## 示范
[https://api.anyfan.top/count/](https://api.anyfan.top/count/)

## 安装
 - 下载本项目到服务器

  ```bash
 $ git clone https://github.com/anyfan/Moe-counter.git
  ```

 - 删除`db.lock`文件

 - 在`date.php`更改数据库相关参数

 ```php
        $servername = "localhost";
        $username = "******";
        $password = "******";
        $dbname = "******";
```
 - 访问您的地址即可完成

 ## 使用

 #### SVG 地址
 `https://***/?name=***`

 #### Img 标签
`<img src="https://***/?name=***" />`

 #### Markdown
`![:name](https://***/?name=***)`

注意：任何人可以访问数据，请不要输入个人信息

#### 主题
只需要在地址后加入关键字即可例。

 - `theme`=`moebooru`/`gelbooru`/`rule34`

 - 默认为`moebooru`

示列 `https://***/?name=***&theme=***`

[https://api.anyfan.top/count/?name=anyfan&theme=rule34](https://api.anyfan.top/count/?name=anyfan&theme=rule34)


## Thanks
 - [journey-ad](https://github.com/journey-ad)

