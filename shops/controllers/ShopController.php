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
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 管理留言';

        $filter = '0';
        $filterValue =  $this->getRequestParam('filter');
        if ( $filter != null ) {
            $filter = $filterValue;
        }
        $noteIdArray =  $this->getRequestParam('select');
        if ( ! empty($noteIdArray) ) {
            Note::model()->updateAll(array('is_handled'=>1),'shop_id='.$id.' and id in('.implode(',',$noteIdArray).')');
        }
        $model = new Note('search');
        $model->shop_id = $id;
        if ( ! empty($filter) ) {
            if ( $filter == '1' )
                $model->is_handled = 0;
            else
                $model->is_handled = 1;
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
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 商家';

        $shop = Shops::model()->findByPk($id);
        $this->render('index', array(
            'shop' => $shop
        ));
    }

    /**
     * 编辑店辅
     */
    public function actionEdit( $id ) {

    }

    /**
     * 用户留言
     */
    public function actionNote( $id )
    {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 留言';

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
        }

        $this->showSuccessMessage('删除成功', Yii::app()->createUrl('shop/manageNote', array('id'=>$shopId)));
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

}