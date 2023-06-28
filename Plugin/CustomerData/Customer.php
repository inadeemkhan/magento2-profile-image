<?php
namespace Nadeem\ProfilePicture\Plugin\CustomerData;
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Class Customer
 * @package Nadeem\ProfilePicture\Plugin\CustomerData
 */
class Customer
{
    /**
     * @var \Magento\Customer\Model\Session\Proxy
     */
    private $customerSession;
    /**
     * @var \Magento\Customer\Api\GroupRepositoryInterface
     */
    private $groupRepository;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var \Magento\Framework\View\Element\AbstractBlock
     */
    protected $viewFileUrl;
    /**
     * Customer constructor
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param \Magento\Customer\Api\GroupRepositoryInterface $groupRepository
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\Asset\Repository $viewFileUrl
     */
    public function __construct(
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Customer\Api\GroupRepositoryInterface $groupRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Asset\Repository $viewFileUrl
    ) {
        $this->customerSession = $customerSession;
        $this->groupRepository = $groupRepository;
        $this->_storeManager = $storeManager;
        $this->viewFileUrl = $viewFileUrl;
    }
    /**
     * @param \Magento\Customer\CustomerData\Customer $subject
     * @param $result
     * @return mixed
     */
    public function afterGetSectionData(\Magento\Customer\CustomerData\Customer $subject, $result)
    {
        $result['is_logged_in'] = $this->customerSession->isLoggedIn();
        if ($this->customerSession->isLoggedIn() && $this->customerSession->getCustomerId()) {
            $customer = $this->customerSession->getCustomer();
            $result['email'] = $customer->getEmail();
            $result['lastname'] = $customer->getLastname();
            $result['customer_group_id'] = $customer->getGroupId();
            $result['profile_picture'] = $this->getProfilePictureUrl($customer->getCustomerProfilePicture());
        }
        return $result;
    }
    /**
     * Get the profile picture complete path
     * @return string
     */
    public function getProfilePictureUrl($profilePictureName)
    {
        $picturePath = $this->viewFileUrl->getUrl('Nadeem_ProfilePicture::images/profile.jpeg');
        if (!empty($profilePictureName)) {
            $picturePath = $profilePictureName;
            return $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .'customer'. $picturePath;
        }
        return $picturePath;
    }
}