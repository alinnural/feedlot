<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->name = "Tentang Pakan";
        $menu->url = "page/tentang-pakan";
        $menu->is_parent = 1;
        $menu->have_child = 0;
        $menu->slug = "tentang-pakan";
        $menu->menu_admin = 0;
        $menu->type = 2;
        $menu->active = 1;
        $menu->position = 1;
        $menu->page_id = 1;
        $menu->save();

        $menu1 = new Menu();
        $menu1->name = "Kebutuhan Sapi";
        $menu1->url = "page/kebutuhan-sapi";
        $menu1->is_parent = 1;
        $menu1->have_child = 0;
        $menu1->slug = "kebutuhan-sapi";
        $menu1->menu_admin = 0;
        $menu1->type = 2;
        $menu1->active = 1;
        $menu1->position = 2;
        $menu1->page_id = 2;
        $menu1->save();

        $menu2 = new Menu();
        $menu2->name = "Literatur";
        $menu2->url = "page/literatur";
        $menu2->is_parent = 1;
        $menu2->have_child = 0;
        $menu2->slug = "literatur";
        $menu2->menu_admin = 0;
        $menu2->type = 2;
        $menu2->active = 1;
        $menu2->position = 3;
        $menu2->page_id = 3;
        $menu2->save();

        $menu3 = new Menu();
        $menu3->name = "Publikasi";
        $menu3->url = "page/publikasi";
        $menu3->is_parent = 1;
        $menu3->have_child = 0;
        $menu3->slug = "publikasi";
        $menu3->menu_admin = 0;
        $menu3->type = 2;
        $menu3->active = 1;
        $menu3->position = 4;
        $menu3->page_id = 4;
        $menu3->save();

        $menu4 = new Menu();
        $menu4->name = "Expert";
        $menu4->url = "page/expert";
        $menu4->is_parent = 1;
        $menu4->have_child = 0;
        $menu4->slug = "expert";
        $menu4->menu_admin = 0;
        $menu4->type = 2;
        $menu4->active = 1;
        $menu4->position = 5;
        $menu4->page_id = 5;
        $menu4->save();
    }
}