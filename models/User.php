<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $token
 * @property int $is_admin
 *
 * @property Orders[] $orders
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    
     public static function findIdentity($id)
     {
       return static::findOne($id);
       //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
     }
    
     public static function findIdentityByAccessToken($token, $type = null)
     {
        /*return static::findOne(['access_token' => $token]);
         foreach (self::$users as $user) {
             if ($user['accessToken'] === $token) {
                 return new static($user);
             }
         }
 
         return null;*/
     }

     public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return; 
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return; 
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function findByLogin($login)
    {
        return self::find()->where(['login'=> $login])->one();
    }


     public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'login', 'password'], 'required'],
            [['is_admin'], 'integer'],
            [['name', 'surname', 'patronymic', 'email', 'login'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'login' => 'Логин',
            'password' => 'Пароль',
            //'token' => 'Token',
            'is_admin' => 'Is Admin',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['user_id' => 'id']);
    }
}
