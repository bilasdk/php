<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Banks\BankListParams;
use Bila\Banks\BankListResponse;
use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface BanksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BankListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BankListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BankListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
