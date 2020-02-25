<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        if(!checkAdminRole(['administrator','volunteer'])){
           return redirect('/admin/hotel');
        }
         $content
            ->title('实时数据')
            ->description('日月同城 - 医护酒店公寓平台')
            ->row(Dashboard::title())
            ->row(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $headers = ['title'=>'统计类型','today'=>'当日', 'yesterday'=>'昨日', 'total'=>'累计'];
                    $staticTitles = [
                        'register_hotel_users'=>'注册酒店',
                        'register_doctors'=>'注册医护',
                        'put_hotels'=>'发布酒店数',
                        'put_hotels_rooms'=>'发布房间数',
                        'request_count'=>'入住需求数',
                        'request_taking_count'=>'接单需求数',
                        'request_taking_rooms'=>'接单房间数',
                        'request_taking_users'=>'接单接待人数'
                    ];
                    $list = [];
                    if(!$list = Cache::get('statistic')){
                        foreach (array_keys($staticTitles) as $title ) {
                             $list[$title]  =  getStaticData($title);
                        }
                        Cache::put('statistic', $list, 10);
                    }
                    
                    $column->append(view('admin::dashboard.statistic', compact('list','headers','staticTitles')));
                });

                // $row->column(6, function (Column $column) {
                //     $column->append(Dashboard::extensions());
                // });

                // $row->column(6, function (Column $column) {
                //     $column->append(Dashboard::dependencies());
                // });
            });
            // $content->row(Dashboard::title());

            // // table 1
            // $headers = ['统计类型','当日', '累计','1'];
            // $staticTitle = [
            //     '注册酒店',
            //     '注册医护',
            //     '发布酒店数',
            //     '发布房间数',
            //     '入住需求数',
            //     '接单需求数',
            //     '接单房间数',
            //     '接单接待人数',
            // ];

            // $rows = [
            //     [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica'],
            //     [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar'],
            //     [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC'],
            //     [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            //     [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Ms. Antonietta Kozey Jr.'],
            // ];

            // $table = new Table($headers, $rows);
            // $content->body($table->render());

        return $content;
    }
}
