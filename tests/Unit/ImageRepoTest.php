<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\ImageRepository;
use App\Image;
use App\Project;
use Illuminate\Http\Request;

class ImageRepoTest extends TestCase
{
    use DatabaseMigrations;

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

    	$factoryProject = factory(Project::class)->create();
        $factoryImage = factory(Image::class)->create();

        $repo = new ImageRepository();
        $dbProject = $repo->getProject(1);

        $this->assertEquals($factoryProject->title, $dbProject->title);

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

    	$request = new Request();
        $request->replace([
            'projectId' => 1,
            'subtitle' => 'test image',
            'lowResUrl' => '',
            'highResUrl' => '',
            ]);
        $repo = new ImageRepository();
        $isCreated = $repo->create($request);

        $this->assertTrue($isCreated);
        $dbImage = $repo->forId(1);
        $this->assertEquals(1, $dbImage->id);

    }

    /**
     *	@group imagerepo
     * 	@return void
     */
    public function test_update() {

    	$repo = new ImageRepository();
        $factory = factory(Image::class)->create();

        $request = new Request();
        $request->replace([
            'subtitle' => 'expected test image'
            ]);

        $repo->update($request, 1);

        $dbImage = $repo->forId(1);
        $this->assertEquals('expected test image', $dbImage->subtitle);

    }

    /**
     *	@group imagerepo
     * 	@return void
     */
    public function test_delete() {

    	$repo = new ImageRepository();
        $factory = factory(Image::class)->create();
        $repo->delete(1);

        $dbImage = $repo->forId(1);
        $this->assertNull($dbImage);

    }



}













