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
        return [
            [
                "./_assets/inc/global.header.php",
                "/_assets/inc/global.header.php",
            ],
            [
                "./_assets/inc/global.scripts.php",
                "/_assets/inc/global.scripts.php",
            ],
            [
                "./_assets/inc/mainnav.inc.php",
                "/_assets/inc/mainnav.inc.php",
            ],
            [
                "./_assets/inc/mobile-state-retailer-lists.php",
                "/_assets/inc/mobile-state-retailer-lists.php",
            ],
            [
                "./vehicle-finder/check.php",
                "/vehicle-finder/check.php",
            ],
            [
                "./vehicle-finder/costco/cart/index.php",
                "/vehicle-finder/costco/cart/index.php",
            ],
            [
                "./vehicle-finder/costco/index.php",
                "/vehicle-finder/costco/index.php",
            ],
            [
                "./vehicle-finder/costco/membership-info/index.php",
                "/vehicle-finder/costco/membership-info/index.php",
            ],
            [
                "./vehicle-finder/costco/results/index.php",
                "/vehicle-finder/costco/results/index.php",
            ],
            [
                "./vehicle-finder/costco/save-results/index.php",
                "/vehicle-finder/costco/save-results/index.php",
            ],
            [
                "./vehicle-finder/costco/template.php",
                "/vehicle-finder/costco/template.php",
            ],
            [
                "./vehicle-finder/costco/vehicle-finder/getdata.php",
                "/vehicle-finder/costco/vehicle-finder/getdata.php",
            ],
            [
                "./vehicle-finder/costco/vehicle-finder/index.php",
                "/vehicle-finder/costco/vehicle-finder/index.php",
            ],
            [
                "./vehicle-finder/dbconfig.php",
                "/vehicle-finder/dbconfig.php",
            ],
            [
                "./vehicle-finder/dbtest.php",
                "/vehicle-finder/dbtest.php",
            ],
            [
                "./vehicle-finder/getdata.php",
                "/vehicle-finder/getdata.php",
            ],
            [
                "./vehicle-finder/index.php",
                "/vehicle-finder/index.php",
            ],
            [
                "./vehicle-finder/index2.php",
                "/vehicle-finder/index2.php",
            ],
            [
                "./vehicle-finder/OLD_index.php",
                "/vehicle-finder/OLD_index.php",
            ],
            [
                "./vehicle-finder/results.php",
                "/vehicle-finder/results.php",
            ],
            [
                "./vehicle-finder/Retriever.php",
                "/vehicle-finder/Retriever.php",
            ],
            [
                "./vendor/db/DbConnect.php",
                "/vendor/db/DbConnect.php",
            ],
            [
                "./vendor/db/helpers.php",
                "/vendor/db/helpers.php",
            ],
            [
                "./vendor/db/import.php",
                "/vendor/db/import.php",
            ],
            [
                "vendor/db/import_ref.php",
                "/vendor/db/import_ref.php",
            ],
            [
                "vendor/db/positions.php",
                "/vendor/db/positions.php",
            ],
            [
                "vendor/db/RowObject.php",
                "/vendor/db/RowObject.php",
            ],
        ];
    }

    public function securityDataProvider()
    {
        return [
            ["../../malicious_script.php", "/malicious_script.php"],
            ["/subfolder/../../../malicious_script.php", "/subfolder/malicious_script.php"],
        ];
    }

    public function indexFileDataProvider()
    {
        return [
            ["/subdir/", "/subdir/index.php"],
            ["/subdir", "/subdir/index.php"],
            ["/", "/index.php"],
        ];
    }

    private function compareResultWithExpected($url, $expected)
    {
        $env = ["SCRIPT_NAME" => $url];

        $this->assertSame($expected, Router::scriptForEnv($env));
    }
}
