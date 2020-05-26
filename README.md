使用`Composer`安装`icarexm`的文件处理类库：

~~~
composer require icarexm/image:dev-master

~~~

## 生成缩略图
下面来看下缩略图操作类的基础方法。

### 打开图像文件

假设当前入口文件目录下面有一个`image.png`文件，如图所示：

![](https://git.kancloud.cn/repos/yhl18/wq_frame/raw/c9bf3d6417c8076f066c57cd15ac56564833cad1/images/mcdonald_lake-004.jpg?access-token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1OTA1NDEyODMsImlhdCI6MTU5MDQ5ODA4MywicmVwb3NpdG9yeSI6InlobDE4XC93cV9mcmFtZSIsInVzZXIiOnsidXNlcm5hbWUiOiJ5aGwxOCIsIm5hbWUiOiJNclllNTg2OSIsImVtYWlsIjoiNTU1ODUxOTBAcXEuY29tIiwidG9rZW4iOiI3MTUxN2RiMzc4MGQyMjA2Mjc1OTllMjM0ZTRhOGY5NiIsImF1dGhvcml6ZSI6eyJwdWxsIjp0cnVlLCJwdXNoIjp0cnVlLCJhZG1pbiI6dHJ1ZX19fQ.Rrt9AqXrbmbeHt-EvLsR-11U0lwyHgBoFFN5ehkKpaU)

使用`open`方法打开图像文件进行相关操作：

~~~
$thumb = icarexm\image\Thumb::open('image.png', ROOT_PATH);

~~~
### 获取图像信息

可以获取打开图片的信息，包括图像大小、类型等，例如：

~~~
$thumb = icarexm\image\Thumb::open('image.png', ROOT_PATH);

echo 'width:'.$thumb->getOriginalw().'<br/>';
echo 'height:'.$thumb->getOriginalh().'<br/>';
echo 'type:'.$thumb->getSourceType().'<br/>';
echo 'size:'.$thumb->getOriginalSize().'kb<br/>';
echo 'mime:'.$thumb->getSourceMime().'<br/>';

~~~

### 裁剪图片
使用`crop`和`save`方法完成裁剪图片功能。

~~~
$thumb =  icarexm\image\Thumb::open('image.png', ROOT_PATH);
//将图片裁剪为180x180并保存为image.thumb.png
$thumb->crop(180, 180)->save();
//获取相对路径
echo $thumb->getSrcname();
//获取完整路径
echo $thumb->getPathname();

~~~
生成的图片如图：

![](https://git.kancloud.cn/repos/yhl18/wq_frame/raw/c9bf3d6417c8076f066c57cd15ac56564833cad1/images/mcdonald_lake-004.thumb.jpg?access-token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1OTA1NDEyODMsImlhdCI6MTU5MDQ5ODA4MywicmVwb3NpdG9yeSI6InlobDE4XC93cV9mcmFtZSIsInVzZXIiOnsidXNlcm5hbWUiOiJ5aGwxOCIsIm5hbWUiOiJNclllNTg2OSIsImVtYWlsIjoiNTU1ODUxOTBAcXEuY29tIiwidG9rZW4iOiI3MTUxN2RiMzc4MGQyMjA2Mjc1OTllMjM0ZTRhOGY5NiIsImF1dGhvcml6ZSI6eyJwdWxsIjp0cnVlLCJwdXNoIjp0cnVlLCJhZG1pbiI6dHJ1ZX19fQ.Rrt9AqXrbmbeHt-EvLsR-11U0lwyHgBoFFN5ehkKpaU)

### 等比例缩放
使用`scale`和`save`方法完成图片等比例缩放功能。

~~~
$thumb =  icarexm\image\Thumb::open('image.png', ROOT_PATH);
//将图片以%50等比例缩放并保存为image.thumb.png
$thumb->scale(50)->save();
//获取相对路径
echo $thumb->getSrcname();
//获取完整路径
echo $thumb->getPathname();

~~~
生成的图片如图：
![](https://git.kancloud.cn/repos/yhl18/wq_frame/raw/c9bf3d6417c8076f066c57cd15ac56564833cad1/images/mcdonald_lake-004.thumb_1587547872137.jpg?access-token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1OTA1NDEyODMsImlhdCI6MTU5MDQ5ODA4MywicmVwb3NpdG9yeSI6InlobDE4XC93cV9mcmFtZSIsInVzZXIiOnsidXNlcm5hbWUiOiJ5aGwxOCIsIm5hbWUiOiJNclllNTg2OSIsImVtYWlsIjoiNTU1ODUxOTBAcXEuY29tIiwidG9rZW4iOiI3MTUxN2RiMzc4MGQyMjA2Mjc1OTllMjM0ZTRhOGY5NiIsImF1dGhvcml6ZSI6eyJwdWxsIjp0cnVlLCJwdXNoIjp0cnVlLCJhZG1pbiI6dHJ1ZX19fQ.Rrt9AqXrbmbeHt-EvLsR-11U0lwyHgBoFFN5ehkKpaU)

## 添加图片水印

系统支持添加图片及文字水印，下面依次举例说明  
添加图片水印，我们下载框架logo文件到根目录进行举例：

~~~
$water = icarexm\image\Water::open('image.png', ROOT_PATH);
// 给原图中间添加水印并保存image.water.png
$water->water('logo.png', icarexm\image\Water::WATER_CENTER)->save(); 
//获取相对路径
echo $water->getSrcname();
//获取完整路径
echo $water->getPathname();
~~~

生成的图片效果如下：

![](https://git.kancloud.cn/repos/yhl18/wq_frame/raw/c9bf3d6417c8076f066c57cd15ac56564833cad1/images/beijing.water.jpg?access-token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1OTA1NDEyODMsImlhdCI6MTU5MDQ5ODA4MywicmVwb3NpdG9yeSI6InlobDE4XC93cV9mcmFtZSIsInVzZXIiOnsidXNlcm5hbWUiOiJ5aGwxOCIsIm5hbWUiOiJNclllNTg2OSIsImVtYWlsIjoiNTU1ODUxOTBAcXEuY29tIiwidG9rZW4iOiI3MTUxN2RiMzc4MGQyMjA2Mjc1OTllMjM0ZTRhOGY5NiIsImF1dGhvcml6ZSI6eyJwdWxsIjp0cnVlLCJwdXNoIjp0cnVlLCJhZG1pbiI6dHJ1ZX19fQ.Rrt9AqXrbmbeHt-EvLsR-11U0lwyHgBoFFN5ehkKpaU)

`water`方法的第二个参数表示水印的位置，默认值是`WATER_SOUTH`，可以传入下列`icarexm\image\Water`类的常量或者对应的数字：

~~~
//常量，标识左上角水印
const WATER_NORTHWEST = 1; 
//常量，标识上居中水印
const WATER_NORTH     = 2; 
//常量，标识右上角水印
const WATER_NORTHEAST = 3; 
//常量，标识左居中水印
const WATER_WEST      = 4; 
//常量，标识居中水印
const WATER_CENTER    = 5; 
//常量，标识右居中水印
const WATER_EAST      = 6; 
//常量，标识左下角水印
const WATER_SOUTHWEST = 7; 
//常量，标识下居中水印
const WATER_SOUTH     = 8; 
//常量，标识右下角水印
const WATER_SOUTHEAST = 9; 

~~~

## 添加文字水印

系统支持添加图片及文字水印，下面依次举例说明  
添加图片水印，我们下载框架logo文件到根目录进行举例：

~~~
$water = icarexm\image\Water::open('image.png', ROOT_PATH);
// 给原图中间添加文字水印并保存image.water.png
$water->text('TinyFrame', 18, '#00000000', icarexm\image\Water::WATER_CENTER)->save();
//获取相对路径
echo $water->getSrcname();
//获取完整路径
echo $water->getPathname();
~~~

生成的图片效果如下：
![](https://git.kancloud.cn/repos/yhl18/wq_frame/raw/c9bf3d6417c8076f066c57cd15ac56564833cad1/images/beijing.water_1587554947051.jpg?access-token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1OTA1NDEyODMsImlhdCI6MTU5MDQ5ODA4MywicmVwb3NpdG9yeSI6InlobDE4XC93cV9mcmFtZSIsInVzZXIiOnsidXNlcm5hbWUiOiJ5aGwxOCIsIm5hbWUiOiJNclllNTg2OSIsImVtYWlsIjoiNTU1ODUxOTBAcXEuY29tIiwidG9rZW4iOiI3MTUxN2RiMzc4MGQyMjA2Mjc1OTllMjM0ZTRhOGY5NiIsImF1dGhvcml6ZSI6eyJwdWxsIjp0cnVlLCJwdXNoIjp0cnVlLCJhZG1pbiI6dHJ1ZX19fQ.Rrt9AqXrbmbeHt-EvLsR-11U0lwyHgBoFFN5ehkKpaU)
