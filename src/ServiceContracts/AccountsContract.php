<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Accounts\AccountGetBalanceResponse;
use Bila\Accounts\AccountGetResponse;
use Bila\Accounts\AccountListResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface AccountsContract
{
    /**
     * @api
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetResponse;

    /**
     * @api
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
    ): AccountListResponse;

    /**
     * @api
     *
     * @param string $id Account UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getBalance(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetBalanceResponse;
}
