<?php

/**
 * This is the model class for table "{{forum_topic}}".
 *
 * The followings are the available columns in table '{{forum_topic}}':
 * @property integer $id
 * @property integer $forum_id
 * @property integer $user_id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property integer $status
 */
class ForumTopic extends yupe\models\YModel
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSE = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forum_topic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, alias', 'required'),
			array('forum_id, user_id, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			array('alias', 'length', 'max'=>150),
            array('alias', 'unique'),
            array('status', 'in', 'range' => array_keys($this->statusList)),
			array('description', 'safe'),
			array('id, forum_id, user_id, title, alias, description, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
            'forum' => array(self::BELONGS_TO, 'Forum', 'forum_id'),
            'messageCount' => array(self::STAT, 'ForumMessage', 'topic_id'),
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
			'forum_id'    => Yii::t('ForumModule.forum', 'Forum'),
			'user_id'     => Yii::t('ForumModule.forum', 'User'),
			'title'       => Yii::t('ForumModule.forum', 'Title'),
			'alias'       => Yii::t('ForumModule.forum', 'Alias'),
            'description' => Yii::t('ForumModule.forum', 'Description'),
            'status'      => Yii::t('ForumModule.forum', 'Status'),
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('forum_id',$this->forum_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
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
	 * @return ForumTopic the static model class
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

    public function getForumTitle()
    {
        if ($model = $this->forum) {
            return $model->title;
        }

        return '---';
    }

    public function getFormattedList()
    {
        $topics = ForumTopic::model()->findAll();

        $list = array();

        foreach ($topics as $topic) {

            $list[$topic->id] = $topic->title;
        }

        return $list;
    }

    public function getLastMessage()
    {
        return ForumMessage::model()->findByAttributes(
            array('topic_id' => $this->id),
            array('order'=>'id DESC','limit' => '1')
        );
    }
}
