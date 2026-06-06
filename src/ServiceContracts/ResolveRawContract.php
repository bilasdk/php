<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Resolve\ResolveBankAccountParams;
use Bila\Resolve\ResolveBankAccountResponse;
use Bila\Resolve\ResolveMobileMoneyParams;
use Bila\Resolve\ResolveMobileMoneyResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface ResolveRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ResolveBankAccountParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResolveBankAccountResponse>
     *
     * @throws APIException
     */
    public function bankAccount(
        array|ResolveBankAccountParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ResolveMobileMoneyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ResolveMobileMoneyResponse>
     *
     * @throws APIException
     */
    public function mobileMoney(
        array|ResolveMobileMoneyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
