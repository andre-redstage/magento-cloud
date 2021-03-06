<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Reward\Model\Reward;

class HistoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Reward\Model\Reward\History
     */
    protected $_model;

    protected function setUp()
    {
        $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $this->_model = $objectManager->create('Magento\Reward\Model\Reward\History');
    }

    /**
     * @magentoDataFixture Magento/Reward/_files/reward.php
     * @magentoDbIsolation enabled
     */
    public function testCrud()
    {
        /** @var $reward \Magento\Reward\Model\Reward */
        $reward = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create('Magento\Reward\Model\Reward');
        $reward->setCustomerId(1);
        $reward->setWebsiteId(1);
        $reward->loadByCustomer();

        $this->_model->setRewardId(
            $reward->getId()
        )->setWebsiteId(
            1
        )->addAdditionalData(
            ['email' => 'email.initial@example.com']
        );
        $crud = new \Magento\TestFramework\Entity(
            $this->_model,
            ['additional_data' => ['email' => 'email.overridden@example.com']]
        );
        $crud->testCrud();
    }
}
