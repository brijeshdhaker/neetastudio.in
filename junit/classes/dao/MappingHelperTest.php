<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-03-13 at 09:47:37.
 */
class MappingHelperTest extends PHPUnit_Framework_TestCase {

    /**
     * @var MappingHelper
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new MappingHelper;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers MappingHelper::getMapping
     * @todo   Implement testGetMapping().
     */
    public function testGetMapping() {
        //$this->markTestIncomplete('This test has not been implemented yet.');
        $mapping = array(
            "ID" => "id",
            "CODE" => "code",
            "NAME" => "name",
            "GROUPS" => "group",
            "GNAME" => "groupName"
        );
        $this->assertEquals($mapping, MappingHelper::getMapping('core-data'));
    }

}
