# TVCalendarAPIwithPHP
一个用php写的基于TVCalendar网站的美剧日历api  
目前最新版：0.1.0

## 安装

首先，你需要确保自己有一个可以正常使用的web服务器，且已配置好php，并安装好php的cURL库。  
然后，将TVCalendarAPI.php拷贝到你的web服务器目录下即可。

## 使用

你需要使用get方法向服务器传递两个参数：

> username  
> password

url: http://<你的域名>/<你的目录>/TVCalendarAPI.php?username=&password=

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


