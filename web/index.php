<?php
/**
 *
 * @author MaximAL
 * @since 2018-03-15
 * @date 2018-03-15
 * @time 12:49
 * @copyright © MaximAL, Sijeko 2018
 */

require __DIR__ . '/../vendor/autoload.php';

$config = include __DIR__ . '/../config/config.php';

(new \app\system\App($config))->run();
