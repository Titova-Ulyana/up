<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name_product
 * @property string $photo
 * @property int $count
 * @property float $price
 * @property string $country
 * @property string $color
 * @property int $category_id
 *
 * @property Category $category
 * @property Orders[] $orders
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_product', 'photo', 'count', 'price', 'country', 'color', 'category_id'], 'required'],
            [['count', 'category_id'], 'integer'],
            [['price'], 'number'],
            [['name_product'], 'string', 'max' => 100],
            [['photo'], 'file', 'extensions' => ['png', 'jpg', 'gif', 'jpeg'],'skipOnEmpty' => false ],
            [['country', 'color'], 'string', 'max' => 50],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_product' => 'Название',
            'photo' => 'Photo',
            'count' => 'Количество',
            'price' => 'Цена',
            'country' => 'Страна-Производитель',
            'color' => 'Цвет',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['product_id' => 'id']);
    }
}
