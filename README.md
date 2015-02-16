# TVCalendarAPIwithPHP
一个用php写的基于TVCalendar网站的美剧日历api  
目前最新版：0.2.0

## 更新

相比于0.1.0版本，新版更改了目录结构，使其更为合理。  
除了之前已有的日历抓取功能外，新加入了注册、获取全部节目、获取收藏的节目、添加节目到收藏、从收藏删除节目功能。  
**注意：返回数据的status值可能出现错误！**

## 安装

首先，你需要确保自己有一个可以正常使用的web服务器，且已配置好php，并安装好php的cURL库。  
然后，将TVCalendarAPI文件夹拷贝到你的web服务器目录下即可。

## 使用

#### getcalendar.php

你需要使用get方法向服务器传递两个参数：

> username  
> password

url: http://<你的域名>/<你的目录>/TVCalendarAPI/getcalendar.php?username=&password=

你将获取到一段json数据，格式如下：

> {
> > status: ture/false,
> > msg: "none",
> > data: {
> > > "date": [
> > > > {
> > > > > name: "the name of episode",  
> > > > > season: "a digit from 0 to 99",  
> > > > > episode: "a digit from 0 to 99"
> > > > 
> > > > },  
> > > > { another... }
> > > 
> > > ],  
> > > "anotherdate...": []
> > 
> > }
> 
> }  


