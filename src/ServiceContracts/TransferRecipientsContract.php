<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\TransferRecipients\TransferRecipientCreateBankAccountParams\Country;
use Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Operator;
use Bila\TransferRecipients\TransferRecipientGetResponse;
use Bila\TransferRecipients\TransferRecipientListParams\Type;
use Bila\TransferRecipients\TransferRecipientListResponse;
use Bila\TransferRecipients\TransferRecipientNewBankAccountResponse;
use Bila\TransferRecipients\TransferRecipientNewMobileMoneyResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface TransferRecipientsContract
{
    /**
     * @api
     *
     * @param string $id Recipient UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): TransferRecipientGetResponse;

    /**
     * @api
     *
     * @param float $page Page number (default: 1)
     * @param float $perPage Items per page (default: 50)
     * @param Type|value-of<Type> $type Filter by recipient type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?float $page = null,
        ?float $perPage = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): TransferRecipientListResponse;

    /**
     * @api
     *
     * @param string $accountNumber Bank account number
     * @param string $bankID Bank ID
     * @param string $accountName Account holder name (optional, will be resolved)
     * @param Country|value-of<Country> $country Country code
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createBankAccount(
        string $accountNumber,
        string $bankID,
        ?string $accountName = null,
        Country|string|null $country = null,
        RequestOptions|array|null $requestOptions = null,
    ): TransferRecipientNewBankAccountResponse;

    /**
     * @api
     *
     * @param \Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Country|value-of<\Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Country> $country Country code
     * @param Operator|value-of<Operator> $operator Mobile money operator
     * @param string $phone Mobile phone number
     * @param string $accountName Account holder name (optional, will be resolved)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createMobileMoney(
        \Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Country|string $country,
        Operator|string $operator,
        string $phone,
        ?string $accountName = null,
        RequestOptions|array|null $requestOptions = null,
    ): TransferRecipientNewMobileMoneyResponse;
}
