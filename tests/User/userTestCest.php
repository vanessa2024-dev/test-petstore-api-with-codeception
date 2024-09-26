<?php


namespace Tests\User;

use Tests\Support\UserTester;

class userTestCest
{
    public function _before(UserTester $I)
    {
    }

    // tests
    public function createAnUser(UserTester $I)
    
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $data=json_encode([
            "id"=> 100,
            "username"=> "leila",
            "firstName"=> "lerine",
            "lastName"=> "James",
            "email"=> "leila@email.com",
            "password"=> "12345",
            "phone"=> "12345",
            "userStatus"=> 1
        ]);
        $I->sendPost('/user',$data);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(200);
        
    }
    
    public function getLoginOfUser(UserTester $I)
    {
        $I->sendGet('/user/login',[
            "username"=>"leila",
            "password"=>"12345",
        ]); 
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseCodeIs(200);  
    }
    public function tLogoutAnUser(UserTester $I)
    {
            $I->sendGet('/user/logout');
            $I->seeResponseCodeIsSuccessful();
    }

    public function getUserByName(UserTester $I)
    {
        $I->sendGet('/user/leila');
        $I->seeResponseCodeIs(200);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            "id"=> 100,
            "username"=> "leila",
            "firstName"=> "lerine",
            "lastName"=> "James",
            "email"=> "leila@email.com",
            "password"=> "12345",
            "phone"=> "12345",
            "userStatus"=> 1


        ]);
    }
    public function updateUser(UserTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $data=json_encode([
            "id"=> 100,
            "username"=> "lesli",
            "firstName"=> "lerine",
            "lastName"=> "James",
            "email"=> "leslia@email.com",
            "password"=> "12345",
            "phone"=> "12345",
            "userStatus"=> 1
        ]);
        $I->sendPut('/user/leila',$data);
        $I->seeResponseCodeIsSuccessful();
    }
    public function delete(UserTester $I)
    {
        $I->sendDelete('/user/lesli');
        $I->seeResponseCodeIsSuccessful();

    }
    public function redelete(UserTester $I)
    {
        $I->sendDelete('/user/lesli');
        $I->seeResponseCodeIs(404);
    }
}
