<?php declare(strict_types=1);
/**
 * Copyright © 2020 MultiSafepay, Inc. All rights reserved.
 * See DISCLAIMER.md for disclaimer details.
 */

namespace MultiSafepay\Tests\Api\Integration\Transactions;

use MultiSafepay\Api\Transactions\TransactionResponse;
use MultiSafepay\Tests\Fixtures\ValueObject\AddressFixture;
use MultiSafepay\Tests\Fixtures\OrderRequest\Arguments\CustomerDetailsFixture;
use MultiSafepay\Tests\Fixtures\OrderRequest\DirectFixture as DirectOrderRequestFixture;
use MultiSafepay\Tests\Fixtures\OrderRequest\Arguments\PaymentOptionsFixture;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    use DirectOrderRequestFixture;
    use PaymentOptionsFixture;
    use CustomerDetailsFixture;
    use AddressFixture;

    /**
     * Test the simple data transfer of a transaction object
     */
    public function testGetOrderData(): void
    {
        $requestDirectOrder = $this->createOrderIdealDirectRequestFixture();
        $transaction = new TransactionResponse($requestDirectOrder->getData());

        $data = $transaction->getData();
        $this->assertArrayHasKey('type', $data, var_export($data, true));
    }
}
