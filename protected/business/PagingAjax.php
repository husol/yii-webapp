<?php

class PagingAjax
{
	public $data; // Data
	public $per_page = 10; // Number of records per page
	public $page; // Number page
	public $text_sql; // Query string

	//	Parameter SHOW or HIDE 
	public $show_pagination = true;
	public $show_goto = true;

	// CSS CLASS
	public $class_pagination; 
	public $class_active;
	public $class_inactive;
	public $class_go_button;
	public $class_text_total;
	public $class_txt_goto;    

	private $cur_page;	// Current page
	private $num_row; // Number of Record

	public function getResult($arrParam = array())
	{
		// Calculate
		$this->cur_page = $this->page;
		$this->page -= 1;
		$this->per_page = $this->per_page;
		$start = $this->page * $this->per_page;
		$this->num_row = HUS::queryExecute($this->text_sql,$arrParam);

		$result = HUS::query($this->text_sql." LIMIT {$start}, {$this->per_page}",$arrParam);
		return $result;
	}

	public function load()
	{
		// If not use pagination
		if(!$this->show_pagination)
			return $this->data;

		// Calculate number of pages
		if ($count = $this->num_row)
			$no_of_paginations = ceil($count / $this->per_page);
		else return "Không có kết quả cần tìm";

		// SHOW PREVIOUS, NEXT, FIRST & LAST BUTTON
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;    

		// Assign data to returned result string
		$msg = $this->data;

		// Calculate START & END values of loop
		if ($this->cur_page >= 7) {
			$start_loop = $this->cur_page - 3;
			if ($no_of_paginations > $this->cur_page + 3)
				$end_loop = $this->cur_page + 3;
			else if ($this->cur_page <= $no_of_paginations && $this->cur_page > $no_of_paginations - 6) {
				$start_loop = $no_of_paginations - 6;
				$end_loop = $no_of_paginations;
			} else {
				$end_loop = $no_of_paginations;
			}
		} else {
			$start_loop = 1;
			if ($no_of_paginations > 7)
				$end_loop = 7;
			else
				$end_loop = $no_of_paginations;
		}

		// Add to result string & Show FIRST button
		$msg .= "<div class='$this->class_pagination'><ul>";
		if ($first_btn && $this->cur_page > 1) {
			$msg .= "<li p='1' class='active'>|<</li>";
		} else if ($first_btn) {
			$msg .= "<li p='1' class='$this->class_inactive'>|<</li>";
		}

		// Show PREVIOUS button
		if ($previous_btn && $this->cur_page > 1) {
			$pre = $this->cur_page - 1;
			$msg .= "<li p='$pre' class='active'><<</li>";
		} else if ($previous_btn) {
			$msg .= "<li class='$this->class_inactive'><<</li>";
		}

		for ($i = $start_loop; $i <= $end_loop; $i++) {
			if ($this->cur_page == $i)
				$msg .= "<li p='$i' class='actived'>{$i}</li>";
			else
				$msg .= "<li p='$i' class='active'>{$i}</li>";
		}

		// Show NEXT button
		if ($next_btn && $this->cur_page < $no_of_paginations) {
			$nex = $this->cur_page + 1;
			$msg .= "<li p='$nex' class='active'>>></li>";
		} else if ($next_btn) {
			$msg .= "<li class='$this->class_inactive'>>></li>";
		}

		// Show LAST button
		if ($last_btn && $this->cur_page < $no_of_paginations) {
			$msg .= "<li p='$no_of_paginations' class='$this->class_active'>>|</li>";
		} else if ($last_btn) {
			$msg .= "<li p='$no_of_paginations' class='$this->class_inactive'>>|</li>";
		}

		// Show TEXTBOX to input page value
		$btnGoto = "";
		$goto = "<span id='total' class='$this->class_text_total' a='$no_of_paginations'>Page <b>$this->cur_page</b>";
		if ($this->show_goto) {
			$btnGoto = "<input type='button' id='go_btn' class='$this->class_go_button' value='Go'/>";
			$goto =  "<input type='text' id='goto' class='$this->class_txt_goto' size='3' value='$this->cur_page' /><span id='total' class='$this->class_text_total' a='$no_of_paginations'>";
		}
		$str =  $goto ."&nbsp/&nbsp<b>$no_of_paginations</b></span>". $btnGoto;

		// Return result
		return $msg . "</ul>" . $str . "</div>";  // Content for pagination
	}
}
?>