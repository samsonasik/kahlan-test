<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tristan LASALLE <tla@e-servicial.fr>
 * Date: 12/10/16
 * Time: 15:50
 */

namespace EServicial\Mocks;


use Faker\Factory;

class ProductsMock
{
    public function findAll($brand_id = 0, $alias = "", $type = "", $search = "", $search_type = "", $published = null, $new = null, $fields = [], $page = 1, $size = 10){
        $faker = Factory::create("fr_FR");

        $products = [
            'products' => []
        ];

        $brands = [
            ["id" => 1, "name" => "LAMY"],
            ["id" => 2, "name" => "LIAISON"]
        ];

        $product_fields = [
            "product_id" => "int",
            "code_article" => "small_string",
            "published" => "bool",
            "best_seller" => "bool",
            "new" => "bool",
            "elearning" => "bool",
            "certified" => "bool",
            "blended" => "bool",
            "name" => "string",
            "short_title" => "string",
            "brand" => "WK_BRAND",
            "subtitle" => "string",
            "alias" => "string",
            "picture" => "picture_object",
            "seo" => "seo_object",
            "profile" => "string_array",
            "objective" => "string_array",
            "more" => "string",
            "program" => "program_object",
            "sectors" => "link_array",
            "jobs" => "link_array",
            "products_linked" => "link_array",
            "customer_satisfaction_score" => "percentage"
        ];

        if($page > 0 && ($page * $size) <= 100) {

            if(empty($fields))
                $fields = $product_fields;
            else{
                foreach ($fields as $idx => $fieldName){
                    unset($fields[$idx]);

                    $fields[$fieldName] = $product_fields[$fieldName];
                }
            }

            for ($i = 0; $i < $size; $i++) {
                $product = [];

                foreach ($fields as $fieldName => $fieldType){
                    switch ($fieldType){
                        case "int" : $product[$fieldName] = $faker->randomNumber(); break;
                        case "percentage" : $product[$fieldName] = $faker->randomFloat(2, 0, 100); break;
                        case "bool" : $product[$fieldName] = $faker->boolean(); break;
                        case "small_string" : $product[$fieldName] = $faker->text(15); break;
                        case "string" : $product[$fieldName] = $faker->text(50); break;
                        case "WK_BRAND" :
                            if($brand_id > 0 && $brand_id < 3)
                                $product[$fieldName] = array($brands[$brand_id - 1]);
                            else
                                $product[$fieldName] = $faker->boolean ? $brands : array($faker->randomElement($brands));

                            break;

                        case "link_object" :
                            $product[$fieldName] = [
                                "link" => "/" . explode("_", $fieldName)[0] . "/one/" . $faker->numberBetween(1, 1000)
                            ];
                            break;

                        case "seo_object" :
                            $product[$fieldName] = [
                                "title" => $faker->jobTitle,
                                "description" => $faker->text(300),
                                "keywords" => $faker->words(3, true)
                            ];

                            break;

                        case "string_array" : $product[$fieldName] = $faker->words($faker->randomDigitNotNull); break;
                        case "program_object" :
                            $product[$fieldName] = [
                                "title" => $faker->jobTitle,
                                "day" => $faker->biasedNumberBetween(1, 7),
                                "start" => $faker->time('H:i'),
                                "end" => $faker->time('H:i', "+1 hour"),
                                "type" => $faker->randomDigitNotNull,
                                "intro" => [
                                    "pre_title" => $faker->text(),
                                    "pre_title_desc" => $faker->text(),
                                    "gt_title" => $faker->text(),
                                    "gt_title_desc" => $faker->text()
                                ],
                                "descriptions" => $faker->text(300)
                            ];

                            break;

                        case "link_array" :
                            $product[$fieldName] = [];
                            for($j = 0; $j < $faker->randomDigitNotNull ; $j++){
                                $product[$fieldName][] = [
                                    "link" => "/" . explode("_", $fieldName)[0] . "/one/" . $faker->numberBetween(1, 1000)
                                ];
                            }

                            break;

                        case "picture_object" : $product[$fieldName] = ["link" => $faker->imageUrl(1600, 900, "cats")]; break;

                        default :
                            $product[$fieldName] = "";
                    }
                }

                if(!empty($alias))
                    $product["alias"] = $alias;

                if(!empty($search))
                    $product["name"] = $search;

                if($published === true)
                    $product["published"] = true;
                elseif($published === false)
                    $product["published"] = false;

                if($new !== null){
                    if($new)
                        $product["new"] = true;
                    else
                        $product["new"] = false;
                }


                $products["products"][] = $product;
            }
        }

        $products["totalElements"] = 100;
        $products["totalPages"] = ceil(100 / $size);
        $products["currentPage"] = $page;

        return json_encode($products);
    }

