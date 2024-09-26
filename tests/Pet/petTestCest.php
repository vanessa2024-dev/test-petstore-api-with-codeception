<?php


namespace Tests\Pet;

use Tests\Support\PetTester;

class petTestCest
{
    public function _before(PetTester $I)
    {
    }

    // tests
    public function addAPet(PetTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $data = json_encode([
            
               "id"=> 90,
                 "category"=>[
                  "id"=> 90,
                  "name"=> "name90"
                ],
                "name"=> "name90",
                "photoUrls"=>[
                  "photoUrls90"
                ],
                "tags"=>
                 [
                ],
                "status"=> "available"
              
        ]);
        $I->sendPOST('/pet', $data);
        
      
        $I->seeResponseCodeIs(200);

    }

    public function findBystatus(PetTester $I){
        $I->sendGet('pet/findByStatus?status=available');
        $I->seeResponseCodeIs(200);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();

    }
    public function getPetById (PetTester $I){
        $I->sendGet('/pet/90');
       $I->seeResponseCodeIs(200);
       $I->seeResponseCodeIsSuccessful();
      $I->seeResponseIsJson();
      $I->seeResponseContainsJson([
            "id"=> 90,
            "name"=> "name90",
            "category"=> [
                "id"=> 90,
                "name"=> "name90"
      ],
            "photoUrls"=> [
                "photoUrls90"
            ],
            "tags"=> [
                
            ],
            "status"=> "available"
        ]);

    }
    public function UpdateAnExistingPetById(PetTester $I){
        $I->haveHttpHeader('Content-Type', 'application/json');
        $data=json_encode(
            ["id"=> 90,
            "name"=> "doggie",
            "category"=> [
                "id"=> 1,
                "name"=> "Dogs"
            ],
            "photoUrls"=> [
                "string"
            ],
            "tags"=> [
                
            ],
            "status"=> "available"]);
       $I->sendPut('/pet',$data);
       $I->seeResponseCodeIs(200);
       $I->seeResponseCodeIsSuccessful();
      $I->seeResponseIsJson();
     
    }
    
    public function deleteAPet(PetTester $I){
       $I->sendDelete('/pet/90');
       $I->seeResponseCodeIs(200);

    }
    public function reDeleteAPet(PetTester $I){
        $I->sendDelete('/pet/90');
        $I->seeResponseCodeIs(404);
 
     }
   
}
