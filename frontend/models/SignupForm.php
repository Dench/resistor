<?php
namespace frontend\models;

use common\models\Broker;
use common\models\Group;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $name;
    public $phone;
    public $address;
    public $type_id;
    public $sale_add;
    public $note_user;
    public $company;
    public $contact;
    public $recommend;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['group_id', 'default', 'value' => Group::GROUP_DEFAULT],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['name', 'phone', 'address'], 'required'],
            [['type_id', 'sale_add'], 'integer'],
            [['note_user', 'phone'], 'string'],
            [['name', 'company'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 20, 'min' => 7],
            [['address', 'contact', 'recommend'], 'string', 'max' => 255],
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
            'username' => Yii::t('app', 'Choose a login name'),
            'password' => Yii::t('app', 'Choose a password to login'),
            'name' => Yii::t('app', 'Enter your full name'), // Enter company name
            'company' => Yii::t('app', 'Company name (if)'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Actual address'),
            'contact' => Yii::t('app', 'Additional contacts'),
            'recommend' => Yii::t('app', 'Who recommended?'),
            'note_user' => Yii::t('app', 'Comments'),
            'note_admin' => Yii::t('app', 'Note for admin'),
            'sale_add' => Yii::t('app', 'Can add properties'),
            'edit' => Yii::t('app', 'Edit'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->validate()) {
                $broker = new Broker();
                $broker->user_id = 1;
                $broker->type_id = $this->type_id;
                $broker->name = $this->name;
                $broker->company = $this->company;
                $broker->phone = $this->phone;
                $broker->email = $this->email;
                $broker->address = $this->address;
                $broker->contact = $this->contact;
                $broker->recommend = $this->recommend;
                $broker->note_user = $this->note_user;
                $broker->sale_add = $this->sale_add;
                if ($broker->validate()) {
                    $user->save();
                    $broker->user_id = $user->id;
                    $broker->save();
                    return $user;
                }
            }
        }

        return null;
    }
}
