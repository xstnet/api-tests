# Api Tests By PhpStorm

#### 项目介绍
在phpstorm中使用的接口测试, 基于 Phpunit, 模拟curl 进行接口测试, 适用于任何项目, 只要本地能跑的起来, 或者是用来测试线上接口, 也是没有问题的

#### Demo
![demo][1]

#### 环境依赖
1. php >= 5.4
2. 必须已安装composer, 安装使用教程https://docs.phpcomposer.com/00-intro.html

#### 注意事项
1. 如果是在打开phpstorm 之后配置的虚拟域名, 或者是监听的端口, 可能会出现找不到地址的错误, 重启phpstorm应该可以解决这个问题, 再不行可以重启电脑
2. 整个项目中, 除了 apitests 这个文件夹, 是主要部分外, 其他的都是辅助进行测试的


#### 使用说明
1. 先克隆代码 `git clone https://github.com/xstnet/api-tests`
2. 代码中 `apitests` 才是真正使用到的代码, 其他的都不需要
3. 将项目中的 `apitests` 复制到你项目的根目录中
4. 将下面的代码添加到你自己的项目中`composer.json`中的 `require` 或者 `require-dev`中
 ```
 "phpunit/phpunit": ">=4.0",
 "guzzlehttp/guzzle": "~6.0"
 ```

5. 运行 `composer install`
6. 运行 `composer dump-autoload`
7. 将下面的代码添加到你自己的项目中`composer.json`中的 `autoload` 或者 `autoload-dev`, 如果已经有`psr-4`, 那么可以追加里面的内容

 ```
  "psr-4": {
      "apitests\\tests\\": "apitests/tests"
  }
 ```
8. 以上composer.json 配置文件可以参考`api-tests/composer.json`文件,**下面开始phpstorm的配置**
9. 使用 `Ctrl+Alt+s`打开phpstorm的设置界面 依次展开`Languages & Frameworks->PHP`, 如下图![phstrom设置PHP环境变量][2] 
     **然后保存, 此时保存是为了方便等下设置phpunit的时候看到效果**

10. 使用 `Ctrl+Alt+s`打开phpstorm的设置界面, 依次展开`Languages & Frameworks->PHP->Test Frameworks`, 如果是版本比较低的phpstorm, 这个时候应该打开 `Languages & Frameworks->PHP->PHPUnit`, 配置如下图中![此处输入图片的描述][3]![此处输入图片的描述][4]
11. phpstorm的配置已经完成了, 下面就该配置接口调试了
12. 打开`apitests/phpunit.xml.dist`文件, 在`第12行`中`bootstrap="../vendor/autoload.php`, 其中如果autoload.php 相对于你的autoload.php文件位置不对的话, 需要在这里调整
13. 然后在phpunit.xml.dist 文件下面API_SERVER 就是本地调试的配置的虚拟域名, 或者IP, 在`apitests/tests/api/BaseTest.php:52`文件中, 为base_uri 的设置方式, 有需要的话可以修改
14. `apitests/tests/api` 目录下为测试代码目录,其中包含了两个例子
15. 现在就可以修改一下`apitests/tests/api/index/IndexActionTest.php:15`中的代码, 然后`右击->Run 'testIndex'` 来开始测试了

#### 使用帮助
如果有问题, 可以邮箱联系我, 同时也可加QQ, 792539542@qq.com, 谢谢大家的支持


  [1]: https://raw.githubusercontent.com/xstnet/api-tests/master/images/demo.gif
  [2]: https://raw.githubusercontent.com/xstnet/api-tests/master/images/step-2.png
  [3]: https://raw.githubusercontent.com/xstnet/api-tests/master/images/step-2.png
  [4]: https://raw.githubusercontent.com/xstnet/api-tests/master/images/step-3.png