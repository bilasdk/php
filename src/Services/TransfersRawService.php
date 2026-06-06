<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\TransfersRawContract;
use Bila\Transfers\TransferGetResponse;
use Bila\Transfers\TransferGetStatusByReferenceResponse;
use Bila\Transfers\TransferInitiateBankTransferParams;
use Bila\Transfers\TransferInitiateBankTransferParams\Country;
use Bila\Transfers\TransferInitiateBankTransferResponse;
use Bila\Transfers\TransferInitiateMobileMoneyTransferParams;
use Bila\Transfers\TransferInitiateMobileMoneyTransferParams\Operator;
use Bila\Transfers\TransferInitiateMobileMoneyTransferResponse;
use Bila\Transfers\TransferListParams;
use Bila\Transfers\TransferListParams\Status;
use Bila\Transfers\TransferListParams\Type;
use Bila\Transfers\TransferListResponse;

/**
 * Payout/transfer operation endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class TransfersRawService implements TransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a single transfer by its UUID
     *
     * @param string $id Transfer UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferGetResponse>
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
            path: ['api/v1/bila/transfers/%1$s', $id],
            options: $requestOptions,
            convert: TransferGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of transfers/payouts for the authenticated merchant
     *
     * @param array{
     *   accountID?: string,
     *   endDate?: string,
     *   page?: float,
     *   perPage?: float,
     *   startDate?: string,
     *   status?: Status|value-of<Status>,
     *   type?: Type|value-of<Type>,
     * }|TransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/transfers',
            query: Util::array_transform_keys($parsed, ['accountID' => 'accountId']),
            options: $options,
            convert: TransferListResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve transfer status by client reference
     *
     * @param string $reference Client reference
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferGetStatusByReferenceResponse>
     *
     * @throws APIException
     */
    public function getStatusByReference(
        string $reference,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/bila/transfers/status/%1$s', $reference],
            options: $requestOptions,
            convert: TransferGetStatusByReferenceResponse::class,
        );
    }

    /**
     * @api
     *
     * Initiate a transfer to a bank account. Creates a transaction record in your dashboard.
     *
     * @param array{
     *   accountID: string,
     *   amount: float,
     *   reference: string,
     *   accountNumber?: string,
     *   bankID?: string,
     *   country?: Country|value-of<Country>,
     *   narration?: string,
     *   recipientName?: string,
     *   transferRecipientID?: string,
     *   walletID?: string,
     * }|TransferInitiateBankTransferParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferInitiateBankTransferResponse>
     *
     * @throws APIException
     */
    public function initiateBankTransfer(
        array|TransferInitiateBankTransferParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferInitiateBankTransferParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/transfers/bank-account',
            body: (object) $parsed,
            options: $options,
            convert: TransferInitiateBankTransferResponse::class,
        );
    }

    /**
     * @api
     *
     * Initiate a transfer to a mobile money account. Creates a transaction record in your dashboard.
     *
     * @param array{
     *   amount: float,
     *   country: TransferInitiateMobileMoneyTransferParams\Country|value-of<TransferInitiateMobileMoneyTransferParams\Country>,
     *   operator: Operator|value-of<Operator>,
     *   phone: string,
     *   reference: string,
     *   narration?: string,
     *   recipientName?: string,
     *   walletID?: string,
     * }|TransferInitiateMobileMoneyTransferParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferInitiateMobileMoneyTransferResponse>
     *
     * @throws APIException
     */
    public function initiateMobileMoneyTransfer(
        array|TransferInitiateMobileMoneyTransferParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransferInitiateMobileMoneyTransferParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/transfers/mobile-money',
            body: (object) $parsed,
            options: $options,
            convert: TransferInitiateMobileMoneyTransferResponse::class,
        );
    }
}
