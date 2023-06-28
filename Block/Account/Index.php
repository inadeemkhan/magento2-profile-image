<?php
declare(strict_types=1);

namespace Nadeem\ProfilePicture\Block\Account;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session\Proxy
     */
    private $_customerSession;
    /**
     * @var \Magento\Customer\Model\Customer 
     */
    protected $_customerModel;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Customer\Model\Customer $customerModel,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_customerSession = $customerSession;
        $this->_customerModel = $customerModel;
        $this->_storeManager = $storeManager;
        
    }

    /**
     * Get the profile picture complete path
     * @return string
     */
    public function isCustomerLoggedIn()
    {
        if ($this->customerSession->isLoggedIn() && $this->customerSession->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * Get the store Base url
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    /**
     * Get the media url
     * @return string
     */
    public function getMediaUrl()
    {
        return $this->getBaseUrl().'pub/media/';
    }

    /**
     * Get the profile picture complete path
     * @return string
     */
    public function getCustomerProfilePicture($profilePicturePath)
    {
        return $this->getMediaUrl().'customer'.$profilePicturePath;
    }

    /**
     * Get the profile picture complete path
     * @return string
     */
    public function getCustomerProfilePictureUrl()
    {
        $customerData = $this->_customerModel->load($this->_customerSession->getId());
        $profilePicturePath = $customerData->getData('customer_profile_picture');
        if (!empty($profilePicturePath)) {
            return $this->getCustomerProfilePicture($profilePicturePath);
        }
        return false;
    }
}

