<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tristan LASALLE <tla@e-servicial.fr>
 * Date: 10/10/16
 * Time: 15:54
 */

use EServicial\Mocks\JobsMock;
use EServicial\Mocks\OrdersMock;
use EServicial\Mocks\ProductCommentsMock;
use EServicial\Mocks\ProductsMock;
use EServicial\Mocks\ProductsOffersMock;
use EServicial\Mocks\PromotionsMock;
use EServicial\Mocks\SectorsMock;
use EServicial\Mocks\SessionMock;
use EServicial\Mocks\SessionsDaysMock;
use EServicial\Mocks\SpeakersMock;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/*****************************************************************
 * JOBS URLs                                                     *
 *****************************************************************/
Route::get('/jobs/all.json', function(){
    $brand_id = Input::get('brand_id', 0);
    $alias = Input::get('alias', '');
    $product_id = Input::get('product_id', 0);
    $parent_id = Input::get('parent_id', 0);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    $jobsMock = new JobsMock();
    return $jobsMock->findAll($brand_id, $alias, $product_id, $parent_id, $page, $size);
});

Route::get('/jobs/one/{id}.json', function($id){
    $jobsMock = new JobsMock();
    return $jobsMock->findOne($id);
});

/*****************************************************************
 * PROMOTIONS URLs                                               *
 *****************************************************************/
Route::get('/promotions/all.json', function(){
    $promotion_code = Input::get('promotion_code', '');

    if(empty($promotion_code))
        throw new NotFoundHttpException();

    $promotionsMock = new PromotionsMock();
    return $promotionsMock->findOne($promotion_code);
});

/*****************************************************************
 * SECTORS URLs                                                  *
 *****************************************************************/
Route::get('/sectors/all.json', function(){
    $brand_id = Input::get('brand_id', 0);
    $alias = Input::get('alias', '');
    $product_id = Input::get('product_id', 0);
    $parent_id = Input::get('parent_id', 0);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    $sectorsMock = new SectorsMock();
    return $sectorsMock->findAll($brand_id, $alias, $product_id, $parent_id, $page, $size);
});

Route::get('/sectors/one/{id}.json', function($id){
    $sectorsMock = new SectorsMock();
    return $sectorsMock->findOne($id);
});

/*****************************************************************
 * SPEAKERS URLs                                                 *
 *****************************************************************/
Route::get('/speakers/all.json', function(){
    $session_id = Input::get('session_id', 0);
    $published = Input::get('published', false);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    $speakersMock = new SpeakersMock();
    return $speakersMock->findAll($session_id, $published, $page, $size);
});

Route::get('/speakers/one/{id}.json', function($id){
    $speakersMock = new SpeakersMock();
    return $speakersMock->findOne($id);
});
/*****************************************************************
 * ORDERS URLs                                                   *
 ****************************************************************/
Route::post('/orders/create.json', function(){
    $ordersMock = new OrdersMock();
    return $ordersMock->createOrder([]);
});

/*****************************************************************
 * PRODUCT COMMENTS URLs                                         *
 ****************************************************************/
Route::get('/products/{product_id}/comments.json', function($product_id){
    $productCommentsMock = new ProductCommentsMock();

    if(!$product_id || !intval($product_id))
        throw new NotFoundHttpException();

    $published = Input::get('published', null);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    return $productCommentsMock->findAll($product_id, $published, $page, $size);
});

Route::get('/products/{product_id}/comments/{comment_id}.json', function($product_id, $comment_id){
    $productCommentsMock = new ProductCommentsMock();

    if(!$product_id || !intval($product_id) || !$comment_id || !intval($comment_id))
        throw new NotFoundHttpException();

    return $productCommentsMock->findOne($product_id, $comment_id);
});

/*****************************************************************
 * PRODUCT URLs                                                  *
 *****************************************************************/
Route::get('/products/all.json', function(){
    $brand_id = Input::get('brand_id', 0);
    $alias = Input::get('alias', '');
    $type = Input::get('type', '');
    $search = Input::get('search', '');
    $search_type = Input::get('search_type', '');
    $published = Input::get('published', null);
    $new = Input::get('new', null);
    $fields = Input::get('fields', []);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    $productMock = new ProductsMock();
    return $productMock->findAll($brand_id, $alias, $type, $search, $search_type, $published, $new, $fields, $page, $size);
});

Route::get('/products/one/{product_id}.json', function($product_id){
    if(!$product_id || !intval($product_id))
        throw new NotFoundHttpException();

    $productMock = new ProductsMock();
    return $productMock->findOne($product_id, []);
});

/*****************************************************************
 * PRODUCTS OFFERS URLs                                          *
 *****************************************************************/
Route::get('/offers/all.json', function(){
    $product_id = Input::get('product_id', 0);
    $published = Input::get('published', null);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    $productsOffersMock = new ProductsOffersMock();
    return $productsOffersMock->findAll($product_id, $published, $page, $size);
});

Route::get('/offers/one/{offer_id}.json', function($offer_id){
    if(!$offer_id || !intval($offer_id))
        throw new NotFoundHttpException();

    $productsOffersMock = new ProductsOffersMock();
    return $productsOffersMock->findOne($offer_id);
});

/*****************************************************************
 * SESSIONS URLs                                                 *
 *****************************************************************/
Route::get('/sessions/all.json', function(){
    $product_id = Input::get('product_id', 0);
    $published = Input::get('published', null);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    $sessionsMock = new SessionMock();
    return $sessionsMock->findAll($product_id, $published, $page, $size);
});

Route::get('/sessions/one/{id}.json', function($id){
    if(!$id || !intval($id))
        throw new NotFoundHttpException();

    $sessionsMock = new SessionMock();
    return $sessionsMock->findOne($id);
});

/*****************************************************************
 * SESSIONS DAYS URLs                                            *
 *****************************************************************/
Route::get('/days/all.json', function(){
    $session_id = Input::get('session_id', 0);
    $page = Input::get('page', 1);
    $size = Input::get('size', 10);

    $sessionDaysMock = new SessionsDaysMock();
    return $sessionDaysMock->findAll($session_id, $page, $size);
});

Route::get('/days/one/{id}.json', function($id){
    if(!$id || !intval($id))
        throw new NotFoundHttpException();

    $sessionDaysMock = new SessionsDaysMock();
    return $sessionDaysMock->findOne($id);
});

/*****************************************************************
 * UTILS URLs                                                    *
 *****************************************************************/
Route::get('/error/500.json', function(){
    throw new HttpException("Error 500");
});
