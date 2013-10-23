oryzias-blog
============

#軽量で高速なブログシステム

[デモ](http://blog.presentation.bz/)

WoredPressとの比較

##WP

![コールグラフ](http://presentation.bz/img/member/pc/1/25.png)
![xhprofのサマリー](http://presentation.bz/img/member/pc/1/27.png)

メモリ1GBのVM上にNginx+PHP5.5を入れてのAB

+ Requests per second: 2.8req/sec
+ Time taken for tests: 356.5seconds
+ Time per request: 356.5ms

##Oryzias Blog

![コールグラフ](http://presentation.bz/img/member/pc/1/24.png)
![xhprofのサマリー](http://presentation.bz/img/member/pc/1/26.png)

メモリ1GBのVM上にNginx+PHP5.5を入れてのAB

+ Requests per second: 55.0req/sec
+ Time taken for tests: 18.1seconds
+ Time per request: 18.1ms
