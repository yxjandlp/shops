<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-30
 * Time: 下午8:37
 */
class ShopController extends BaseController {

    /**
     * 默认布局文件
     * @var string
     */
    public $layout="//layouts/site";

    /**
     * 过滤器
     * @return array
     */
    public function filters(){
        return array(
            'accessControl' ,
        );
    }

    /**
     * 访问控制
     * @return array
     */
    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('note', 'edit','manageNote','deleteNote'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('show', 'index'),
                'users'=>array('*'),
            ),
            array('deny',
                'users'=>array('*')
            )
        );
    }

    /**
     * 管理留言
     */
    public function actionManageNote( $id )
    {
        $this->checkOwner($id);
        $this->setPageTitle('管理留言');

        $filter =  $this->getRequestParam('filter');
        $noteIdArray =  $this->getRequestParam('select');
        if ( ! empty($noteIdArray) ) {
            Note::model()->updateAll(array('is_handled'=>1),'shop_id='.$id.' and id in('.implode(',',$noteIdArray).')');
        }
        $model = new Note('search');
        $model->shop_id = $id;
        if ( in_array($filter, array('0','1'), true) ) {
            $model->is_handled = $filter;
        }
        $this->render('manager_note', array(
            'model' => $model,
            'shop_id' => $id,
            'filter' => $filter
        ));
    }

    /**
     * 店辅主页
     */
    public function actionShow( $id )
    {
        $this->setPageTitle('商家');
        $shop = Shops::model()->findByPk($id);
        $this->render('index', array(
            'shop' => $shop
        ));
    }

    /**
     * 编辑店辅
     */
    public function actionEdit( $id )
    {
        $this->checkOwner($id);
        $this->setPageTitle('编辑店辅');

        $shop = Shops::model()->findByPk($id);
        $shopToCategory = ShopToCategory::model()->find('shop_id=:id', array(':id'=>$id));
        $model = new ShopForm('register');
        $model->attributes = $shop->attributes;
        $shopInfoArray = $this->getRequestParam('ShopForm');
        if ( ! empty($shopInfoArray) ){
            $shop->attributes = $shopInfoArray;
            if ($shop->validate()) {
                $shop->save();

                if ( $shopToCategory ) {
                    $shopToCategory->category_id = $shopInfoArray['category'];
                    $shopToCategory->save();
                }
                $this->showSuccessMessage('修改成功', Yii::app()->createUrl('shop/show',array('id'=>$id)));
            }
        }

        $categoryModel = ShopCategory::model()->findAll();
        $categoryList = CHtml::listData($categoryModel,'id', 'name');
        $this->render('edit', array(
            'model' => $model,
            'categoryList' => $categoryList,
            'category_id' => $shopToCategory->category_id,
        ));
    }

    /**
     * 修改图片
     */
    public function actionChangeImage( $id )
    {
        $this->checkOwner($id);
        $this->setPageTitle('修改图片');
    }

    /**
     * 用户留言
     */
    public function actionNote( $id )
    {
        $this->setPageTitle('留言');

        $model = new Note();
        $noteInfo = $this->getRequestParam('Note');
        if ( $noteInfo ) {
            $model->attributes = $noteInfo;
            if ( $model->validate() ) {
                $model->user_id = Yii::app()->user->getId();
                $model->username = Yii::app()->user->name;
                $model->shop_id = $id;
                $model->message = $noteInfo['message'];
                $model->is_handled = 0;
                if ( $model->save() ) {
                    $this->showSuccessMessage('留言成功', Yii::app()->createUrl('shop/show',array('id'=>$id)));
                }
            }
        }
        $this->render('note', array(
            'model' => $model
        ));
    }

    /**
     * 删除留言
     */
    public function actionDeleteNote() {
        $noteIdArray = $this->getRequestParam('select');
        if ( ! empty($noteIdArray) ) {
            $shopId = $this->getRequestParam('shop_id');
            Note::model()->deleteAll('shop_id='.$shopId.' and id in('.implode(',',$noteIdArray).')');
            $this->showSuccessMessage('删除成功', Yii::app()->createUrl('shop/manageNote', array('id'=>$shopId)));
        }
    }

    /**
     * 判断是否已处理
     */
    protected function gridIsHandled( $data, $row ) {
        return $data->is_handled==1 ? "已处理" : "未处理";
    }

    /**
     * 留言内容摘要显示
     */
    protected function gridNoteContent( $data, $row ) {
        return StringUtils::truncateText($data->message, 30);
    }

    /**
     * 商家权限过滤,只有本店辅管理员有权限
     *
     * @param int $id
     */
    private function checkOwner( $id ) {
        if ( Yii::app()->user->isGuest || Yii::app()->user->getState('role') != 'shop' || Yii::app()->user->getId() != $id ) {
            $this->redirect(Yii::app()->homeUrl);
        }
    }

}