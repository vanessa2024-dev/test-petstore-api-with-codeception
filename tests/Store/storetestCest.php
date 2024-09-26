<?php


namespace Tests\Store;

use Tests\Support\StoreTester;

class storetestCest
{
    public function _before(StoreTester $I)
    {
    }

    // tests
    public function getTheInventoryOfPets(StoreTester $I)
    {
        $I->sendGet('/store/inventory');
        $I->seeResponseCodeIs(200);
        $I->seeResponseCodeIsSuccessful();
    }
    public function storeAnOrderForAPet(StoreTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $data=json_encode
        ([
            "id"=> 10,
            "petId"=> 90,
            "quantity"=> 7,
            "shipDate"=> "2024-09-24T14:22:04.867Z",
            "status"=> "approved",
            "complete"=> true

        ]);
        $I->sendPost('/store/order', $data);
        $I->seeResponseCodeIs(200);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
                "id"=>"integer",
                "petId"=> "integer",
                "quantity"=> "integer",
                "shipDate"=> "string",
                "status"=> "string",
                "complete"=> "boolean"

]);
    }
    public function findOrederBId(StoreTester $I)
    {
        $I->sendGet('/store/order/10');
        $I->seeResponseCodeIs(200);
        $I->seeResponseCodeIsSuccessful();
    }
    public function deletAStore(StoreTester $I)
    {
        $I->sendDelete('/store/order/10');
        $I->seeResponseCodeIsSuccessful();
    }
}
