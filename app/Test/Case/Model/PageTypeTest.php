<?php
App::uses('PageType', 'Model');

/**
 * PageType Test Case
 *
 */
class PageTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.page_type',
		'app.page',
		'app.status',
		'app.created_by_user',
		'app.updated_by_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PageType = ClassRegistry::init('PageType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PageType);

		parent::tearDown();
	}

}
