<?php

class SiteController extends HUS_Controller
{
	public function actionIndex()
	{
		if (isset($_GET['keyword'])){
			$data = $_GET['keyword'];
			$this->redirect('index.php?r=actions&data='.$data);
		}

		$user = HUS::loadSession('loggedUser');

		$counterSession = HUS::loadSession('counter');

		if ($counterSession != 1) {
            $counter = new Counter();
            $counter->increaseCounter();
            HUS::registerSession("counter",1);
		}
		// Get actions
		$actions = new Actions();
		$quickAction = $actions->getQuickActions();
		$newAction = $actions->getNewActions(true);
		$newestAction = $actions->getNewActions();
		// Get topic
		$topic = new Topics();
		$activeTopic = $topic->getActiveTopic();
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
									'newAction' => $newAction,
									'newestAction' => $newestAction,
									'chat' => $chat,
									'link' => $link,
									'activeQues' => $activeQues,
									'counter' => $counter['count'],
									'answer' => $answer
						));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		$user = new Users();
		$user = $user->findByAttributes(array('username'=>$username,'password'=>$password,'active'=>1));

		if($username == '' || $password == '')
		{
			$this->redirect('index.php');
		}
		else if(count($user) == 0)
		{
			$this->redirect('index.php?error=1');
		}
		else if(($user->role == '0' || $user->role == '1') && $user->active == 1)
		{
			HUS::registerSession('loggedUser', $user);
			$user->last_login = date('Y-m-d H:i:s');
			$user->save();
			$this->redirect('index.php?r=vpdt/home');
		}
		else {
			$this->redirect('index.php?error=1');
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		HUS::removeSessionAll();
		HUS::registerSession("counter",1);
		$this->redirect(HUS::getHomeUrl());
	}
}