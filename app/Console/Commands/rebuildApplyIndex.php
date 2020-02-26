<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2020/2/26
 * Project: CharityHotel
 * Github: https://github.com/pariswang/CharityHotel
 */

namespace App\Console\Commands;

use App\Model\Subscribe;
use Illuminate\Console\Command;

class rebuildApplyIndex extends Command
{
    protected $signature = 'apply:index';

    protected $description = '重塑申请单搜索用的索引';

    public function handle()
    {
        Subscribe::chunk(100, function ($applies){
            $applies->each(function ($apply){
                $apply->hospital_ids = $apply->hospitalSearchString();
                $apply->save();
            });
        });
    }
}