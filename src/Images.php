<?php
// +----------------------------------------------------------------------
// | zaihukeji [ WE CAN DO IT MORE SIMPLE]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2020 http://icarexm.com/ All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: MrYe    <email：55585190@qq.com>
// +----------------------------------------------------------------------
namespace icarexm\image;

use icarexm\helper\Str;
use \Exception;

abstract class Images
{
    /**
     * 原图路径
     * @var string
     */
    protected $originalFilename;

    /**
     * 文件后缀
     * @var string
     */
    protected $fileSuffix;

    /**
     * 新图路径
     * @var string
     */
    protected $pathName;

    /**
     * 图片根路径
     * @var string
     */
    protected $rootPath;

    /**
     * 原宽
     * @var int
     */
    protected $originalw;

    /**
     * 原高
     * @var int
     */
    protected $originalh;

    /**
     * 原图大小
     * @var string
     */
    protected $originalSize;

    /**
     * 图片类型
     * @var int
     */
    protected $sourceType;

    /**
     * 图片MIME信息
     * @var string
     */
    protected $sourceMime;


    /**
     * Images constructor.
     * @param string $filename
     * @param string|null $rootPath
     * @throws Exception
     */
    public function __construct($filename, $rootPath = null)
    {
        if (!function_exists('finfo_open')) {
            throw new Exception('FileInfo extension is not enabled');
        }

        $this->originalFilename = $filename;

        $image_info = getimagesize($filename);

        if (!$image_info) {
            throw new Exception('Could not read file');
        }

        $this->originalSize = filesize($filename);
        list(
            $this->originalw,
            $this->originalh,
            $this->sourceType
            ) = $image_info;
        $this->sourceMime = $image_info['mime'];

        $this->rootPath = $rootPath;

    }


    /**
     * 返回图片宽度
     * @return int
     */
    public function getOriginalw()
    {
        return $this->originalw;
    }

    /**
     * 返回图片高度
     * @return int
     */
    public function getOriginalh()
    {
        return $this->originalh;
    }

    /**
     * 返回图片大小，kb计算
     * @return float
     */
    public function getOriginalSize()
    {
        return floor($this->originalSize /  (1024));
    }

    /**
     * 获取Mime
     * @return string
     */
    public function getSourceMime()
    {
        return $this->sourceMime;
    }

    /**
     * 返回图片类型
     * @return string
     */
    public function getSourceType()
    {
        return image_type_to_extension($this->sourceType, false);
    }

    /**
     * 设置文件后缀
     * @param $fileSuffix
     * @return $this
     */
    public function setFileSuffix($fileSuffix)
    {
        $this->fileSuffix = $fileSuffix;

        return $this;
    }

    /**
     * 获取原图src
     * @param string|null $rootPath
     * @return string
     */
    public function getOriginalSrc($rootPath = null)
    {
        return $this->parseSrc($this->originalFilename, $rootPath);
    }

    /**
     * 获取原图的路径
     * @return mixed
     */
    public function getOriginalFilename()
    {
        return $this->originalFilename;
    }

    /**
     * 获取新图的src
     * @param string|null $rootPath
     * @return string
     */
    public function getSrcname($rootPath = null)
    {
        return $this->parseSrc($this->pathName, $rootPath);
    }

    /**
     * 获取新图的绝对路径
     * @return string
     */
    public function getPathname()
    {
        return $this->pathName;
    }

    /**
     * 获取文件名称
     * @return string
     */
    public function getFilename()
    {

        $pathArr = pathinfo($this->pathName);

        return isset($pathArr['basename']) ? $pathArr['basename'] : $this->pathName;
    }

    /**
     * 获取新图路径
     * @param string $filename
     * @return string
     */
    protected function getUploadName($filename)
    {

        if(!empty($this->rootPath) && !empty($filename)) {

            if(Str::startsWith($filename, $this->rootPath)) {

                $this->pathName = $filename;

            } elseif(!empty($filename)) {

                $this->pathName = $this->rootPath.$filename;

            }

            @mkdir(dirname($this->pathName), 0777, true);

        } else {

            $pathinfo = pathinfo($this->originalFilename);
            $patharr = [
                $pathinfo['dirname'],
                '/'.$pathinfo['filename'],
                '.'.$this->fileSuffix,
                '.'.$pathinfo['extension'],
            ];

            $this->pathName = implode('', $patharr);
        }

        return $this->pathName;
    }

    /**
     * 解析src
     * @param string$filename
     * @param string|null $rootPath
     * @return string
     */
    protected function parseSrc($filename, $rootPath = null)
    {
        $rootPath = !empty($rootPath) ? $rootPath : $this->rootPath;
        if(empty($rootPath)) {
            //未存在根目录
            return $filename;
        }
        //解析path
        $pathArr = explode($rootPath, $filename);
        list(, $srcName) = $pathArr;

        return '/'.$srcName;
    }
}

