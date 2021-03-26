<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "cprofile".
 *
 * @property int $cprofile_id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property int $phone_code
 * @property int $phone_number
 * @property int $id_number
 * @property string $created_at
 * @property string $cprofile_image
 *
 * @property User $user
 */
class Cprofile extends \yii\db\ActiveRecord
{
 /**
     *
     * @var \yii\web\UploadedFile
     */
    public $customer_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cprofile';
    }
   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return [
    			[['user_id', 'first_name', 'last_name', 'phone_code', 'phone_number', 'id_number'], 'required'],
    			[['user_id', 'phone_code', 'phone_number', 'id_number'], 'integer'],
    			[['created_at'], 'safe'],
    			[['first_name', 'last_name'], 'string', 'max' => 100],
    			[['cprofile_image'], 'string', 'max' => 500],
    			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
    			['customer_image', 'image', 'minWidth' => 300],
    			
    	];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cprofile_id' => 'Cprofile ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone_code' => 'Phone Code',
            'phone_number' => 'Phone Number',
            'id_number' => 'ID Number',
            'created_at' => 'Created At',
            'cprofile_image' => 'Profile Photo',
        	'customer_image' => 'Profile Photo',
        ];
    }

    /**
     * Gets query for [[PhoneCode]].
     *
     * @return \yii\db\ActiveQuery
     */

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function save($runValidation = true, $attributeNames = null)
    {
    	if ($this->customer_image) {
    		$this->cprofile_image = Url::to('@web/frontend/web/storage/cprofile/' . $this->user_id. '.jpg',);
    		
    	}
    	$saved = parent::save($runValidation, $attributeNames);
    	if (!$saved) {
    		return false;
    	}
    	if ($this->customer_image) {
    		$customer_image_path = Yii::getAlias('@frontend/web/storage/cprofile/' . $this->user_id . '.jpg');
    		if (!is_dir(dirname($customer_image_path))) {
    			FileHelper::createDirectory(dirname($customer_image_path));
    		}
    		$this->customer_image->saveAs($customer_image_path);
    		Image::getImagine()
    		->open($customer_image_path)
    		->thumbnail(new Box(300, 250))
    		->save();
    	}
    	
    	
    	return true;
    }
}
