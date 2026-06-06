<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Resolve\ResolveBankAccountParams;
use Bila\Resolve\ResolveBankAccountParams\Country;
use Bila\Resolve\ResolveBankAccountResponse;
use Bila\Resolve\ResolveMobileMoneyParams;
use Bila\Resolve\ResolveMobileMoneyParams\Operator;
use Bila\Resolve\ResolveMobileMoneyResponse;
use Bila\ServiceContracts\ResolveRawContract;

/**
 * Account resolution/verification endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class ResolveRawService implements ResolveRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Verify and retrieve bank account holder details
     *
     * @param array{
     *   accountNumber: string, bankID: string, country?: Country|value-of<Country>
     * }|ResolveBankAccountParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResolveBankAccountResponse>
     *
     * @throws APIException
     */
    public function bankAccount(
        array|ResolveBankAccountParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ResolveBankAccountParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/resolve/bank-account',
            body: (object) $parsed,
            options: $options,
            convert: ResolveBankAccountResponse::class,
        );
    }

    /**
     * @api
     *
     * Verify and retrieve mobile money account holder details
     *
     * @param array{
     *   country: ResolveMobileMoneyParams\Country|value-of<ResolveMobileMoneyParams\Country>,
     *   operator: Operator|value-of<Operator>,
     *   phone: string,
     * }|ResolveMobileMoneyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResolveMobileMoneyResponse>
     *
     * @throws APIException
     */
    public function mobileMoney(
        array|ResolveMobileMoneyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ResolveMobileMoneyParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/v1/bila/resolve/mobile-money',
            body: (object) $parsed,
            options: $options,
            convert: ResolveMobileMoneyResponse::class,
        );
    }
}
