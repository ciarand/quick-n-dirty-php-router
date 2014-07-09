<?php

use PHPUnit_Framework_TestCase as TestCase;

use Ciarand\Router;

class RouterTest extends TestCase
{
    /**
     * @test
     * @dataProvider handlerDataProvider
     */
    public function it_routes_to_the_correct_handler($url, $expected)
    {
        $this->compareResultWithExpected($url, $expected);
    }

    /**
     * @test
     * @dataProvider securityDataProvider
     */
    public function it_strips_insecure_characters_from_urls($url, $expected)
    {
        $this->compareResultWithExpected($url, $expected);
    }

    /**
     * @test
     * @dataProvider indexFileDataProvider
     */
    public function it_adds_index_dot_php_to_scripts_with_no_php($url, $expected)
    {
        $this->compareResultWithExpected($url, $expected);
    }

    public function handlerDataProvider()
    {
        return array(
            array(
                "./_assets/inc/global.header.php",
                "/_assets/inc/global.header.php",
            ),
            array(
                "./_assets/inc/global.scripts.php",
                "/_assets/inc/global.scripts.php",
            ),
            array(
                "./_assets/inc/mainnav.inc.php",
                "/_assets/inc/mainnav.inc.php",
            ),
            array(
                "./_assets/inc/mobile-state-retailer-lists.php",
                "/_assets/inc/mobile-state-retailer-lists.php",
            ),
            array(
                "./vehicle-finder/check.php",
                "/vehicle-finder/check.php",
            ),
            array(
                "./vehicle-finder/costco/cart/index.php",
                "/vehicle-finder/costco/cart/index.php",
            ),
            array(
                "./vehicle-finder/costco/index.php",
                "/vehicle-finder/costco/index.php",
            ),
            array(
                "./vehicle-finder/costco/membership-info/index.php",
                "/vehicle-finder/costco/membership-info/index.php",
            ),
            array(
                "./vehicle-finder/costco/results/index.php",
                "/vehicle-finder/costco/results/index.php",
            ),
            array(
                "./vehicle-finder/costco/save-results/index.php",
                "/vehicle-finder/costco/save-results/index.php",
            ),
            array(
                "./vehicle-finder/costco/template.php",
                "/vehicle-finder/costco/template.php",
            ),
            array(
                "./vehicle-finder/costco/vehicle-finder/getdata.php",
                "/vehicle-finder/costco/vehicle-finder/getdata.php",
            ),
            array(
                "./vehicle-finder/costco/vehicle-finder/index.php",
                "/vehicle-finder/costco/vehicle-finder/index.php",
            ),
            array(
                "./vehicle-finder/dbconfig.php",
                "/vehicle-finder/dbconfig.php",
            ),
            array(
                "./vehicle-finder/dbtest.php",
                "/vehicle-finder/dbtest.php",
            ),
            array(
                "./vehicle-finder/getdata.php",
                "/vehicle-finder/getdata.php",
            ),
            array(
                "./vehicle-finder/index.php",
                "/vehicle-finder/index.php",
            ),
            array(
                "./vehicle-finder/index2.php",
                "/vehicle-finder/index2.php",
            ),
            array(
                "./vehicle-finder/OLD_index.php",
                "/vehicle-finder/OLD_index.php",
            ),
            array(
                "./vehicle-finder/results.php",
                "/vehicle-finder/results.php",
            ),
            array(
                "./vehicle-finder/Retriever.php",
                "/vehicle-finder/Retriever.php",
            ),
            array(
                "./vendor/db/DbConnect.php",
                "/vendor/db/DbConnect.php",
            ),
            array(
                "./vendor/db/helpers.php",
                "/vendor/db/helpers.php",
            ),
            array(
                "./vendor/db/import.php",
                "/vendor/db/import.php",
            ),
            array(
                "vendor/db/import_ref.php",
                "/vendor/db/import_ref.php",
            ),
            array(
                "vendor/db/positions.php",
                "/vendor/db/positions.php",
            ),
            array(
                "vendor/db/RowObject.php",
                "/vendor/db/RowObject.php",
            ),
        );
    }

    public function securityDataProvider()
    {
        return array(
            array("../../malicious_script.php", "/malicious_script.php"),
            array("/subfolder/../../../malicious_script.php", "/subfolder/malicious_script.php"),
        );
    }

    public function indexFileDataProvider()
    {
        return array(
            array("/subdir/", "/subdir/index.php"),
            array("/subdir", "/subdir/index.php"),
            array("/", "/index.php"),
        );
    }

    private function compareResultWithExpected($url, $expected)
    {
        $env = array("SCRIPT_NAME" => $url);

        $this->assertSame($expected, Router::scriptForEnv($env));
    }
}
