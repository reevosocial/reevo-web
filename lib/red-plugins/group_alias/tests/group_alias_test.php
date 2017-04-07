<?php
/**
 * Elgg Group Alias Tests
 *
 * Plugin authors: copy this file to your plugin's test directory. Register an Elgg
 * plugin hook and function similar to:
 *
 * elgg_register_plugin_hook_handler('unit_test', 'system', 'my_new_unit_test');
 *
 * function my_new_unit_test($hook, $type, $value, $params) {
 *   $value[] = "path/to/my/unit_test.php";
 *   return $value;
 * }
 *
 * @package Elgg
 * @subpackage Test
 */
class ElggGroupAliasTest extends ElggCoreUnitTest {

	// New group
	var $new_group;

	// Saved (aliased) group
	var $existing_group;

	/**
	 * Called before each test object.
	 */
	public function __construct() {
		parent::__construct();

		// all __construct() code should come after here
	}

	/**
	 * Called before each test method.
	 */
	public function setUp() {
		$this->existing_group = new ElggGroup();
		$this->existing_group->name = "Aliased Test Group";
		$this->existing_group->alias = 'aliased_test_group';
		$this->existing_group->save();

		$this->new_group = new ElggGroup();
		$this->new_group->name = 'group_alias test group';
	}

	/**
	 * Called after each test method.
	 */
	public function tearDown() {
		// do not allow SimpleTest to interpret Elgg notices as exceptions
		$this->swallowErrors();
		// Remove created objects
		$this->existing_group->delete();
		$this->new_group->delete();
	}

	/**
	 * Called after each test object.
	 */
	public function __destruct() {
		// all __destruct() code should go above here
		parent::__destruct();
	}

	public function testNewGroupHasNoAlias() {
		$this->assertNull($this->new_group->alias);
	}

	public function testGroupAliasSave() {
		$this->new_group->alias = 'sample_alias';
		$this->assertTrue($this->new_group->save());
		$this->assertIdentical('sample_alias', $this->new_group->alias);
		$this->assertNotNull($this->new_group->alias);
	}

	public function testGroupAliasUpdate() {
		$alias = $this->existing_group->alias;
		$this->assertEqual($alias, 'aliased_test_group');
		$this->existing_group->set('alias', 'new_alias');
		$this->assertTrue($this->existing_group->save());
		$this->assertIdentical($this->existing_group->get('alias'), 'new_alias');
	}

	public function testGroupAliasPersistence() {
		$this->existing_group->name = 'Changed Name';
		$this->assertTrue($this->existing_group->save());
		$this->assertIdentical($this->existing_group->alias, 'aliased_test_group');
    }

// @todo: how to tell ElggGroup to save default metadata?
//	public function testGroupAliasDefault() {
//		$this->new_group->name = 'A group without an alias';
//		$this->assertTrue($this->new_group->save());
//		$this->assertIdentical('a_group_without_an_alias', $this->new_group->alias);
//	}

}
