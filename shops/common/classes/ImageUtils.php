<?php
/**
 * 图片处理类
 * @author yaoxianjin
 *
 * Date: 12-10-6
 * Time: 下午5:52
 */
class ImageUtils
{
    /**
     * 不支持创建实例
     */
    private function __construct(){}

    /**
     * 裁剪图片
     *
     * @param string $dir
     * @param string $img_name
     * @param int $dst_w
     * @param int $dst_h
     * @return boolean
     */
    public static function CropImage($dir ,$img_name, $dst_w, $dst_h)
    {
        $dir = rtrim($dir, '/');
        $src_img = $dir . '/'.$img_name;
        $prefix = explode('.', $img_name);
        list($src_w,$src_h)=getimagesize($src_img);  // 获取原图尺寸

        $dst_scale = $dst_h/$dst_w; //目标图像长宽比
        $src_scale = $src_h/$src_w; // 原图长宽比

        if($src_scale>=$dst_scale){  // 过高
            $w = intval($src_w);
            $h = intval($dst_scale*$w);
            $x = 0;
            $y = ($src_h - $h)/3;
        }else{ // 过宽
            $h = intval($src_h);
            $w = intval($h/$dst_scale);
            $x = ($src_w - $w)/2;
            $y = 0;
        }
        // 剪裁
        $source = imagecreatefromjpeg($src_img);
        $croped = imagecreatetruecolor($w, $h);
        imagecopy($croped,$source,0,0,$x,$y,$src_w,$src_h);
        // 缩放
        $scale = $dst_w/$w;
        $target = imagecreatetruecolor($dst_w, $dst_h);
        $final_w = intval($w*$scale);
        $final_h = intval($h*$scale);
        imagecopyresampled($target,$croped,0,0,0,0,$final_w,$final_h,$w,$h);

        imagejpeg($target, $dir . '/' .$prefix[0].'_174x140.jpg');
        imagedestroy($target);
        return true;
    }

    /**
     * 生成缩略图
     *
     * @param int $maxWidth
     * @param int $maxHeight
     * @param string $sourceImage
     * @param string $destImage
     * @paran boolean $output
     */
    public static function createThumbnail( $maxWidth, $maxHeight, $sourceImage, $destImage, $output=false )
    {
        $thumb = new Thumbnail(1, $maxWidth, $maxHeight);
        $thumb->createThumbnail($sourceImage, $destImage , $output);
        return true;
    }

}