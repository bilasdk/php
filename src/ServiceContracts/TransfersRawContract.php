<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\Transfers\TransferGetResponse;
use Bila\Transfers\TransferGetStatusByReferenceResponse;
use Bila\Transfers\TransferInitiateBankTransferParams;
use Bila\Transfers\TransferInitiateBankTransferResponse;
use Bila\Transfers\TransferInitiateMobileMoneyTransferParams;
use Bila\Transfers\TransferInitiateMobileMoneyTransferResponse;
use Bila\Transfers\TransferListParams;
use Bila\Transfers\TransferListResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface TransfersRawContract
{
    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TransferInitiateBankTransferParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferInitiateBankTransferResponse>
     *
     * @throws APIException
     */
    public function initiateBankTransfer(
        array|TransferInitiateBankTransferParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TransferInitiateMobileMoneyTransferParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferInitiateMobileMoneyTransferResponse>
     *
     * @throws APIException
     */
    public function initiateMobileMoneyTransfer(
        array|TransferInitiateMobileMoneyTransferParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
