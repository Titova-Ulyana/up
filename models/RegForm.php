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
            [['name', 'surname', 'email', 'login', 'password', 'confirm_password', 'agree'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'login'], 'string', 'max' => 100],
            [['password', 'confirm_password'], 'string', 'max' => 200],
            [['name', 'surname', 'patronymic'], 'match', 'pattern'=> '/^[А-Яа-яЁё-]{2,}$/u', 'message' => 'Используйте минимум 2 русские буквы'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['login'], 'unique'],
            [['password'], 'match', 'pattern'=>'/^[A-Za-z0-9]{6,}$/', 'message'=>'Используйте минимум 6 латинских букв и цифр'],
            [['confirm_password'], 'compare', 'compareAttribute'=>'password'],
            [['login'], 'match', 'pattern'=>'/^[A-Za-z0-9_]{6,}$/', 'message'=>'Используйте минимум 6 латинских букв и цифр'],
            [['agree'], 'compare', 'compareValue'=>true, 'message'=>''],

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
