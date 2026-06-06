<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Banks\BankListResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface BanksContract
{
    /**
     * @api
     *
     * @param string $country Filter banks by country code
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $country = null,
        RequestOptions|array|null $requestOptions = null
    ): BankListResponse;
}
