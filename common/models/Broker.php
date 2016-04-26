<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "broker".
 *
 * @property integer $user_id
 * @property integer $type_id
 * @property string $name
 * @property string $company
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $contact
 * @property string $recommend
 * @property string $note_user
 * @property string $note_admin
 * @property integer $sale_add
 * @property string $edit
 *
 * @property User $user
 */
class Broker extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'broker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'phone', 'email', 'address'], 'required'],
            [['user_id', 'type_id', 'sale_add'], 'integer'],
            [['note_user', 'note_admin', 'edit'], 'string'],
            ['email', 'email'],
            [['name', 'company', 'email'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 12, 'min' => 12],
            ['phone', 'match', 'pattern' => '/^[0-9]{12}$/'],
            [['address', 'contact', 'recommend'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'type_id' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'company' => Yii::t('app', 'Works in the company'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'contact' => Yii::t('app', 'Additional contacts'),
            'recommend' => Yii::t('app', 'Who recommended?'),
            'note_user' => Yii::t('app', 'Comments'),
            'note_admin' => Yii::t('app', 'Note for admin'),
            'sale_add' => Yii::t('app', 'Can add properties'),
            'edit' => Yii::t('app', 'Edit'),
        ];
    }

    public static function getTypeList()
    {
        return [
            1 => Yii::t('app', 'Agent'), // Частный агент
            2 => Yii::t('app', 'Company'), // Представитель компании
        ];
    }

    public function getTypeName()
    {
        $a = self::getTypeList();
        return $a[$this->type_id];
    }

    public static function notifyEdit()
    {
        return self::find()->where(['!=', 'edit', ''])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
