<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Accounts\AccountGetBalanceResponse;
use Bila\Accounts\AccountGetResponse;
use Bila\Accounts\AccountListParams;
use Bila\Accounts\AccountListResponse;
use Bila\Client;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\ServiceContracts\AccountsRawContract;

/**
 * Account/wallet management endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class AccountsRawService implements AccountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a single account by its UUID
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetResponse>
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
            path: ['api/v1/bila/accounts/%1$s', $id],
            options: $requestOptions,
            convert: AccountGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a paginated list of accounts/wallets for the authenticated merchant
     *
     * @param array{page?: float, perPage?: float}|AccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/accounts',
            query: $parsed,
            options: $options,
            convert: AccountListResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the balance of a specific account
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetBalanceResponse>
     *
     * @throws APIException
     */
    public function getBalance(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/v1/bila/accounts/%1$s/balance', $id],
            options: $requestOptions,
            convert: AccountGetBalanceResponse::class,
        );
    }
}
