<?php

class ForgotpasswordController extends HUS_Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionMailpass(){
		$email = $_POST['email'];
		$user = Users::model()->findByAttributes(array('email'=>$email));
		if($user != NULL){
			$length = 10;
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		    $string = '';    

		    for ($p = 0; $p < $length; $p++) {
		        $string .= $characters[mt_rand(0, strlen($characters)-1)];
		    }
			$user->password = $string;
			$mail_to = $user->email;
			$mail_sub = "Reset Password Email";
			$mail_mesg ='
            <html>
            <head>
            <title>Chào mừng đến với website Huyện Đoàn Trảng Bàng</title>
            </head>
            <body>
                <p>Chúng tồi vừa tạo một mật khẩu mới cho tài khoản của bạn trong hệ thống. Vui lòng giữ thông tin sau một cách bí mật hoặc xóa email này.</p>
                <p>
                    -------------------<br />
                        Tài khoản: '. $user->username . '<br />
                        Mật khẩu mới: '. $user->password. '<br />
                    -------------------<br />
                </p>
                <p>
                    Email này được gửi tự động từ hệ thống Website Huyện Đoàn Trảng Bàng. Vui lòng không phản hồi email này và nhơ thay đổi mật khẩu của bạn.<br />
                </p>
                <p>Xin cảm ơn.</p>
            </body>
            </html>
			';

			HUS::sendMail($mail_to, $mail_sub, $mail_mesg);
			$user->password = $user->password;
			$user->save();
			$this->redirect('index.php?r=forgotpassword/alert');
		}
		$this->redirect('index.php?error=3');
	}

	public function actionAlert()
	{
		$this->render('alert');
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}