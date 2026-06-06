<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Resolve\ResolveBankAccountParams\Country;
use Bila\Resolve\ResolveBankAccountResponse;
use Bila\Resolve\ResolveMobileMoneyParams\Operator;
use Bila\Resolve\ResolveMobileMoneyResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface ResolveContract
{
    /**
     * @api
     *
     * @param string $accountNumber Bank account number
     * @param string $bankID Bank ID
     * @param Country|value-of<Country> $country Country code
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function bankAccount(
        string $accountNumber,
        string $bankID,
        Country|string|null $country = null,
        RequestOptions|array|null $requestOptions = null,
    ): ResolveBankAccountResponse;

    /**
     * @api
     *
     * @param \Bila\Resolve\ResolveMobileMoneyParams\Country|value-of<\Bila\Resolve\ResolveMobileMoneyParams\Country> $country Country code
     * @param Operator|value-of<Operator> $operator Mobile money operator
     * @param string $phone Mobile phone number
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function mobileMoney(
        \Bila\Resolve\ResolveMobileMoneyParams\Country|string $country,
        Operator|string $operator,
        string $phone,
        RequestOptions|array|null $requestOptions = null,
    ): ResolveMobileMoneyResponse;
}
