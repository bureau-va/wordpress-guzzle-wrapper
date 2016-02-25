<?php
/**
 * Created by Maciej Paprocki for Bureau-VA.
 * Date: 25/02/2016
 * Project Name: MaciekPaprocki\WordpressGuzzle
 * Time: 12:37.
 */
namespace BureauVa\WordpressGuzzle\Tests;

use BureauVa\WordpressGuzzle\Helper\StringHelper as S;

/**
 * Class StringHelperTest.
 */
class StringHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testNoFirstCamelCase()
    {
        $this->assertEquals('alaMaKota', S::noFirstCamelCase('Ala ma kota'));
        $this->assertEquals('alaMaKota', S::noFirstCamelCase('Ala \ma\kota'));
        $this->assertEquals('alaMaKota', S::noFirstCamelCase('/Ala \ma\kota'));
        $this->assertEquals('alamakota', S::noFirstCamelCase('alaMaKota'));
        $this->assertEquals('alamakota', S::noFirstCamelCase('AlaMaKota'));
    }

    /**
     *
     */
    public function testCamelCase()
    {
        $this->assertEquals('AlaMaKota', S::CamelCase('Ala ma kota'), '1 error');
        $this->assertEquals('AlaMaKota', S::CamelCase('Ala \ma\kota'), '2 error');
        $this->assertEquals('AlaMaKota', S::CamelCase('/Ala \ma\kota'), '3 error');
        $this->assertEquals('Alamakota', S::CamelCase('alaMaKota'), '4 error');
        $this->assertEquals('Alamakota', S::CamelCase('AlaMaKota'), '5 error');
    }
}
