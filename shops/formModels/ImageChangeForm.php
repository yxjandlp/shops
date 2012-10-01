<?php
/**
 * 修改店辅图片
 * @author yaoxianjin
 *
 * Date: 12-10-1
 * Time: 下午2:42
 */
class ImageChangeForm extends CFormModel
{
    public  $image;

    /**
     * 表单验证规则
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('image', 'required'),
            array('image', 'file', 'types'=>'jpg,gif,png', 'maxSize'=>204800),
        );
    }

    /**
     * 定义各属性显示的标签名
     */
    public function attributeLabels()
    {
        return array(
            'image' => '选择图片:',
        );
    }

}