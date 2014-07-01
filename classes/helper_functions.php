<?php
  function form_control_wrapper() {
    return '<div class="control-group">';
  }

  function form_label($for, $text) {
    return '<label class="control-label" for="'.$for.'">'.$text.'</label>';
  }

  function text_area($name, $label_text, $value = '') {
    $html = form_control_wrapper();
    $html .= form_label($name, $label_text);
    $html .= '<div class="controls">';
    $html .= '<textarea id="'.$name.'" name="'.$name.'" rows="3">'.$value.'</textarea>';
    $html .= "</div>";
    $html .= "</div>";

    return $html;
  }

  function select($name, $title, $items, $selected_id = null) {
    $html = '<select name="'.$name.'">';
    $html .= '<option>-- Välj --</option>';

    foreach ($items as $item) {
      $selected = '';
      if ($selected_id && $selected_id == $item->id) {
        $selected = ' selected="selected"';
      }
      $html .= '<option'.$selected.' value="'.$item->id.'">'.$item->name.'</option>';
    }
    $html .= '</select>';
    return $html;
  }
  //Alexis I made this funtion to show various alternatives to choose
  function selectMultiple($name, $title, $items, $selected_id = null) {
    $html = '<select multiple name="'.$name.'[]">';
    $html .= '<option>-- Välj --</option>';

    foreach ($items as $item) {
      $selected = '';
      if ($selected_id && $selected_id == $item->id) {
        $selected = ' selected="selected"';
      }
      $html .= '<option'.$selected.' value="'.$item->id.'">'.$item->name.'</option>';
    }
    $html .= '</select>';
    return $html;
  }
  /*
  function selectMultiple($name, $title, $items, $selected_id = null) {
    $html = '<select multiple name="'.$name.'[]">';
    $html .= '<option>-- Välj --</option>';

    foreach ($items as $item) {
      $selected = '';
      if ($selected_id && $selected_id == $item->id) {
        $selected = ' selected="selected"';
      }
      $html .= '<option'.$selected.' value="'.$item->id.'">'.$item->name.'</option>';
    }
    $html .= '</select>';
    return $html;
  }
  */
function checkbox($name, $items=null) {
   	$html='<br>';
    if(isset($items)){
	
    foreach ($items as $item) 
       {
         $html .= '<input type="checkbox" name="'.$name.'[]" value='.$item->id.'>'.$item->name.'<br>';
      }
     
    }
	//If I want to add only one element
	else {
		$html .= '<input type="checkbox" name="'.$name.'" value="1">Lägga till bara en ny kategory:<br>';
		}
    
    return $html.'<br>';
  }

  function checkboxEdit($name, $items,$itemsAdded,$title){
	  $html = '<br>';
	  $html.='<h5>'.$title.'</h5>';
	  $checked ='';
	  //foreach to loop through all categories, and then check through categories in item and compare the category name to see if it already exists in the item, if it does, check the box, if it doesnt, dont check.
    foreach ($items as $item) {
		$checked ='';
		foreach($itemsAdded as $itemAdded){
			if($item->name == $itemAdded->name){
			 $checked = ' checked';
			 //the else if below makes sure that $checked is not 'checked' before it changes it;
			} else if($checked !=' checked') {
			$checked = '';
			}
		}
		$html .= '<input type="checkbox" name="'.$name.'[]" value="'.$item->id.'"'.$checked.'>'.$item->name.'<br>';
      }
      
    return $html.'<br>';
  }
  
	
  function submit_button($text) {
    $html  = '<div class="control-group">';
    $html .= '<div class="controls">';
    $html .= '<button type="submit" class="btn btn-primary">'.$text.'</button>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;

  }

  function form_input($type, $name, $label_text, $value = '', $placeholder_text = '') {

    $html  = '<div class="control-group">';
    $html .= form_label($name, $label_text);
    $html .= '<div class="controls">';
    $html .= '<input value="'.$value.'" placeholder="'.$value.'" type="'.$type.'" id="'.$name.'" name="'.$name.'"'.$placeholder_text.'>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
  }

  function portfolio_item($item) {
      $html = '<article class="portfolio-item">';
      $html .= '<a href="/show.php?id='.$item->id.'">';

      if ($item->thumbnail_url) {
        $html .= '<img src="/images/'.$item->thumbnail_url.'" width="100" height="100" class="img-polaroid">';
      } else {
        $html .= '<img src="http://placehold.it/100x100" width="100" height="100" class="img-polaroid">';
      }
      $html .= '</a>';
      $html .= '<h4><a href="/show.php?id='.$item->id.'">'.$item->title.'</a></h4>';
      $html .= '<p>'.nl2br($item->text).'</p>';
      $html .= '<p><a class="btn btn-mini btn-success" href="/show.php?id='.$item->id.'">Se mer &raquo;</a></p>';
      $html .= '</article>';

      return $html;
  }
  
  //Alexis
  function portfolio_categories($category) {
      $html = '<a class="portfolioCategories col span_12" href="/portfolio.php?id='.$category->id.'&name='.$category->name.'">'.$category->name.'</a>';

      return $html;
  }
  //Alexis
  function portfolio_show_items($item) {
	  //var_dump($item);
      $html = '<a class="portfolioCategories itemSpecialMargin col span_12" href="/show.php?id='.$item->id.'">'.$item->title.'</a>';
	 // $html = '<a class="portfolioCategories itemSpecialMargin col span_12" href="'.$item->url.'">'.$item->title.'</a>';
	  
	 // $html .= '<div class="row"><a class="itemThumbnail col span_12" style="background-image:url('.$item->thumbnail_url.');" href="'.$item->url.'" ><a/></div>';
	 
	 //take the three last words of the text string
	 $format = substr($item->thumbnail_url, strlen($item->thumbnail_url)-3,3);
	 
	 //take all the url string but without the three last words
	 $urlWhitoutExt = substr($item->thumbnail_url, 0,strlen($item->thumbnail_url)-3);
	 $urlImg = $item->thumbnail_url;
	 //echo $urlWhitoutExt;
	 //echo strlen($item->thumbnail_url)-3;
	 if($format == "avi" || $format == "mp4"|| $format == "mov" || $format == "wmv")
	 {
		 $urlImg = $urlWhitoutExt."jpg";
		 
	 }
	 $html .= '<div class="row"><a class="itemThumbnail col span_12" style="background-image:url('.$urlImg.');" href="/show.php?id='.$item->id.'" ><a/></div>';
	 
	  $html .= '<div class="row">'.$item->text.'</div>';

      return $html;
	  
  }

  function hero($heading, $text, $button_link = null, $button_text = null) {
    $format = '<div class="jumbotron"><h1>%s</h1><p class="lead">%s</p>';
    $html = sprintf($format, $heading, $text);

    if ($button_link) {
      $html .= '<a class="btn btn-large btn-success" href="'.$button_link.'">'.$button_text.'</a>';
    }

    $html .= '</div><hr>';
    return $html;
  }

  function set_feedback($status, $text) {
    $_SESSION['feedback'] = array('status' => $status, 'text' => $text);
  }

  function get_feedback() {
    $html = "";
    if (isset($_SESSION['feedback'])) {
      $html .= '<div class="alert alert-'.$_SESSION['feedback']['status'].'">';
      $html .= '<button type="button" class="close" data-dismiss="alert">×</button>';
      $html .= $_SESSION['feedback']['text'];
      $html .= '</div>';
      $_SESSION['feedback'] = null;
    }
    return $html;
  }

