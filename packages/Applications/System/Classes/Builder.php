<?php
namespace System\Classes;

/**
 * Form Class
 *
 * Responsible for building forms
 *
 * @param array $elements renderable array containing form elements
 *
 * @return void
 */
 class Builder {
   
   public $elements;
   
   public $form_number = 1;
   public $errors;
   public $classes = [
   			'label' => 'fc-lbl',
   			'input' => 'fc-in form-control',
   			'textarea' => 'fc-ta form-control',
   			'select'  => 'fc-select form-control',
   			'radio'   => 'fc-radio',
   			'checkbox' => 'fc-checkbox',
   			'input_button' => 'fc-btn',
   			'button' => 'fc-btn btn ',
   		];

   public function __construct($elements){

    $this->errors = \Session::get('errors', new \Illuminate\Support\MessageBag);
    // dd(request()->old());
    $this->elements = $elements;
   }

   /**
    * Form class method to dump object elements
    * 
    * The method just dumps the elements of the form passed to the instantiation.
    * 
    * @return void
    * 
    */

   public function dumpElements() {
     var_dump($this->elements);
   }
   
   /**
    * Form class method to build a form from an array
    * 
    * 
    * @return string $output contains the form as HTML
    * 
    */
  function build($request = null) {
    
    $output = "";
    // For multiple forms, create a counter.
    $this->form_number++;
    $input = "";
    foreach($this->elements as $name => $element):

	   	if(!is_array($element))
    		continue;
      // dd($this->errors);
    	$value = array_key_exists('value',$element) ? $element['value'] : (old($name) ? old($name) : '' );
      $from_row_start = '<div class="form-group fc-grp'.($this->errors->has($name) ? ' has-error' : '' ).'">';

      $form_row_end = '</div>';
    	
      $label = '<label class="fc-lbl">' . $element['title'] . '</label>';
    	/**
    	 * Value generated with the help of callback value 
    	 * to render inside form
    	 * @var array
    	 */
    	$generated = [];

    	/**
    	 * Html view for internal processing
    	 * useful in case of select, radio and checkbox
    	 * @var string
    	 */
    	$internal = "";

    	/**
    	 * Generate callback values if any
    	 * @var $element['callback']
    	 */
    	if(
	      	array_key_exists('callback',$element) 
	      		and 
	      	is_callable($element['callback'])
	      ):
    		$generated =  call_user_func_array($element['callback'], $element);
	    endif;
	    

	    /**
	     * Useful for getting rendering internal view html for 
	     * form elements like select and select multiple
	     * @var $element['type']
	     */
	    if(array_key_exists('type',$element) 
	    	and is_callable(array(&$this,$element['type']))):
	    	$method = $element['type'];
	    	$internal = $this->$method($generated,$name,$element,$request,old($name));
	    endif;
	    $extra = '';
      if(array_key_exists('required',$element) and $element['required']===true):
              $extra .= ' required="true"';
            endif;
	    switch ($element['type']):
	     	
	     	case 'email':
	     	case 'password':
	     	case 'text':
	     	case 'number':
	     	case 'date':
        case 'datetime':
        $type = $element['type'];
	     	    $input = "<input class=\"{$this->classes['input']} {$type}\" name=\"{$name}\" type=\"{$type}\" value=\"".htmlentities($value)."\" {$extra}/>";
	     	break;

	     	case 'textarea':
	     		$input = "<textarea class=\"{$this->classes['input']}\" name=\"{$name}\">{$value}</textarea>";
	     	break;

	     	case 'select':
          $temp = $name;
	        	if(array_key_exists('multiple',$element) and $element['multiple']===true):
	        	  $temp = $temp.'[]';
	        		$extra .= ' multiple="true"';
	        	
	        	endif;

	        	$input="<select class=\"{$this->classes['select']}\" name=\"{$temp}\"{$extra}>{$internal}</select>";

	     	break;

	     	case 'checkbox':

	          if(count($generated)):
	            $input='<div class="form-group fc-checkbox"><div class="checkbox">
	              ';
	              foreach($generated as $key => $call ):
	                $input .= "<label><input type=\"checkbox\" name=\"{$name}[]\" id=\"input\" value=\"{$key}\"";
	                if(array_key_exists('value',$element) and is_array($element['value']) and in_array($key,$element['value'])){
	                  $input .= ' checked';
	                }
	                $input .="> {$call}</label>";
	              endforeach;
	                $input .= '</div></div>';
	            endif;
	        break;
	        
	        case 'radio':
	        if(count($generated)):
	          $input.='<div class="form-group fc-radio"><div class="radio">
	              ';
	            foreach($generated as $key => $call ):
	              $input .= "<label><input type=\"radio\" name=\"{$name}\" id=\"input\" value=\"{$key}\"> {$call}</label>";
	            endforeach;
	              $input .= '</div></div>';
	          endif;
	        break;
	     endswitch;

       // @if ($errors->has('email') or $errors->has('username'))
       //              <span class="help-block">
       //                  <strong>{{ $errors->first('email') }}{{$errors->first('username')}}</strong>
       //              </span>
       //          @endif
       $error = "";
       if($this->errors->has($name)):
          $error = "<span class=\"help-block\">
                        <strong>{$this->errors->first($name)}</strong>
                    </span>";
       endif;
	     if(strlen($input))
        	$output .= $from_row_start.$label . '<p>' . $input. $error . '</p>'.$form_row_end ;
    endforeach;

    return $output;
    
    
    return $output;
  }

  function text($array,$name,$element=null,$request=null)
  {
  	if(is_array($request) and array_key_exists($name,$request))
  		return $request[$name];
  	return "";
  }

  function select($array,$name,$element=null,$request=null,$old=null)
  {
  	$select = '';
  	if(is_array($request) and array_key_exists($name,$request))
  		$select = $request[$name];

  	if(is_array($element) and array_key_exists('value',$element))
  		$select = $element['value'];

    if(is_array($old) or !is_null($old))
      $select = $old;

  	$html = '';

  	foreach($array as $key => $value):
  		$attribute = '';
      if($key == $select){
          $attribute = ' selected';
      }	else if($key === $select)
    			$attribute = ' selected';

    		else if(array_key_exists('multiple',$element) 
    			and $element['multiple'] 
    			and is_array($select) 
    			and in_array($key,$select)
    		)
    			$attribute = ' selected';
  		$html .= "<option value=\"{$key}\"{$attribute}>{$value}</option>";

  	endforeach;
  	
  	return $html;
  }

  public static function extractors($data,$requested){
    $columns = [];
      $relations = [];
      foreach($data as $key => $configuration)
      {
        if(!array_key_exists('scope', $configuration))
          continue;

        $scope = 'extract'.ucfirst($configuration['scope']);
        // if(array_key_exists($key, $requested) and method_exists(__CLASS__, $scope))
        
      if(array_key_exists($key, $requested))
        {
          $scope = $configuration['scope'];
          switch($scope){
            case 'column':
              if($key!=='configuration')
                $columns[$key] = $requested[$key];
            break;

            case 'configuration':
              $columns['configuration'][$key] = $requested[$key];
            break;

            case 'relation':
              $builder = 'default';
              if(array_key_exists('builder', $configuration) 
                and $configuration['builder'] !== 'default' and !empty($configuration['builder']))
                $builder = $configuration['builder'];
                $relations[$builder][$key] = $requested[$key];
            break;
          }
        }
      }
      return (['columns'=>$columns,'relations'=>$relations]);
  }

 }