<?php

namespace humhub\modules\mail\models;

use humhub\modules\content\widgets\richtext\RichText;
use humhub\modules\mail\live\NewUserMessage;
use humhub\modules\mail\live\UserMessageDeleted;
use humhub\modules\mail\notifications\MailNotificationCategory;
use humhub\modules\notification\targets\BaseTarget;
use humhub\modules\notification\targets\MailTarget;
use Yii;
use humhub\components\ActiveRecord;
use humhub\modules\user\models\User;
use humhub\models\Setting;
use humhub\modules\mail\models\Message;

/**
 * This class represents a message within a conversation.
 *
 * The followings are the available columns in table 'message_entry':
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property integer $file_id
 * @property string $content
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property Message $message
 * @property User $user
 * @property File $file
 *
 * @package humhub.modules.mail.models
 * @since 0.5
 */
class MessageEntry extends ActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'message_entry';
    }

    /**
     * @param \humhub\modules\mail\models\Message $message
     * @param User $user
     * @param $content
     * @return static
     */
    public static function createForMessage(Message $message, User $user, $content)
    {
        // Attach Message Entry
        return new static([
            'message_id' => $message->id,
            'user_id' => $user->id,
            'content' => $content
        ]);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            [['message_id', 'user_id', 'content'], 'required'],
            [['message_id', 'user_id', 'file_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getMessage()
    {
        return $this->hasOne(Message::class, ['id' => 'message_id']);
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {

            // Updates the updated_at attribute
            $this->message->save();
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        RichText::postProcess($this->content, $this);
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function afterDelete()
    {
        foreach ($this->message->users as $user) {
            Yii::$app->live->send(new UserMessageDeleted([
                'contentContainerId' => $user->contentcontainer_id,
                'message_id' => $this->message_id,
                'entry_id' => $this->id,
                'user_id' => $user->id
            ]));
        }


        parent::afterDelete();
    }

    /**
     * Notify User in this message entry
     */
    public function notify()
    {
        (new MessageNotification($this->message, $this))->notifyAll();
    }

    public function canEdit()
    {
        return $this->created_by == Yii::$app->user->id;
    }
}