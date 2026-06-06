<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Contracts\BaseResponse;
use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
use Bila\TransferRecipients\TransferRecipientCreateBankAccountParams;
use Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams;
use Bila\TransferRecipients\TransferRecipientGetResponse;
use Bila\TransferRecipients\TransferRecipientListParams;
use Bila\TransferRecipients\TransferRecipientListResponse;
use Bila\TransferRecipients\TransferRecipientNewBankAccountResponse;
use Bila\TransferRecipients\TransferRecipientNewMobileMoneyResponse;

/**
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface TransferRecipientsRawContract
{
    /**
     * @api
     *
     * @param string $id Recipient UUID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientGetResponse>
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
     * @param array<string,mixed>|TransferRecipientListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|TransferRecipientListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TransferRecipientCreateBankAccountParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientNewBankAccountResponse>
     *
     * @throws APIException
     */
    public function createBankAccount(
        array|TransferRecipientCreateBankAccountParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TransferRecipientCreateMobileMoneyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TransferRecipientNewMobileMoneyResponse>
     *
     * @throws APIException
     */
    public function createMobileMoney(
        array|TransferRecipientCreateMobileMoneyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
