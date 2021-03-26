<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "pprofile".
 *
 * @property int $pprofile_id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property int $phone_code
 * @property int $phone_number
 * @property int $id_number
 * @property string $profile_image
 * @property string $introduction
 * @property string $about
 * @property string $specialty
 * @property string $payment
 * @property string $location
 * @property string $address
 * @property string $tags
 *
 * @property Document[] $documents
 * @property User $user
 */
class Pprofile extends \yii\db\ActiveRecord
{
	/**
	 *
	 * @var \yii\web\UploadedFile
	 */
	public $professional_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pprofile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
    	return [
    			[['user_id', 'first_name', 'last_name', 'phone_code', 'phone_number', 'id_number', 'profile_image', 'introduction', 'about', 'specialty', 'payment', 'location', 'address', 'tags'], 'required'],
    			[['user_id', 'phone_code', 'phone_number', 'id_number'], 'integer'],
    			[['introduction', 'about'], 'string'],
    			[['first_name', 'last_name'], 'string', 'max' => 100],
    			[['profile_image'], 'string', 'max' => 250],
    			[['specialty', 'payment', 'location', 'address', 'tags'], 'string', 'max' => 512],
    			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
    	];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pprofile_id' => 'Pprofile ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone_code' => 'Phone Code',
            'phone_number' => 'Phone Number',
            'id_number' => 'ID Number/PassportNumber',
            'profile_image' => 'Profile Image',
            'introduction' => 'Introduction',
            'about' => 'About',
            'specialty' => 'Specialty',
            'payment' => 'Payment methods you prefer',
            'location' => 'Counties you serve',
            'address' => 'Address',
            'tags' => 'Tags',
        ];
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['pprofile_id' => 'pprofile_id']);
    }

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
    	if ($this->professional_image) {
    		$this->profile_image = Url::to('@web/frontend/web/storage/pprofile/' . $this->user_id. '.jpg',);
    		
    	}
    	$saved = parent::save($runValidation, $attributeNames);
    	if (!$saved) {
    		return false;
    	}
    	if ($this->professional_image) {
    		$professional_image_path = Yii::getAlias('@frontend/web/storage/pprofile/' . $this->user_id . '.jpg');
    		if (!is_dir(dirname($professional_image_path))) {
    			FileHelper::createDirectory(dirname($professional_image_path));
    		}
    		$this->professional_image->saveAs($professional_image_path);
    		Image::getImagine()
    		->open($professional_image_path)
    		->thumbnail(new Box(300, 250))
    		->save();
    	}
    	
    	
    	return true;
    }
    public function getImageUrl()
    {
    	return Url::to('@web/frontend/web/storage/cprofile/' . $this->user_id. '.jpg', true);
    }
    /**
     * {@inheritdoc}
     * @return PprofileQuery the active query used by this AR class.
     */
    public static function find()
    {
    	return new PprofileQuery(get_called_class());
    }
}
