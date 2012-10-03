<?php
/**
 * 留言处理控制器
 * @author yaoxianjin
 *
 * Date: 12-10-2
 * Time: 上午10:41
 */
class NoteController extends BaseController {

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
            'checkRole',
        );
    }

    /**
     * 如果角色不是店辅管理员，则给出的action将直接跳转到首页
     *
     * @param $filterChain
     */
    public function filterCheckRole($filterChain) {
        $filterArray = array('index', 'detail', 'delete');
        if ( Yii::app()->user->getState('role') != 'shop' && in_array($this->action->id, $filterArray) ) {
            $this->redirect(Yii::app()->homeUrl);
        }
        $filterChain->run();
    }

    /**
     * 访问控制
     * @return array
     */
    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('index', 'detail', 'delete', 'add'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*')
            )
        );
    }

    /**
     * 留言列表
     */
    public function actionIndex()
    {
        $this->setPageTitle('管理留言');

        $id = Yii::app()->user->getId();
        $filter =  $this->getRequestParam('filter');
        $noteIdArray =  $this->getRequestParam('select');
        if ( ! empty($noteIdArray) ) {
            Note::model()->updateAll(array('is_handled'=>1),'shop_id='.$id.' and id in('.implode(',',$noteIdArray).')');
            $this->showSuccessMessage('设置成功', Yii::app()->createUrl('note/'));
        }
        $model = new Note('search');
        $model->shop_id = $id;
        if ( in_array($filter, array('0','1'), true) ) {
            $model->is_handled = $filter;
        }
        $this->render('index', array(
            'model' => $model,
            'shop_id' => $id,
            'filter' => $filter
        ));
    }

    /**
     * 添加留言
     */
    public function actionAdd( $id )
    {
        $this->setPageTitle('留言');

        if( Yii::app()->user->getState('role') != 'member' ){
            $this->redirect(Yii::app()->homeUrl);
        }
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
        $this->render('add', array(
            'model' => $model
        ));
    }

    /**
     * 查看留言详细内容
     */
    public function actionDetail( $id )
    {
        $note = Note::model()->findByPk($id);
        if( $note ){
            $this->checkOwner($note['shop_id']);
            $this->render('detail', array(
                'note' => $note
            ));
        }else{
            throw new CHttpException(404);
        }
    }

    /**
     * 删除留言
     */
    public function actionDelete()
    {
        $noteIdArray = $this->getRequestParam('select');
        if ( ! empty($noteIdArray) ) {
            $shopId = $this->getRequestParam('shop_id');
            $this->checkOwner($shopId);
            Note::model()->deleteAll('shop_id='.$shopId.' and id in('.implode(',',$noteIdArray).')');
            $this->showSuccessMessage('删除成功', Yii::app()->createUrl('note/'));
        }
    }

    /**
     * 判断是否已处理
     */
    protected function gridIsHandled( $data, $row )
    {
        return $data->is_handled==1 ? "已处理" : "未处理";
    }

    /**
     * 留言内容摘要显示
     */
    protected function gridNoteContent( $data, $row )
    {
        return StringUtils::truncateText($data->message, 30);
    }

    /**
     * 商家权限过滤,只有本店辅管理员有权限
     *
     * @param int $id
     */
    protected  function checkOwner( $id )
    {
        if ( Yii::app()->user->isGuest || Yii::app()->user->getState('role') != 'shop' || Yii::app()->user->getId() != $id ) {
            throw new CHttpException(403);
        }
    }

}