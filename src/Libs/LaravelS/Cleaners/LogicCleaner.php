<?php
/**
 * ContextClear.php
 * ==============================================
 * Copy right 2015-2023  by https://www.tianmtech.com/
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @desc:清除logic
 * @author: zhanglinxiao<zhanglinxiao@tianmtech.cn>
 * @date: 2023/02/02
 * @version: v1.0.0
 * @since: 2023/02/02 16:32
 */


namespace Tianmiao\Cloud\Libs\LaravelS\Cleaners;


use Hhxsv5\LaravelS\Illuminate\Cleaners\BaseCleaner;
use Illuminate\Support\Facades\Facade;

class LogicCleaner extends BaseCleaner
{
    public function clean()
    {
        $bindings = $this->currentApp->getBindings();
        $abstracts = array_keys($bindings);
        foreach ($abstracts as $abstract) {
            if (is_string($abstract) && substr($abstract, 0, 6) !== "logic_") {
                $this->currentApp->forgetInstance($abstract);
                Facade::clearResolvedInstance($abstract);
            }
        }
    }
}