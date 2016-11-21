<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tristan LASALLE <tla@e-servicial.fr>
 * Date: 12/10/16
 * Time: 19:17
 */

use Kahlan\Extra\Matcher\ExtraMatchers;

ExtraMatchers::register(["toBeOneOf"]);

describe("ProductMock", function(){
    beforeAll(function(){
        $sdkParams = [
            'format' => 'json',
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];

        $this->client = new RestClient($sdkParams);
    });

    describe("::findAll()", function(){
        it("should get all products with the default parameters", function(){
            $products_json = "";//$this->productMock->findAll();

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all");

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $products = json_decode($products_json, true);

            expect($products)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($products["products"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            $product = $products["products"][0];

            expect($product)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["product_id"])
                ->toBeAn("int");

            expect($product["code_article"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["published"])
                ->toBeA("boolean");

            expect($product["best_seller"])
                ->toBeA("boolean");

            expect($product["new"])
                ->toBeA("boolean");

            expect($product["elearning"])
                ->toBeA("boolean");

            expect($product["certified"])
                ->toBeA("boolean");

            expect($product["blended"])
                ->toBeA("boolean");

            expect($product["name"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["short_title"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["brand"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["subtitle"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["alias"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["picture"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["picture"]["link"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["seo"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["seo"]["title"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["seo"]["description"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["seo"]["keywords"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["profile"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["objective"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["more"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["program"]["title"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"]["day"])
                ->toBeAn("int");

            expect($product["program"]["start"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"]["end"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"]["type"])
                ->toBeAn("int");

            expect($product["program"]["intro"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["program"]["intro"]["pre_title"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"]["intro"]["pre_title_desc"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"]["intro"]["gt_title"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"]["intro"]["gt_title_desc"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["program"]["descriptions"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["sectors"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["sectors"][0])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["sectors"][0]["link"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["jobs"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["jobs"][0])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["jobs"][0]["link"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["products_linked"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["products_linked"][0])
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["products_linked"][0]["link"])
                ->toBeA("string")
                ->not->toBeEmpty();

            expect($product["customer_satisfaction_score"])
                ->toBeA("double");

            expect($products["totalElements"])
                ->toBeAn("int");

            expect($products["totalPages"])
                ->toBeAn("int");

            expect($products["currentPage"])
                ->toBeAn("int");
        });

        it("should get all products from LAMY", function(){
            $products_json = "";//$this->productMock->findAll(1);

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all", ["brand_id" => 1]);

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $products = json_decode($products_json, true);

            expect($products)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($products["products"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            foreach ($products["products"] as $product){
                expect($product["brand"])
                    ->toBeAn("array")
                    ->not->toBeEmpty();

                expect($product["brand"][0]["id"])
                    ->toBe(1);
            }
        });

        it("should get all products with the alias 'my conf'", function(){
            $products_json = "";//$this->productMock->findAll(0, "my conf");

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all", ["alias" => "my conf"]);

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $products = json_decode($products_json, true);

            expect($products)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($products["products"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            foreach ($products["products"] as $product){
                expect($product["alias"])
                    ->toBeA("string")
                    ->toBe("my conf");
            }
        });

        it("should get all products corresponding to the search 'Dev conf'", function(){
            $products_json = "";//$this->productMock->findAll(0, "", "", "Dev conf");

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all", ["search" => "Dev conf"]);

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $products = json_decode($products_json, true);

            expect($products)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($products["products"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            foreach ($products["products"] as $product){
                expect($product["name"])
                    ->toBeA("string")
                    ->toBe("Dev conf");
            }
        });

        it("should get all published products", function(){
            $products_json = "";//$this->productMock->findAll(0, "", "", "", "", true);

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all", ["published" => true]);

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $products = json_decode($products_json, true);

            expect($products)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($products["products"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            foreach ($products["products"] as $product){
                expect($product["published"])
                    ->toBeA("boolean")
                    ->toBeTruthy();
            }
        });

        it("should get all new products", function(){
            $products_json = "";//$this->productMock->findAll(0, "", "", "", "", null, true);

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all", ["new" => true]);

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $products = json_decode($products_json, true);

            expect($products)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($products["products"])
                ->toBeAn("array")
                ->not->toBeEmpty();

            foreach ($products["products"] as $product){
                expect($product["new"])
                    ->toBeA("boolean")
                    ->toBeTruthy();
            }
        });

        it("should filter not selected fields", function(){
            $fields = [
                "name",
                "brand",
                "product_id"
            ];

            $products_json = "";//$this->productMock->findAll(0, "", "", "", "", null, null, $fields);

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all", ["fields[]" => $fields]);

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $products = json_decode($products_json, true);

            expect($products)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($products["products"][0])
                ->toBeAn("array")
                ->toHaveLength(3);
        });

        it("should navigate through the pagination", function(){
            $products_json = "";//$this->productMock->findAll(0, "", "", "", "", null, null, [], 25, 10);

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/all", ["page" => 25, "size" => 10]);

            if($result->info->http_code == 200)
                $products_json = $result->response;

            expect($products_json)->toBeA("string");

            $products = json_decode($products_json, true);

            expect($products["products"])->toBeAn("array")->toBeEmpty();

            $products_json = $this->productMock->findAll(0, "", "", "", "", null, null, [], 2, 5);
            $products = json_decode($products_json, true);

            expect($products["products"])->toBeAn("array")->toHaveLength(5);
        });
    });

    xdescribe("::findOne()", function(){
        it("should get the product with the ID 47", function(){
            $product_json = "";//$this->productMock->findOne(47);

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/one/47");

            if($result->info->http_code == 200)
                $product_json = $result->response;

            expect($product_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $product = json_decode($product_json, true);

            expect($product)
                ->toBeAn("array")
                ->not->toBeEmpty();

            expect($product["product_id"])
                ->toBeAn("int")
                ->toBe(4786);
        });

        it("should get the product with the ID 47 with only selected fields", function(){
            $fields = [
                "name",
                "brand",
                "product_id"
            ];

            $product_json = "";//$this->productMock->findOne(47, $fields);

            $config = require_once __DIR__ . "/../src/Test/Config/config_test.php";

            $result = $this->client->get($config["url"] . ":" . $config["port"] . "/products/one/47", ["fields" => $fields]);

            if($result->info->http_code == 200)
                $product_json = $result->response;

            expect($product_json)
                ->toBeA("string")
                ->not->toBeEmpty();

            $product = json_decode($product_json, true);

            expect($product)
                ->toBeAn("array")
                ->not->toBeEmpty()
                ->toHaveLength(3);

            expect($product["product_id"])
                ->toBeAn("int")
                ->toBe(4786);
        });
    });
});
