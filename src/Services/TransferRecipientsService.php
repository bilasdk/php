<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\TransferRecipientsContract;
use Bila\TransferRecipients\TransferRecipientCreateBankAccountParams\Country;
use Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Operator;
use Bila\TransferRecipients\TransferRecipientGetResponse;
use Bila\TransferRecipients\TransferRecipientListParams\Type;
use Bila\TransferRecipients\TransferRecipientListResponse;
use Bila\TransferRecipients\TransferRecipientNewBankAccountResponse;
use Bila\TransferRecipients\TransferRecipientNewMobileMoneyResponse;

/**
 * Transfer recipient management endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class TransferRecipientsService implements TransferRecipientsContract
{
    /**
     * @api
     */
    public TransferRecipientsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TransferRecipientsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a single transfer recipient by its UUID
     *
     * @param string $id Recipient UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): TransferRecipientGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of saved transfer recipients
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
    ): TransferRecipientListResponse {
        $params = Util::removeNulls(
            ['page' => $page, 'perPage' => $perPage, 'type' => $type]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a new bank account transfer recipient
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
    ): TransferRecipientNewBankAccountResponse {
        $params = Util::removeNulls(
            [
                'accountNumber' => $accountNumber,
                'bankID' => $bankID,
                'accountName' => $accountName,
                'country' => $country,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createBankAccount(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a new mobile money transfer recipient
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
    ): TransferRecipientNewMobileMoneyResponse {
        $params = Util::removeNulls(
            [
                'country' => $country,
                'operator' => $operator,
                'phone' => $phone,
                'accountName' => $accountName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createMobileMoney(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
