<?php

/**
 * This is the model class for table "{{forum_message}}".
 *
 * The followings are the available columns in table '{{forum_message}}':
 * @property integer $id
 * @property integer $topic_id
 * @property integer $user_id
 * @property string $message
 * @property integer $date
 */
class ForumMessage extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forum_message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('topic_id, user_id, date', 'numerical', 'integerOnly'=>true),
            array('message', 'length', 'max'=>250),
			array('message', 'safe'),
			array('id, topic_id, user_id, message, date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'topic' => array(self::BELONGS_TO, 'ForumTopic', 'topic_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'       => Yii::t('ForumModule.forum', 'Id'),
			'topic_id' => Yii::t('ForumModule.forum', 'Topic'),
			'user_id'  => Yii::t('ForumModule.forum', 'User'),
			'message'  => Yii::t('ForumModule.forum', 'Message'),
			'date'     => Yii::t('ForumModule.forum', 'Date'),
		);
	}

    public function beforeSave()
    {
        if ( $this->getIsNewRecord() )
        {
            $this->date = (new DateTime('now'))->getTimestamp();
        }
        return parent::beforeSave();
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
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('date',$this->date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterFind()
    {
        $date = new DateTime();
        $date->setTimestamp($this->date);

        $this->date = $date->format('Y-m-d H:i:s');;

        return parent::afterFind();

    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ForumMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTopicTitle()
    {
        if ($model = $this->topic) {
            return $model->title;
        }

        return '---';
    }

    public function getUserNickname()
    {
        if ($model = $this->user) {
            return $model->nick_name;
        }

        return '---';
    }

    public function getUserList()
    {
        $users = User::model()->findAll();

        $list = array();

        foreach ($users as $user) {

            $list[$user->id] = $user->nick_name;
        }

        return $list;
    }
}
