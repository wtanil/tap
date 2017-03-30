<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\CategoryRepository;
use App\Category;
use Illuminate\Http\Request;

class CategoryRepoTest extends TestCase
{

	use DatabaseMigrations;

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

    /**
     *  @group categoryrepo
     *  @return void
     */
    public function test_create() {

        $request = new Request();
        $request->replace([
            'name' => 'test category name'
            ]);
        $repo = new CategoryRepository();
        $isCreated = $repo->create($request);

        $this->assertTrue($isCreated);
        $dbCategories = $repo->all();
        $this->assertCount(1, $dbCategories);

    }

    /**
     *  @group categoryrepo
     *  @return void
     */
    public function test_update() {

        $repo = new CategoryRepository();
        $factory = factory(Category::class)->create();

        $request = new Request();
        $request->replace([
            'name' => 'expected test category name'
            ]);

        $repo->update($request, 1);

        $dbCategory = $repo->forId(1);
        $this->assertEquals('expected test category name', $dbCategory->name);

    }

    /**
     *  @group categoryrepo
     *  @return void
     */
    public function test_delete() {

        $repo = new CategoryRepository();
        $factory = factory(Category::class)->create();
        $repo->delete(1);

        $dbCategories = $repo->all();
        $this->assertCount(0, $dbCategories);

    }


}









