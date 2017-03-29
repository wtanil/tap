<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\ImageRepository;
use App\Image;

class ImageRepoTest extends TestCase
{
    use DatabaseMigrations;

	// protected static $setUpFlag = false;

	public function setUp() {
        parent::setUp();
        // Artisan::call('migrate');
        $this->artisan('migrate');
    }

    /**
     *	@group imagerepo
     * 	@return void
     */
    public function test_get_project() {

    	$this->assertTrue(true);

    }

    /**
     *	@group imagerepo
     * 	@return void
     */
    public function test_for_id() {

    	// not found
    	$repo = new ImageRepository();
    	$dbImage = $repo->forId(1);
    	$this->assertNull($dbImage);

    	// found
    	$factory = factory(Image::class)->create();
    	$dbImage = $repo->forId(1);
    	$this->assertEquals($factory->id, $dbImage->id);

    }

    /**
     *	@group imagerepo
     * 	@return void
     */
    public function test_create() {

    	$this->assertTrue(true);

    }

    /**
     *	@group imagerepo
     * 	@return void
     */
    public function test_update() {

    	$this->assertTrue(true);

    }

    /**
     *	@group imagerepo
     * 	@return void
     */
    public function test_delete() {

    	$this->assertTrue(true);

    }



}













