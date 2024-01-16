<?php

namespace app\models;

use Yii;

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
 * @property Orders[] $orders0
 */
class RegForm extends \app\models\User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public $confirm_password;
    public $agree;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'login', 'password', 'token'], 'required'],
            [['is_admin'], 'integer'],
            [['name', 'surname', 'patronymic', 'email', 'login'], 'string', 'max' => 100],
            [['password', 'token'], 'string', 'max' => 200],
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
            'token' => 'Token',
            'is_admin' => 'Is Admin',
            'confirm_password' => 'Повторите пароль',
            'agree' => 'Подтвердите согласие на обработку персональных данных',
        ];
    }

    /**
     * Gets query for [[Orders0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Orders::class, ['user_id' => 'id']);
    }
}