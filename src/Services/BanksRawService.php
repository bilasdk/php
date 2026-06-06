<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Banks\BankListParams;
use Bila\Banks\BankListResponse;
use Bila\Client;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\ServiceContracts\BanksRawContract;

/**
 * Bank reference data endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class BanksRawService implements BanksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a list of all supported banks and financial institutions
     *
     * @param array{country?: string}|BankListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BankListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BankListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BankListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/v1/bila/banks',
            query: $parsed,
            options: $options,
            convert: BankListResponse::class,
        );
    }
}
