<?php
App::uses('Testimonial', 'Model');

/**
 * Testimonial Test Case
 *
 */
class TestimonialTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.testimonial',
		'app.status',
		'app.page',
		'app.page_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Testimonial = ClassRegistry::init('Testimonial');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Testimonial);

		parent::tearDown();
	}

}
