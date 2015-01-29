<?php

/**
 * Модель Forum
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.forum.models
 * @since 0.1
 *
 */

/**
 * This is the model class for table "{{forum}}".
 *
 * The followings are the available columns in table '{{forum}}':
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property integer $status
 */
class Forum extends yupe\models\YModel
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forum}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, alias', 'required'),
			array('parent_id, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			array('alias', 'length', 'max'=>150),
            array('alias', 'unique'),
            array('status', 'in', 'range' => array_keys($this->statusList)),
			array('description', 'safe'),
			array('id, parent_id, title, alias, description, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'parent'     => array(self::BELONGS_TO, 'Forum', 'parent_id'),
            'topicCount' => array(self::STAT, 'ForumTopic', 'forum_id'),
		);
	}

    public function scopes()
    {
        return array(
            'open' => array(
                'condition' => 't.status = :status',
                'params' => array(':status' => self::STATUS_OPEN),
            ),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => Yii::t('ForumModule.forum', 'Id'),
			'parent_id'   => Yii::t('ForumModule.forum', 'Parent'),
            'title'       => Yii::t('ForumModule.forum', 'Title'),
			'alias'       => Yii::t('ForumModule.forum', 'Alias'),
			'description' => Yii::t('ForumModule.forum', 'Description'),
			'status'      => Yii::t('ForumModule.forum', 'Status'),
            //дополнительные
            'topicCount'   => Yii::t('ForumModule.forum', 'Number of topics'),
            'messageCount' => Yii::t('ForumModule.forum', 'Number of messages'),
            'lastMessage'  => Yii::t('ForumModule.forum', 'Last message'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Forum the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getStatusList()
    {
        return array(
            self::STATUS_OPEN   => Yii::t('ForumModule.forum', 'Open'),
            self::STATUS_CLOSE  => Yii::t('ForumModule.forum', 'Close'),
        );
    }

    public function getStatus()
    {
        $data = $this->getStatusList();
        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('ForumModule.forum', '*unknown*');
    }

    public function getParentName()
    {
        if ($model = $this->parent) {
            return $model->title;
        }

        return '---';
    }

    public function getParentList($list = array())
    {
        $forum = Forum::model()->findByAttributes(array('id' => $this->parent_id));

        if ( !is_null($forum) ) {
            $list[$forum->title] = array('/forum/forum/show', 'alias' => $forum->alias);
            $list = $forum->getParentList($list);
        }

        return $list;
    }

    public function getFormattedList($parent_id = null, $level = 0)
    {
        $forums = Forum::model()->findAllByAttributes(array('parent_id' => $parent_id));

        $list = array();

        foreach ($forums as $forum) {

            $forum->title = str_repeat('&emsp;', $level) . $forum->title;

            $list[$forum->id] = $forum->title;

            $list = CMap::mergeArray($list, $this->getFormattedList($forum->id, $level + 1));
        }

        return $list;
    }

    public function getForums()
    {
        $forums = new Forum('search');
        $forums->unsetAttributes();
        $forums->parent_id = $this->id;
        $forums->status = Forum::STATUS_OPEN;

        return $forums;
    }

    public function getTopics($limit = -1)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "`t`.*";
        $criteria->compare('forum_id',$this->id);
        $criteria->join = 'LEFT JOIN '.ForumMessage::model()->tableName().' AS `fm` ON `fm`.topic_id=`t`.id';
        $criteria->order = '`fm`.topic_id DESC';
        $criteria->group='`t`.id';
        $criteria->limit = $limit;

        return new CActiveDataProvider('ForumTopic', array(
            'criteria'=>$criteria,
        ));

        //return ForumTopic::model()->findAll($criteria);
    }

    public function getTopicsMessageCount()
    {
        $topics = $this->getTopics()->getData();

        $count = 0;
        foreach($topics as $topic) {
            $count += $topic->messageCount;
        }

        return $count;
    }

    public function getLastMessage()
    {
        $limit = 1;
        $topic = array_shift($this->getTopics($limit)->getData());

        if ( !is_null($topic) ) {
            return $topic->getLastMessage();
        }

        return $topic;
    }
}
