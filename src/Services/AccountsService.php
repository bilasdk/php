<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Accounts\AccountGetBalanceResponse;
use Bila\Accounts\AccountGetResponse;
use Bila\Accounts\AccountListResponse;
use Bila\Client;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\AccountsContract;

/**
 * Account/wallet management endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class AccountsService implements AccountsContract
{
    /**
     * @api
     */
    public AccountsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a single account by its UUID
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of accounts/wallets for the authenticated merchant
     *
     * @param float $page Page number (default: 1)
     * @param float $perPage Items per page (default: 50)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?float $page = null,
        ?float $perPage = null,
        RequestOptions|array|null $requestOptions = null,
    ): AccountListResponse {
        $params = Util::removeNulls(['page' => $page, 'perPage' => $perPage]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the balance of a specific account
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getBalance(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetBalanceResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getBalance($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
