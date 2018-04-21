<?php
namespace System\Facades\Facade;
use System\Models\Menu;

class Client
{

	private $menus = [];
	private $dashboard = [];

	public function _initialize()
	{

	}

	/**
	 * Add menu items into the admin menu
	 * @param [type] $menu      array of container menu item information
	 * @param string $namespace default location
	 */
	// public function add_menu($key,$menu,$namespace='default')
	// {
	// 	if(!array_key_exists($namespace, $this->menus))
	// 		$this->menus[$namespace] = [];
	// 	$parent_id = 0;
	// 	$this->menus[$namespace][$key] = $menu;
	// }

	public function add_menu($menu,$namespace='sidebar',$hasParent=false)
	{
		if(!array_key_exists($namespace, $this->menus))
			$this->menus[$namespace] = [];
		$parent_id = 0;
		$this->menus[$namespace][] = $menu;
	}

	function remove_menu($key,$namespace='sidebar')
	{
		if(!array_key_exists($namespace,$this->menus))
			return false;

		if(array_key_exists($key, $this->menus[$namespace])){
			unset($this->menus[$namespace][$key]);
			return true;
		}
		return false;
	}

	function get_menus($namespace=null)
	{
		if(!is_null($namespace) and !is_array($namespace) and is_array($this->menus)){
			if( array_key_exists($namespace,$this->menus) )
				return $this->menus[$namespace];
			return [];
		}
		return $this->menus;
	}

	function has_menus($namespace)
	{
		if(array_key_exists($namespace, $this->menus) and count($this->menus[$namespace]))
			return true;
		return false;
	}

	function getHydratedMenu($namespace='default',$ul_menu = false,$dropdown='navi')
	{
		$html = "";
		if(count($menus = $this->get_menus($namespace))):
			$html.= '<div class="list-group">';
			foreach($menus as $menu):
				$html .="<a href=\"{$menu['slug']}\" class=\"list-group-item".(request()->path() === $menu['slug'] ? ' active' : '')."\">{$menu['title']}</a>";
			endforeach;
			$html.='</div>';
  		endif;
		return $html;
	}

	public function add_dashboard(array $configuration)
	{
		$this->dashboard[] = $configuration;
	}

	public function get_dashboard()
	{
		return collect($this->dashboard)->sortBy('ordering')->toArray();;
	}
}