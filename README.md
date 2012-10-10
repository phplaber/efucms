
efucms
======

![efucms](./logo.png "Easy for use CMS")

说明
---

这是一个简单易用的内容管理系统（easy for use cms），开发这个项目更多的在于学习，包括PHP和ThinkPHP。当然，这个cms具备了内容管理系统的大多最基本的功能，包括栏目管理，文章管理等。如果你想迅速搭建起一个小型的内容发布网站，efucms不失为一个好的选择。你可以根据自己的需要，随意地对代码进行任何修改，因为efucms是开源的。

安装
---

将项目文件放在自己服务器根目录下，修改配置文件“config.php”中数据库权限，创建数据库efucms，最后手动导入数据库文件“efucms.sql”。后台登录用户名与密码都为“admin”，可自行修改。目前版本是1.0 beta，安装efucms需要手动导入数据库文件。在稍后的1.0版本中，将会提供安装界面。

SEO
---

为了网站的SEO，可以去掉URL里的index.php，配置方法如下：

1. httpd.conf配置文件中加载mod_rewrite.so模块
2. 修改“AllowOverride None”，将None改为All
3. 设置URL_MODEL的值为2
4. 将.htaccess文件放到入口文件的同级目录下

### .htaccess

    <IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
    </IfModule>

完成以上步骤后，重启Apache服务器，便能成功进行URL重写。

