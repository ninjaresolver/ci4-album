<?php namespace AlbumTest\Database\Infrastructure\Persistence\Album;

use Album\Database\Seeds\AlbumSeeder;
use Album\Database\Seeds\TrackSeeder;
use Album\Domain\Album\Album;
use Album\Domain\Track\Track;
use Album\Domain\Track\TrackNotFoundException;
use CodeIgniter\Pager\PagerInterface;
use CodeIgniter\Test\CIDatabaseTestCase;
use Config\Services;

class SQLTrackRepositoryTest extends CIDatabaseTestCase
{
	protected $basePath  = __DIR__ . '/../src/Database/';
	protected $namespace = 'Album';
	protected $seed      = [
		AlbumSeeder::class,
		TrackSeeder::class,
	];
	private $repository;

	protected function setUp(): void
	{
		parent::setUp();

		$this->repository = Services::trackRepository();
	}

	public function testPagerIsNullBeforeFindPaginatedDataCalled()
	{
		$this->assertNull($this->repository->pager());
	}

	public function testfindPaginatedDataWithKeywordNotFoundInDatabase()
	{
		$album     = new Album();
		$album->id = 1;

		$tracks = $this->repository->findPaginatedData($album, 'Pak Ngah');
		$this->assertEmpty($tracks);
	}

	public function testfindPaginatedDataWithKeywordFoundInDatabase()
	{
		$album     = new Album();
		$album->id = 1;

		$tracks = $this->repository->findPaginatedData($album, 'Eross Chandra');
		$this->assertNotEmpty($tracks);
	}

	public function testPager()
	{
		$this->assertInstanceOf(PagerInterface::class, $this->repository->pager());
	}

	public function testFindTrackOfIdWithNotFoundIdInDatabase()
	{
		$this->expectException(TrackNotFoundException::class);
		$this->repository->findTrackOfId(rand(1000, 2000));
	}

	public function testFindTrackOfIdWithFoundIdInDatabase()
	{
		$this->assertInstanceOf(Track::class, $this->repository->findTrackOfId(1));
	}

	public function invalidData()
	{
		return [
			'empty array' => [
				[],
			],
			'null'        => [
				null
			],
		];
	}

	/**
	 * @dataProvider invalidData
	 */
	public function testSaveInvalidData($data)
	{
		$this->assertFalse($this->repository->save($data));
	}

	public function validData()
	{
		return [
			'insert' => [
				[
					'album_id' => 1,
					'title'    => 'Sahabat Sejati',
					'author'   => 'Erros Chandra',
				],
			],
			'update' => [
				[
					'id'       => 1,
					'album_id' => 1,
					'title'    => 'Temani Aku',
					'author'   => 'Erros Chandra',
				],
			],
		];
	}

	/**
	 * @dataProvider validData
	 * @runInSeparateProcess
	 * @preserveGlobalState         disabled
	 */
	public function testSaveValidData(array $data)
	{
		$this->assertTrue($this->repository->save($data));
	}

	/**
	 * @runInSeparateProcess
	 * @preserveGlobalState         disabled
	 */
	public function testErrorIsNullOnNoSaveCalled()
	{
		$this->assertNull($this->repository->errors());
	}

	/**
	 * @dataProvider validData
	 * @runInSeparateProcess
	 * @preserveGlobalState         disabled
	 */
	public function testErrorIsNullAfterSaveCalledWithValidData($data)
	{
		$this->repository->save($data);
		$this->assertNull($this->repository->errors());
	}

	/**
	 * @dataProvider invalidData
	 * @runInSeparateProcess
	 * @preserveGlobalState         disabled
	 */
	public function testErrorIsArrayAfterSaveCalledWithInValidData($data)
	{
		$this->repository->save($data);
		$this->assertIsArray($this->repository->errors());
	}

	public function testDeleteTrackOfIdWithNotFoundIdInDatabase()
	{
		$this->expectException(TrackNotFoundException::class);
		$this->repository->deleteOfId(rand(1000, 2000));
	}

	public function testDeleteTrackOfIdWithFoundIdInDatabase()
	{
		$this->assertTrue($this->repository->deleteOfId(1));
	}
}
