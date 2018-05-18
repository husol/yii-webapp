<?php

class ContactController extends HUS_Controller
{
	public function actionIndex()
	{
		$user = HUS::loadSession('loggedUser');
		// Get topic
		$topic = new Topics();
		$activeTopic = $topic->getActiveTopic();
		// Get quick actions
		$actions = new Actions();
		$quickAction = $actions->getQuickActions();
		// Get chats
		$chats = new Chats();
		$chat = $chats->getChats();
		// Get links
		$links = new Links();
		$link = $links->getLinks();
		// Get ques_ans
		$ques = new Questions();
		$activeQues = $ques->getActiveQuestion();
		$ans = new Answers();
		$answer = $ans->getAnswers();
		// Get counter
		$counters = new Counter();
		$counter = $counters->getCounter();

		$this->render('index', array('user' => $user,
									'activeTopic' => $activeTopic,
									'quickAction' => $quickAction,
									'chat' => $chat,
									'link' => $link,
									'activeQues' => $activeQues,
									'counter' => $counter['count'],
									'answer' => $answer
					));
	}

	public function actionSend(){
		$name = $_POST['full_name'];
		$email = $_POST['email_address'];
		$work_place = $_POST['work_place'];
		$phone = $_POST['telephone_number'];
		$message = $_POST['message'];

		$mail_to = HUS::getParam('adminEmail');
		$mail_sub = 'Liên hệ từ website Huyện Đoàn Trảng Bàng';
		$mail_mesg='
            <html>
            <head>
            <title>Tin nhắn từ trang Liên hệ</title>
            </head>
            <body>
                <p>
                    -------------------<br />
                    Họ và tên: '. $name . '<br />
                    Email: '. $email . '<br />
					Công tác tại: '. $work_place. '<br />
					Số điện thoại: '. $phone . '<br />
                    -------------------<br />
                </p>
                <p>
                    ' . $message . '<br />
                </p>
            </body>
            </html>
          ';
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: noreply@huyendoantrangbang.org.vn' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
		mail($mail_to,$mail_sub,$mail_mesg, $headers);

		$this->redirect('index.php?r=contact/alert');
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