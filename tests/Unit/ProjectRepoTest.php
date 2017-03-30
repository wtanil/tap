<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\ProjectRepository;
use App\Project;
use App\Image;
use App\Category;
use Illuminate\Http\Request;

class ProjectRepoTest extends TestCase
{
    use DatabaseMigrations;

	public function setUp() {
        parent::setUp();
        // Artisan::call('migrate');
        $this->artisan('migrate');
    }

    /**
     *	@group projectrepo
     * 	@return void
     */
    public function test_all() {

    	// not found
    	$repo = new ProjectRepository();
    	$dbProjects = $repo->all();
    	$this->assertCount(0, $dbProjects);
    	
    	// found
    	$factory = factory(Project::class, 1)->create();
    	$dbProjects = $repo->all();
    	$this->assertCount(1, $dbProjects);

    	$factory = factory(Project::class, 5)->create();
    	$dbProjects = $repo->all();
    	$this->assertCount(6, $dbProjects);
    }

    /**
     *	@group projectrepo
     * 	@return void
     */
    public function test_for_id() {

    	// not found
    	$repo = new ProjectRepository();
    	$dbProject = $repo->forId(1);
    	$this->assertNull($dbProject);

    	// found
    	$factory = factory(Project::class)->create();
    	$dbProject = $repo->forId(1);
    	$this->assertEquals($factory->id, $dbProject->id);

    }

    /**
     *	@group projectrepo
     * 	@return void
     */
    public function test_get_images() {

    	$repo = new ProjectRepository();
    	$factory = factory(Project::class)->create();
    	$factoryImage = factory(Image::class, 3)->create();

    	$dbImages = $repo->getImages(1);
    	$this->assertCount(3, $dbImages);
    }

    /**
     *	@group projectrepo
     * 	@return void
     */
    public function test_get_thumbnail() {

    	$repo = new ProjectRepository();
    	$factory = factory(Project::class)->create();
    	$factoryImage = factory(Image::class, 3)->create();

    	$dbProject = $repo->forId(1);
    	$dbImages = $repo->getThumbnail(1);
    	$this->assertEquals($dbProject->thumbnail_id, $dbImages->id);
    }

    /**
     *	@group projectrepo
     * 	@return void
     */
    public function test_get_category() {

    	$repo = new ProjectRepository();
    	$factory = factory(Project::class)->create();
    	$factoryImage = factory(Category::class)->create();

    	$dbProject = $repo->forId(1);
    	$dbCategory = $repo->getCategory(1);
    	$this->assertEquals($dbProject->category_id, $dbCategory->id);
    }

	/**
     *	@group projectrepo
     * 	@return void
     */
    public function test_create() {

    	$request = new Request();
        $request->replace([
            'categoryId' => 1,
            'title' => 'test project name',
            'projectDate' => '2017-01-01',
            ]);
        $repo = new ProjectRepository();
        $isCreated = $repo->create($request);

        $this->assertTrue($isCreated);
        $dbProject = $repo->all();
        $this->assertCount(1, $dbProject);

    }

    /**
     *	@group projectrepo
     * 	@return void
     */
    public function test_update() {

    	$repo = new ProjectRepository();
        $factory = factory(Project::class)->create();

        $request = new Request();
        $request->replace([
        	'categoryId' => 1,
        	'thumbnailId' => 1,
            'title' => 'expected test project',
            'projectDate' => '2017-01-01',
            'active' => false,
            ]);

        $repo->update($request, 1);

        $dbProject = $repo->forId(1);
        $this->assertEquals('expected test project', $dbProject->title);
	}

	/**
     *	@group projectrepo
     * 	@return void
     */
    public function test_set_active() {

    	$repo = new ProjectRepository();
        $factory = factory(Project::class)->create();

        $repo->setActive(true, 1);

        $dbProject = $repo->forId(1);
        $this->assertEquals(1, $dbProject->active);
	}

	/**
     *	@group projectrepo
     * 	@return void
     */
    public function test_delete() {

    	$repo = new ProjectRepository();
        $factory = factory(Project::class)->create();
        $repo->delete(1);

        $dbProjects = $repo->all();
        $this->assertCount(0, $dbProjects);
	}

}











