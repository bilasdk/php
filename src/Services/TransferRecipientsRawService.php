<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\ServiceContracts\TransferRecipientsRawContract;
use Bila\TransferRecipients\TransferRecipientCreateBankAccountParams;
use Bila\TransferRecipients\TransferRecipientCreateBankAccountParams\Country;
use Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams;
use Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Operator;
use Bila\TransferRecipients\TransferRecipientGetResponse;
use Bila\TransferRecipients\TransferRecipientListParams;
use Bila\TransferRecipients\TransferRecipientListParams\Type;
use Bila\TransferRecipients\TransferRecipientListResponse;
use Bila\TransferRecipients\TransferRecipientNewBankAccountResponse;
use Bila\TransferRecipients\TransferRecipientNewMobileMoneyResponse;

/**
 * Transfer recipient management endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class TransferRecipientsRawService implements TransferRecipientsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a single transfer recipient by its UUID
     *
     * @param string $id Recipient UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/bila/transfer-recipients/%1$s', $id],
            options: $requestOptions,
            convert: TransferRecipientGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of saved transfer recipients
     *
     * @param array{
     *   page?: float, perPage?: float, type?: Type|value-of<Type>
     * }|TransferRecipientListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TransferRecipientListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferRecipientListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/transfer-recipients',
            query: $parsed,
            options: $options,
            convert: TransferRecipientListResponse::class,
        );
    }

    /**
     * @api
     *
     * Create a new bank account transfer recipient
     *
     * @param array{
     *   accountNumber: string,
     *   bankID: string,
     *   accountName?: string,
     *   country?: Country|value-of<Country>,
     * }|TransferRecipientCreateBankAccountParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientNewBankAccountResponse>
     *
     * @throws APIException
     */
    public function createBankAccount(
        array|TransferRecipientCreateBankAccountParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferRecipientCreateBankAccountParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/transfer-recipients/bank-account',
            body: (object) $parsed,
            options: $options,
            convert: TransferRecipientNewBankAccountResponse::class,
        );
    }

    /**
     * @api
     *
     * Create a new mobile money transfer recipient
     *
     * @param array{
     *   country: TransferRecipientCreateMobileMoneyParams\Country|value-of<TransferRecipientCreateMobileMoneyParams\Country>,
     *   operator: Operator|value-of<Operator>,
     *   phone: string,
     *   accountName?: string,
     * }|TransferRecipientCreateMobileMoneyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientNewMobileMoneyResponse>
     *
     * @throws APIException
     */
    public function createMobileMoney(
        array|TransferRecipientCreateMobileMoneyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferRecipientCreateMobileMoneyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/transfer-recipients/mobile-money',
            body: (object) $parsed,
            options: $options,
            convert: TransferRecipientNewMobileMoneyResponse::class,
        );
    }
}
