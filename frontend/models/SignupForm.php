<?php
namespace frontend\models;

use common\models\Broker;
use common\models\User;
use yii\base\Model;
use Yii;

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

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['name', 'phone', 'address'], 'required'],
            [['type_id', 'sale_add'], 'integer'],
            [['note_user'], 'string'],
            [['name', 'company'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 12, 'min' => 12],
            ['phone', 'match', 'pattern' => '/^[0-9]{12}$/'],
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
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password to login'),
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
