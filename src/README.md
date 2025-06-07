# 图书共享系统
## 前言
图书共享系统应该算是我正式的第一个项目，而且还成功部署在ECS上。当然，作为一个课设，它有很多的不足之处，你可以用于学习或者参考，包括数据库表。
## 总结
- 语言：HTML、PHP、Javascript、CSS、SQL
- 开发工具：IntelliJ IDEA
- 下载：[bootstrap](https://getbootstrap.net/docs/getting-started/download/)、[PHP](https://www.php.net/downloads.php)（注：版本不是越新越好，合适、匹配最重要）
- 项目地址1（gitee）：[图书共享系统](https://gitee.com/jige4836/book-share-system)
- 项目地址2（github）：[book-share-system](https://github.com/jige4836/book-share-system)

项目后端全由PHP编写，可以一边与HTML、Javascript交互，还一边开启会话和MySQL“交流”，PHP是真的吊！

## 部署（可选）
1. 我是使用FileZilla进行部署，在服务器（Windows）上下载FileZilla服务端，在本机（Windows）上下载FileZilla客户端。
2. 通过客户端把static文件夹上传到服务端，包括数据库数据。
3. 然后测试登录（使用服务器地址），成功！！

**太久远了，忘了是不是这样，有可能错了，欢迎评论区大佬指正！！！**

当时是在B站看的教学，现在去找，发现下架了，但是有些类似的，不知道效果怎么样，有想法的可以试试。

最近重新登录上去，服务端过期了，没续费，当时第一年因为是学生免费。本地可以，就是样式排版布局不好（bootstrap我也是第一次用），隐性Bug应该不少，嘿嘿嘿。

**补充一下：**
- PHP的配置有点复杂，第一次配的，要注意！
- 文章和项目仅供参考！
- 登录通过login.html，登录后自动跳转到index.html(主页)！