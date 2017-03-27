<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\CategoryRepository;
use App\Category;

class CategoryRepoTest extends TestCase
{

	use DatabaseMigrations;

	// protected static $setUpFlag = false;

	public function setUp() {
        parent::setUp();
        // Artisan::call('migrate');
        $this->artisan('migrate');

    }

    /**
     *	@group categoryrepo
     * 	@return void
     */
    public function test_all() {

    	// not found
    	$repo = new CategoryRepository();
    	$dbCategories = $repo->all();
    	$this->assertCount(0, $dbCategories);
    	
    	// found
    	$factory = factory(Category::class, 1)->create();
    	$dbCategories = $repo->all();
    	$this->assertCount(1, $dbCategories);

    	$factory = factory(Category::class, 5)->create();
    	$dbCategories = $repo->all();
    	$this->assertCount(6, $dbCategories);
    }

    /**
     *	@group categoryrepo
     * 	@return void
     */
    public function test_for_id() {

    	// not found
    	$repo = new CategoryRepository();
    	$dbCategory = $repo->forId(1);
    	$this->assertNull($dbCategory);

    	// found
    	$factory = factory(Category::class)->create();
    	$dbCategory = $repo->forId(1);
    	$this->assertEquals($factory->id, $dbCategory->id);

    }
}









