<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\UploadRedimencionamentoBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\UploadRedimencionamentoBehavior Test Case
 */
class UploadRedimencionamentoBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\UploadRedimencionamentoBehavior
     */
    public $UploadRedimencionamento;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->UploadRedimencionamento = new UploadRedimencionamentoBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UploadRedimencionamento);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
