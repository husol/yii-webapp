<?php

class AboutController extends HUS_Controller
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
		// Get about
		$abouts = new About();
		$about = $abouts->getAbout();

		$this->render('index', array('user' => $user,
									'activeTopic' => $activeTopic,
									'quickAction' => $quickAction,
									'chat' => $chat,
									'link' => $link,
									'activeQues' => $activeQues,
									'counter' => $counter['count'],
									'answer' => $answer,
									'about' => $about['content']
						));
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