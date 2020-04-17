<?php declare(strict_types=1);

namespace MultiSafepay\Tests\Unit\Api\Issuers\RequestOrder;

use MultiSafepay\Api\Transactions\RequestOrder\CustomerDetails;
use MultiSafepay\Tests\Fixtures\AddressFixture;
use MultiSafepay\ValueObject\Customer\Address;
use MultiSafepay\ValueObject\Customer\Country;
use MultiSafepay\ValueObject\Customer\EmailAddress;
use MultiSafepay\ValueObject\Customer\IpAddress;
use PHPUnit\Framework\TestCase;

/**
 * Class CustomerDetailsTest
 * @package MultiSafepay\Tests\Unit\Api\Transactions\RequestOrder
 */
class CustomerDetailsTest extends TestCase
{
    use AddressFixture;

    /**
     * Test case to guarantee that CustomerDetails transfers all details properly
     */
    public function testWorkingCustomerDetails()
    {
        $address = $this->createAddressFixture();
        $customerDetails = new CustomerDetails(
            'John',
            'Doe',
            $address,
            new IpAddress('127.0.0.1'),
            new EmailAddress('info@example.org')
        );
        $customerDetails->addLocale('nl');
        $customerDetails->addReferrer('http://example.org');
        $customerDetails->addUserAgent('Unknown');

        $this->assertEquals('John', $customerDetails->getFirstName());
        $this->assertEquals('nl', $customerDetails->getLocale());
        $this->assertEquals('http://example.org', $customerDetails->getReferrer());
        $this->assertEquals('Unknown', $customerDetails->getUserAgent());

        $customerData = $customerDetails->getData();
        $this->assertEquals('Kraanspoor', $customerData['address1']);
        $this->assertEquals('(blue door)', $customerData['address2']);
        $this->assertEquals('18 A', $customerData['house_number']);
        $this->assertEquals('1000AA', $customerData['zip_code']);
        $this->assertEquals('Amsterdam', $customerData['city']);
        $this->assertEquals('Noord Holland', $customerData['state']);
        $this->assertEquals('NL', $customerData['country']);
        $this->assertEquals('0123456789', $customerData['phone1']);
        $this->assertEmpty($customerData['phone2']);
        $this->assertEquals('info@example.org', $customerData['email']);
        $this->assertEquals('127.0.0.1', $customerData['ip_address']);
        $this->assertEquals('nl', $customerData['locale']);
        $this->assertEquals('http://example.org', $customerData['referrer']);
        $this->assertEquals('Unknown', $customerData['user_agent']);
    }
}