    public function findOne($product_id, $fields = []){
        $faker = Factory::create("fr_FR");

        $brands = [
            ["id" => 1, "name" => "LAMY"],
            ["id" => 2, "name" => "LIAISON"]
        ];

        $product = [];

        $product_fields = [
            "product_id" => "ID",
            "code_article" => "small_string",
            "published" => "bool",
            "best_seller" => "bool",
            "new" => "bool",
            "elearning" => "bool",
            "certified" => "bool",
            "blended" => "bool",
            "name" => "string",
            "short_title" => "string",
            "brand" => "WK_BRAND",
            "subtitle" => "string",
            "alias" => "string",
            "picture" => "picture_object",
            "seo" => "seo_object",
            "profile" => "string_array",
            "objective" => "string_array",
            "more" => "string",
            "program" => "program_object",
            "sectors" => "link_array",
            "jobs" => "link_array",
            "products_linked" => "link_array",
            "customer_satisfaction_score" => "percentage"
        ];

        if(empty($fields))
            $fields = $product_fields;
        else{
            foreach ($fields as $idx => $fieldName){
                unset($fields[$idx]);

                $fields[$fieldName] = $product_fields[$fieldName];
            }
        }

        foreach ($fields as $fieldName => $fieldType){
            switch ($fieldType){
                case "ID" : $product[$fieldName] = $product_id; break;
                case "int" : $product[$fieldName] = $faker->randomNumber(); break;
                case "percentage" : $product[$fieldName] = $faker->randomFloat(2, 0, 100); break;
                case "bool" : $product[$fieldName] = $faker->boolean(); break;
                case "small_string" : $product[$fieldName] = $faker->text(15); break;
                case "string" : $product[$fieldName] = $faker->text(50); break;
                case "WK_BRAND" : $product[$fieldName] = $faker->boolean ? $brands : array($faker->randomElement($brands)); break;

                case "link_object" :
                    $product[$fieldName] = [
                        "link" => "/" . explode("_", $fieldName)[0] . "/one/" . $faker->numberBetween(1, 1000)
                    ];
                    break;

                case "seo_object" :
                    $product[$fieldName] = [
                        "title" => $faker->jobTitle,
                        "description" => $faker->text(300),
                        "keywords" => $faker->words(3, true)
                    ];

                    break;

                case "string_array" : $product[$fieldName] = $faker->words($faker->randomDigitNotNull); break;
                case "program_object" :
                    $product[$fieldName] = [
                        "title" => $faker->jobTitle,
                        "day" => $faker->biasedNumberBetween(1, 7),
                        "start" => $faker->time('H:i'),
                        "end" => $faker->time('H:i', "+1 hour"),
                        "type" => $faker->randomDigitNotNull,
                        "intro" => [
                            "pre_title" => $faker->text(),
                            "pre_title_desc" => $faker->text(),
                            "gt_title" => $faker->text(),
                            "gt_title_desc" => $faker->text()
                        ],
                        "descriptions" => $faker->text(300)
                    ];

                    break;

                case "link_array" :
                    $product[$fieldName] = [];
                    for($j = 0; $j < $faker->randomDigitNotNull ; $j++){
                        $product[$fieldName][] = [
                            "link" => "/" . explode("_", $fieldName)[0] . "/one/" . $faker->numberBetween(1, 1000)
                        ];
                    }

                    break;

                case "picture_object" : $product[$fieldName] = ["link" => $faker->imageUrl(1600, 900, "cats")]; break;

                default :
                    $product[$fieldName] = "";
            }
        }

        return json_encode($product);
    }
}