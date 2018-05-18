<?php

class ActionsController extends HUS_Controller
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
		$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : NULL;

		$this->render('index', array('user' => $user,
									'activeTopic' => $activeTopic,
									'quickAction' => $quickAction,
									'chat' => $chat,
									'link' => $link,
									'activeQues' => $activeQues,
									'counter' => $counter['count'],
									'answer' => $answer,
									'data' => $keyword
					));
	}

    public function actionList()
    {
		// START AJAX PAGINATION
		if(isset($_POST["page"])) {
			// Init PagingAjax
			$paging = new PagingAjax();

			// Set class css for pagination
			$paging->class_pagination = "pagination";
			$paging->class_active = "active";
			$paging->class_inactive = "inactive";
			$paging->class_go_button = "go_button";
			$paging->class_text_total = "total";
			$paging->class_txt_goto = "txt_go_button";

			// Set paging per page, default is 10
			$paging->per_page = HUS::getParam('pagingPerPage'); 	

			// Get page value
			$paging->page = $_POST["page"];

			// Get key word
			$strKeyword = ""; $arrParam = array();
			if (!empty($_POST["data"])) {
				$keyword = $_POST["data"];
				$strKeyword = "AND title LIKE :keyword OR summary LIKE :keyword";
				$arrParam = array(':keyword' => "%{$keyword}%");
			}

			// Input query & Get result returned
			$paging->text_sql =	"SELECT id, title, urlImage, summary
									FROM actions
									WHERE reviewed = 1 ".$strKeyword."
									ORDER BY last_modified_time DESC";
			$result_page_data = $paging->getResult($arrParam);

			// Get data
			$data = "";

			foreach ($result_page_data as $row){
				$data .= "<li>
							<div class='spacer'></div>
							<a href='index.php?r=actions/detail&id=".$row['id']."'><strong>". $row['title'] ."</strong></a>
						</li>
						<li>
							<img align='left' style='width:100px;height:100px;margin-right:5px;' src='". $row['urlImage'] ."' />
							<span>". $row['summary'] ."</span>
						</li>
						<li>
							<span style='float:right;margin-right:20px;'><a href='index.php?r=actions/detail&id=". $row['id'] ."'>Chi tiết >></a></span>
							<div class='spacer'></div>
						</li>";
			}

			// Load data and return to view
			$paging->data = "<div class='data'><ul>". $data ."</ul></div>"; // Content for Data    
			echo $paging->load();  // Result returned
		}
		// END AJAX PAGINATION
    }

	public function actionDetail()
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
		// Get action for detail
		$action = $actions->findByPk($_GET['id']);
		$action->viewedNumber += 1;
		$action->save();

		$actions = new Actions();
		$action = $actions->getActions($_GET['id']);

		$this->render('detail', array('user' => $user,
									'activeTopic' => $activeTopic,
									'quickAction' => $quickAction,
									'chat' => $chat,
									'link' => $link,
									'activeQues' => $activeQues,
									'counter' => $counter['count'],
									'answer' => $answer,
									'action' => $action
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
