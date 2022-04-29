<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class MenuService
{
    public function getMenuItems()
    {
        $allMenuItems = DB::table('menu_items')
            ->orderBy('parent_id', 'desc')
            ->get();

        $data     = [];
        $children = [];
        foreach ($allMenuItems as $menuItem) {
            if (empty($menuItem->parent_id)) {
                $menuItem->children = array_values($children)[0];
                $data               = $menuItem;
            } else {
                if (isset($children[$menuItem->id])) {
                    $menuItem->children = $children[$menuItem->id];
                    unset($children[$menuItem->id]);
                }

                if(!isset($menuItem->children)){
                    $menuItem->children = [];
                }
                $children[$menuItem->parent_id][] = $menuItem;
            }
        }

        return [$data];
    }

}
