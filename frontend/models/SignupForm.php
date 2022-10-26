<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
	public $username;
	public $password;
	public $confirmpassword;

	public function rules()
	{
		return [
			['username', 'trim'],
			['username', 'required'],
			['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже занято.'],
			['username', 'string', 'min' => 2, 'max' => 255],

			['password', 'required'],
			['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

			['confirmpassword', 'required'],
			['confirmpassword', 'compare', 'compareAttribute'=>'password', 'message' => 'Пароли не совпадают!!!' ],
		];
	}

	public function attributeLabels()
	{
		return [
			'username' => Yii::t('app', 'ИНН'),
			'password' => Yii::t('app', 'Создайте пароль'),
			'confirmpassword' => Yii::t('app', 'Подтвердите пароль'),
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return bool whether the creating new account was successful and email was sent
	 */
	public function signup()
	{
		if (!$this->validate()) {
			return null;
		}
		
		$user = new User();
		$user->username = $this->username;
		$user->password = $this->password;
		$user->setPassword($this->password);
		$user->generateAuthKey();
		// $user->generateEmailVerificationToken();
		return $user->save();

	}

	/**
	 * Sends confirmation email to user
	 * @param User $user user model to with email should be send
	 * @return bool whether the email was sent
	 */
	protected function sendEmail($user)
	{
		return Yii::$app
			->mailer
			->compose(
				['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
				['user' => $user]
			)
			->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
			->setTo($this->email)
			->setSubject('Account registration at ' . Yii::$app->name)
			->send();
	}
}
