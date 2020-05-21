<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;
use App\Supplier;

class SupplierTest extends TestCase
{

    private $supplierPath = '/api/suppliers';

    /**
     * @test
     */
    function only_logged_users_can_see_suppliers()
    {
        $response = $this->call('GET', $this->supplierPath);

        $this->assertEquals(401, $response->status());
    }


    /**
     * @test
     */
    function authenticated_user_can_see_suppliers()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->call('GET', $this->supplierPath);
        
        $this->assertEquals(200, $response->status());
    }

    /**
     * @test
     */
    function non_authenticated_users_sould_not_post_suppliers()
    {
        $supplierData = factory(Supplier::class)->make()->toArray();
        
        $response = $this->call('POST', $this->supplierPath, $supplierData);
        
        $this->assertEquals(401, $response->status());
    }

    /**
     * @test
     */
    function sould_post_a_suppliers()
    {

        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->make()->toArray();
        
        $response = $this->call('POST', $this->supplierPath, $supplierData);
        
        $this->assertEquals(201, $response->status());
    }

    /**
     * @test
     */
    function sould_not_post_a_suppliers_without_a_name()
    {

        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->make()->toArray();

        unset($supplierData['name']);

        $response = $this->call('POST', $this->supplierPath, $supplierData);
        
        $this->assertEquals(422, $response->status());
    }

    /**
     * @test
     */
    function sould_not_post_a_suppliers_with_too_longer_name()
    {

        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->make()->toArray();

        $supplierData['name'] = str_repeat('a', 100) . 'b';

        $response = $this->call('POST', $this->supplierPath, $supplierData);
        
        $this->assertEquals(422, $response->status());
    }

    /**
     * @test
     */
    function non_authenticated_users_sould_not_put_suppliers()
    {

        $supplierData = factory(Supplier::class)->create();

        $response = $this->call('PUT', $this->supplierPath . '/' . $supplierData->id, [
            'name' => str_repeat('a', 100)
        ]);
        
        $this->assertEquals(401, $response->status());
    }

    /**
     * @test
     */
    function authenticated_users_sould_put_suppliers()
    {
        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->create();

        $response = $this->call('PUT', $this->supplierPath . '/' . $supplierData->id, [
            'name' => str_repeat('a', 100)
        ]);
        
        $this->assertEquals(200, $response->status());
    }

    /**
     * @test
     */
    function sould_not_put_a_suppliers_without_a_name()
    {

        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->create();

        unset($supplierData['name']);

        $response = $this->call('PUT', $this->supplierPath . '/' . $supplierData->id, $supplierData->toArray());
        
        $this->assertEquals(422, $response->status());
    }

    /**
     * @test
     */
    function sould_not_put_a_suppliers_with_too_longer_name()
    {
        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->create();

        $supplierData['name'] = str_repeat('a', 100) . 'b';

        $response = $this->call('PUT', $this->supplierPath . '/' . $supplierData->id, $supplierData->toArray());
        
        $this->assertEquals(422, $response->status());
    }

    /**
     * @test
     */
    function non_authenticated_users_sould_not_delete_suppliers()
    {
        $supplierData = factory(Supplier::class)->create();

        $response = $this->call('DELETE', $this->supplierPath . '/' . $supplierData->id);
        
        $this->assertEquals(401, $response->status());
    }

    /**
     * @test
     */
    function authenticated_users_sould_delete_suppliers()
    {
        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->create();

        $response = $this->call('DELETE', $this->supplierPath . '/' . $supplierData->id);
        
        $this->assertEquals(200, $response->status());
    }

    /**
     * @test
     */
    function non_authenticated_users_sould_not_find_suppliers()
    {
        $supplierData = factory(Supplier::class)->create();

        $response = $this->call('GET', $this->supplierPath . '/' . $supplierData->id);
        
        $this->assertEquals(401, $response->status());
    }

    /**
     * @test
     */
    function authenticated_users_sould_find_suppliers()
    {
        $this->actingAs(factory(User::class)->create());

        $supplierData = factory(Supplier::class)->create();

        $response = $this->call('GET', $this->supplierPath . '/' . $supplierData->id);

        $this->assertEquals(200, $response->status());
    }
}
