<?php

namespace App\Models;
use DB;
class Menu 
{
	public static function getMenuBaseOnrole($user)
	{
			$resultMenu = [];
			$resultRoute = [];
            $menu = DB::table('menus')->get();
            foreach ($menu as $menuKey => $menuValue) 
            {
                $resultMenu[$menuValue->id]['name'] = $menuValue->name;
                $resultMenu[$menuValue->id]['icon'] = $menuValue->icon;
                $resultMenu[$menuValue->id]['route'] = null;
                $resultMenu[$menuValue->id]['visible'] = true;
                $resultMenu[$menuValue->id]['item'] = [];
                if($menuValue->route != null)
                {
                    $resultMenu[$menuValue->id]['route'] = $menuValue->route;
                    array_push($resultRoute, $menuValue->route);
                }else
                {
                    $menuItem = DB::table('menu_items')->where('menu_id',$menuValue->id)->where('parent_id','=',NULL)->get();
                    foreach ($menuItem as $menuItemKey => $menuItemValue) 
                    {
                        $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['name'] = $menuItemValue->name;
                        $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['route'] = null;
                        $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['visible'] = true;
                        $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['child'] = [];
                        if($menuItemValue->route != null)
                        {
                            $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['route'] = $menuItemValue->route;
                            array_push($resultRoute, $menuItemValue->route);
                        }else
                        {
                            $child = DB::table('menu_items')->where('parent_id',$menuItemValue->id)->get();
                            foreach ($child as $childKey => $childValue) 
                            {
                                $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['child'][$childValue->id]['name'] = $childValue->name;
                                $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['child'][$childValue->id]['route'] = $childValue->route;
                                $resultMenu[$menuValue->id]['item'][$menuItemValue->id]['child'][$childValue->id]['visible'] = true;
                                array_push($resultRoute, $childValue->route);
                            }
                        }
                    }
                }
            }
            //dd($resultMenu);
            $resultRoute = array_unique($resultRoute);
            //validate
            foreach ($resultMenu as $resultMenuKey => $resultMenuValue) 
            {
                if(count($resultMenuValue['item']) > 0)
                {
                    $totalFalseItem = DB::table('role_menus')
                                        ->where('role_id',$user->role_id)
                                        ->where('menu_id',$resultMenuKey)
                                        ->where('allowed',1)
                                        ->count();
                    if($totalFalseItem <= 0)
                    {
                        $resultMenu[$resultMenuKey]['visible'] = false;
                    }else
                    {
                        foreach ($resultMenuValue['item'] as $itemKey => $itemValue) 
                        {
                            if(count($itemValue['child']) > 0)
                            {
                                $totalFalseChild = DB::table('role_menus')
                                                    ->where('role_id',$user->role_id)
                                                    ->where('menu_id',$resultMenuKey)
                                                    ->where('parent_id',$itemKey)
                                                    ->where('allowed',1)
                                                    ->count();
                                if($totalFalseChild <= 0)
                                {
                                    $resultMenu[$resultMenuKey]['item'][$itemKey]['visible'] = false;
                                }else
                                {
                                    foreach ($itemValue['child'] as $childKey => $childValue) 
                                    {
                                        //check
                                        $check = DB::table('role_menus')
                                                ->where('role_id',$user->role_id)
                                                ->where('menu_id',$resultMenuKey)
                                                ->where('item_id',$childKey)
                                                ->where('parent_id',$itemKey)
                                                ->first();
                                        if($check)
                                        {
                                            if(!$check->allowed)
                                            {
                                                $resultMenu[$resultMenuKey]['item'][$itemKey]['child'][$childKey]['visible'] = false;
                                                $route = $childValue['route'];
                                                if (($keyRoute = array_search($route, $resultRoute)) !== false) {
												    unset($resultRoute[$keyRoute]);
												}
                                            }
                                        }else
                                        {
                                            $resultMenu[$resultMenuKey]['item'][$itemKey]['child'][$childKey]['visible'] = false;
                                        }
                                    }
                                }
                                
                            }else
                            {
                                //check
                                $check = DB::table('role_menus')
                                        ->where('role_id',$user->role_id)
                                        ->where('menu_id',$resultMenuKey)
                                        ->where('item_id',$itemKey)
                                        ->whereNull('parent_id')
                                        ->first();
                                if($check)
                                {
                                    if(!$check->allowed)
                                    {
                                        $resultMenu[$resultMenuKey]['item'][$itemKey]['visible'] = false;
                                        $route = $itemValue['route'];
                                        if (($keyRoute = array_search($route, $resultRoute)) !== false) {
											unset($resultRoute[$keyRoute]);
										}
                                    }
                                }else
                                {
                                    $resultMenu[$resultMenuKey]['item'][$itemKey]['visible'] = false;
                                }
                            }
                        }
                    }
                }else
                {
                    //check
                    $check = DB::table('role_menus')
                            ->where('role_id',$user->role_id)
                            ->where('menu_id',$resultMenuKey)
                            ->whereNull('item_id')
                            ->whereNull('parent_id')
                            ->first();
                    if($check)
                    {
                        if(!$check->allowed)
                        {
                            $resultMenu[$resultMenuKey]['visible'] = false;
                            $route = $resultMenuValue['route'];
                            if (($keyRoute = array_search($route, $resultRoute)) !== false) {
								unset($resultRoute[$keyRoute]);
							}
                        }
                    }else
                    {
                        $resultMenu[$resultMenuKey]['visible'] = false;
                    }
                }
            }
        $arr = [];
        $arr['menu'] = $resultMenu;
        $arr['path'] = $resultRoute;
        $resultRouteOne = [];
        foreach ($resultRoute as $key => $value) 
        {
           $p = explode('/', $value);
           if(isset($p[0]))
           {
             array_push($resultRouteOne, $p[0]);
           }
        }
        $arr['path_one'] = $resultRouteOne;
        return $arr;
	}
}